<?php 
namespace Zuz;

use \Zuz\DB;
use \Zuz\Core;
use \Zuz\Browser;
use \Zuz\Email;
use \Zuz\Config;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class User {

public static function byId($id=0){
    if($id > 0){
        $get = DB::SELECT("SELECT * FROM users WHERE ID=?", array($id), "i");
        if($get->hasRows){
            return self::You($get->row);
        }
    }
    return array( "ID" => -1 );
}

public static function You($u){
	$a = array(
        'ID' => Core::toHash($u->ID),
        'nm' => $u->fullname,
        'em' => $u->email
    );    
    return $a;
}

public static function UCode(){
	return rand(111111, 999999);
}

public static function Signin(){
    
    $post = Core::withPost();
	$_BROWSER = new Browser();
    
    if(!isset($post->em) || !isset($post->psw)){
		Core::Respond(array(
			'error' => true,
			'reason' => 'InvalidPostData',
			'message' => 'One or more fields are missing or has invalid data format'
		));
	}

    $email = trim($post->em);
    //Check if email is already registered
    $get = DB::SELECT("SELECT * FROM users WHERE email=? LIMIT 1", array($email), "s");
    if(!$get->hasRows){
        Core::Respond(array(
            'error' => true,
            'reason' => 'EmailAlreadyTaken',
            'message' => 'That email is not associated with any account'
        ));
    }

    $u = $get->row;
    if($u->password != Core::Encode($post->psw)){
        Core::Respond(array(
            'error' => true,
            'reason' => 'InvalidPassword',
            'message' => 'Invalid Email / Password Combination'
        ));
    }

    if($u->status == 'banned' || $u->status == 'debrid'){
        Core::Respond(array(
            'error' => true,
            'reason' => 'InvalidPassword',
            'message' => 'You are banned from ' . Config::APP_NAME
        ));
    }

    if ( (int)$post->ami == 1 && $u->utype == 'user' ){
        Core::Respond(array(
            'error' => true,
            'reason' => 'InvalidUser',
            'message' => 'That email is orphan. Enter valid email address'
        ));
    }

    $UID = $u->ID;

    $jwt = Core::CreateJWT($UID);

    $extras = array(
        'browser' => $_BROWSER->getBrowser() . '@@' . $_BROWSER->getVersion() . '@@' . $_BROWSER->getPlatform()
    );
    
    $_geo = Core::Geo();
    $geo = time() . Config::SEPERATOR . implode(Config::SEPERATOR, $_geo);

    $expiry = time() + (86400 * 7);
    $uinfo = $geo . Config::SEPERATOR . $extras['browser'];
    $_ut = Core::Encode($UID . Config::SEPERATOR . $email . Config::SEPERATOR . Core::Encode($post->psw));
    $sess = DB::INSERT("INSERT INTO users_sess (uid,token,expiry,uinfo) VALUES (?,?,?,?)",array($UID,$_ut,$expiry,$uinfo), "isss");
		
    Core::Respond(array(
        'kind' => 'userSignedin',
        Config::SESS_UI => Core::toHash($UID),
        Config::SESS_UT => $jwt,
        Config::SESS_UD => $_ut,
        Config::SESS_SI => Core::toHash($sess->ID)
    ));

}

public static function Signup(){
    
    $post = Core::withPost();
	$_BROWSER = new Browser();    

	if(!isset($post->em) || !isset($post->psw)){
		Core::Respond(array(
			'error' => true,
			'reason' => 'InvalidPostData',
			'message' => 'One or more fields are missing or has invalid data format'
		));
	}
	
    //Convert email to lower case
    $email = strtolower($post->em);

    //Check if email is already registered
    $get = DB::SELECT("SELECT ID FROM users WHERE email=? LIMIT 1", array($email), "s");
    if($get->hasRows){
        Core::Respond(array(
            'error' => true,
            'reason' => 'EmailAlreadyTaken',
            'message' => 'That email is already associated with another account'
        ));
    }

    //Generate User Activation Code
    $ucode = self::UCode();
		
    //Generate User Activation Code Match
    $utoken = Core::UUID();

    $_geo = Core::Geo();
    $geo = time() . Config::SEPERATOR . implode(Config::SEPERATOR, $_geo);

    $passw = Core::Encode($post->psw);

    /**
     * Extract name from email
     */
    @list($_name, $_hot) = explode("@", $email);

    $save = DB::INSERT("INSERT IGNORE INTO users (token,ucode,email,password,fullname,joined,signin) VALUES (?,?,?,?,?,?,?)",
		array($utoken, $ucode, $email, $passw, trim($_name), $geo, $geo));
        
    //If save query doesn't go throught than return unknown error
    if($save->saved === false){
        Core::Respond(array(
            'error' => true,
            'reason' => 'Unknown',
            'message' => "Unable to process request. Try again!"
        ));
    }

    //Newly Generated User ID
    $UID = $save->ID;

    $jwt = Core::CreateJWT($UID);
    
    $activationLink = Config::BASEURL . 'u/verify?token=' . Core::Encode($UID . Config::SEPERATOR . $utoken . Config::SEPERATOR . $ucode . Config::SEPERATOR . $email);

    //Send email to user
    $verification = Config::EMAIL_VERIFICATION_MODE == 1 ? 
        "<a href=\"$activationLink\" style=\"border-radius: 4px;font-weight: bold;background: #666666;color: #ffffff;text-decoration: none;text-align: center;padding: 15px;font-size: 16px;display: block;position: absolute;top: 50%;right: 20px;transform: translateY(-50%);\">Verify Now</a>" 
        : "<h2 style=\"font-weight: bold;font-size: 18px;\">Verification code</h2><div style=\"font-size: 50px;font-weight: bold;\">$ucode</div>";
    $verificationMsg = Config::EMAIL_VERIFICATION_MODE == 1 ? 
        "Please click verify now" : "Please enter the following verification code when prompted";
    Email::Send(
        array('mail' => $email, 'name' => $_name),
        Config::APP_NAME . " Email Verification!",
        "<h2 style=\"font-weight: bold;font-size: 18px;\">Verify your email address</h2>
        Thanks for starting the new " . Config::APP_NAME . " account creation process. We want to make sure it's really you. $verificationMsg. If you don't want to create an account, you can ignore this message.
        <div style=\"border-top: 1px #e8e8e8 solid;border-bottom: 1px #e8e8e8 solid;padding: 30px;margin: 30px 0px;position: relative;text-align: center;\">
            $verification            
        </div>			
        <div style=\"margin: 10px 0px;\">" . Config::APP_NAME . " will never email you and ask you to disclose or verify your password, credit card or banking account number.</div>
        Cheers!<br>The " . Config::APP_NAME . " Team"
    );

    //Now let's save user session info to users_sess TABLE
    if(Core::GetCog('verify_email_before_signin', 1) == 1){
        Core::Respond(array(
            'kind' => 'userRegistered',
            'message' => 'Account created...',
            'redirect' => Config::BASEURL . 'u/create?dn=' . time()
        ));
    }

    $extras = array(
        'browser' => $_BROWSER->getBrowser() . '@@' . $_BROWSER->getVersion() . '@@' . $_BROWSER->getPlatform()
    );
    
    $expiry = time() + (86400 * 7);
    $uinfo = $geo . Config::SEPERATOR . $extras['browser'];
    $_ut = Core::Encode($UID . Config::SEPERATOR . $email . Config::SEPERATOR . $passw);
    $sess = DB::INSERT("INSERT INTO users_sess (uid,token,expiry,uinfo) VALUES (?,?,?,?)",array($UID,$_ut,$expiry,$uinfo), "isss");
		
    Core::Respond(array(
        'kind' => 'userRegistered',
        'me' => self::byId($UID),
        'redirect' => Config::BASEURL . 'profile?sup=1&ce=' . time(),
        Config::SESS_UI => Core::toHash($UID),
        Config::SESS_UT => $jwt,
        Config::SESS_UD => $_ut,
        Config::SESS_SI => Core::toHash($sess->ID)
    ));

}

public static function Recover(){
	
    $post = Core::withPost();
	$_BROWSER = new Browser();    

	if(!isset($post->em) || empty($post->em) || !Core::isEmail(trim($post->em))){
		Core::Respond(array(
			'error' => true,
			'reason' => 'InvalidPostData',
			'message' => 'Enter a valid email address.'
		));
	}

	$email = strtolower(trim($post->em));
	$get = DB::SELECT("SELECT * FROM users WHERE email=? LIMIT 1", array($email));
	if(!$get->hasRows){
		Core::Respond(array(
			'error' => true,
			'reason' => 'EmailAlreadyTaken',
			'message' => 'That email address is not associated with any account.'
		));
	}

	$u = $get->row;
	
	if($u->status == 'banned'){
		Core::Respond(array(
			'error' => true,
			'reason' => 'UserBanned',
			'message' => 'You are banned from ' . Config::APP_NAME
		));
	}

	$UID = $u->ID;
	$ucode = self::UCode();	

	DB::UPDATE("UPDATE users SET ucode=? WHERE id=? AND email=? LIMIT 1", array($ucode, $UID, $email));

	$rtoken = Core::Encode($UID . Config::SEPERATOR . $ucode . Config::SEPERATOR . $email);
	$recoverLink = Config::BASEURL . 'u/recover?token=' . $rtoken;

    Email::Send(
        array('mail' => $email, 'name' => $u->fullname),
        "Password reset request",
        "<h2 style=\"font-weight: bold;font-size: 18px;\">Reset your password?</h2>
        If you requested a password reset for your " . Config::APP_NAME . " account, below is your reset link. If you didn\'t make this request, ignore this email.
        <div style=\"border-top: 1px #e8e8e8 solid;border-bottom: 1px #e8e8e8 solid;padding: 30px;margin: 30px 0px;position: relative;text-align: center;\">
            <a href=\"$recoverLink\" style=\"border-radius: 4px;font-weight: bold;background: #666666;color: #ffffff;text-decoration: none;text-align: center;padding: 15px;font-size: 16px;display: block;position: absolute;top: 50%;right: 20px;transform: translateY(-50%);\">Recover Now</a>          
        </div>			
        <div style=\"margin: 10px 0px;\">" . Config::APP_NAME . " will never email you and ask you to disclose or verify your password, credit card or banking account number.</div>
        Cheers!<br>The " . Config::APP_NAME . " Team"
    );

	Core::Respond(array(
		'kind' => 'recoverCodeSent',
		// 'link' => $recoverLink,
		'message' => 'An email with recovery code has been sent to ' . $email
	));

}

public static function UpdatePassw(){
	
    $post = Core::withPost();
	$_BROWSER = new Browser(); 

	if(!isset($post->token) || empty($post->token) || !isset($post->psw) || empty($post->psw)){
		Core::Respond(array(
			'error' => true,
			'reason' => 'InvalidPostData',
			'message' => 'We are unable to understand what you want.'
		));
	}

	@list($UID, $ucode, $email) = explode(Config::SEPERATOR, Core::Decode($post->token));
	$get = DB::SELECT("SELECT * FROM users WHERE ID=? AND ucode=? AND email=? LIMIT 1", array($UID, $ucode, $email));
	if(!$get->hasRows){
		Core::Respond(array(
			'error' => true,
			'reason' => 'invalidToken',
			'message' => 'Invalid Password Recovery Token.'
		));
	}

    $u = $get->row;

	$update = DB::UPDATE("UPDATE users SET ucode=?, password=? WHERE ID=? AND ucode=? AND email=? LIMIT 1",
	array(self::UCode(), Core::Encode($post->psw), $UID, $ucode, $email));

	if($update->updated){

        Email::Send(
            array('mail' => $email, 'name' => $u->fullname),
            'Your ' . Config::APP_NAME . ' Password Updated',
            "<h2 style=\"font-weight: bold;font-size: 18px;\">Password updated for " . Config::APP_NAME . "</h2>
            Hey,<br>Your password for " . Config::APP_NAME . " was updated recently. If you haven't made this change, Click the link below to reset your password.	
            <div style=\"border-top: 1px #e8e8e8 solid;border-bottom: 1px #e8e8e8 solid;padding: 30px;margin: 30px 0px;position: relative;text-align: center;\">
                <a href=\"" . Config::BASEURL . "u/recover?ce=" . time() . "\" style=\"border-radius: 4px;font-weight: bold;background: #666666;color: #ffffff;text-decoration: none;text-align: center;padding: 15px;font-size: 16px;display: block;position: absolute;top: 50%;right: 20px;transform: translateY(-50%);\">Recover Now</a>                    
            </div>			
            Cheers!<br>The " . Config::APP_NAME . " Team"
        );

		Core::Respond(array(
			'kind' => 'PasswordUpdated',
			'message' => 'Password updated successfully.'
		));

	}

	Core::Respond(array(
		'error' => true,
		'reason' => 'invalidToken',
		'message' => 'Invalid Password Recovery Token.'
	));

}

public static function RemoveSession(){

    $you = self::Session();
    $post = Core::withPost();
    
	try{
	    $ID = Core::fromHash($post->ID);
	    DB::DELETE("DELETE FROM users_sess WHERE ID=? AND uid=?", array($ID, $UID));
    }catch(Exception $e){}
	
	echo JSON(array(
		'kind' => 'sessionRemoved',
		'message' => 'Session removed.'
	));

}

public static function GetInfo($UID, $col){
	try{
        $UID = is_numeric($UID) ? $UID : Core::fromHash($UID);
		$get = DB::SELECT("SELECT " . $col . " FROM users WHERE ID=? LIMIT 1", array($UID), "i");
		return $get->row->{$col};
	}catch(Exception $e){
		return null;
	}
}

public static function isGuest(){
    return self::Session(false)->sess == true ? false : true;
}

public static function Update($uid, $meta){
	$arr = array();
	$s = "";
	$q = "UPDATE users SET ";
	$i = 0;
	foreach($meta as $col => $val):
		$q .= $col . '=?';
		if($i < count($meta) - 1){
			$q .= ", ";
		}
		array_push($arr, $val);
		$s .= "s";
		$i++;
	endforeach;
	$q .= " WHERE ID=? LIMIT 1";
	array_push($arr, $uid);
	$s .= "i";
	$update = DB::UPDATE($q, $arr);
	return $update->updated ? true : false;
}

public static function Session($validate = true, $obj = true){
    $return = array( 'sess' => false );

    if(
		isset($_COOKIE[ Config::SESS_FIX . Config::SESS_UI  ])
		&& $_COOKIE[ Config::SESS_FIX . Config::SESS_UI ] != "undefined" 
		&& isset($_COOKIE[ Config::SESS_FIX . Config::SESS_UT ])
		&& $_COOKIE[ Config::SESS_FIX . Config::SESS_UT ] != "undefined" 
		&& isset($_COOKIE[ Config::SESS_FIX . Config::SESS_UD ])
		&& $_COOKIE[ Config::SESS_FIX . Config::SESS_UD ] != "undefined"
	){

        $uid = Core::fromHash($_COOKIE[ Config::SESS_FIX . Config::SESS_UI ]); 
		$ut = $_COOKIE[ Config::SESS_FIX . Config::SESS_UT ];
		$ud = $_COOKIE[ Config::SESS_FIX . Config::SESS_UD ];

        try{
			$ut = (array)\Firebase\JWT\JWT::decode($ut, new Key(Config::SECURE_KEY, 'HS256'));

            if(isset($ut['ui'])){
				$JUID = Core::fromHash($ut['ui']);
				@list($UID, $email, $passw, $utype) = explode(Config::SEPERATOR, Core::Decode($ud));
				if($JUID == $UID){
					$get = DB::SELECT("SELECT ID FROM users_sess WHERE uid=? AND token=? AND expiry>? AND status=? LIMIT 1",
					array($JUID, $ud, time(), 'yes'), "isis");
					if($get->count > 0){
						$you = DB::SELECT("SELECT * FROM users WHERE ID=? AND status!=? AND status!=?", array($JUID, 'banned', 'debrid'), "iss");
						if($you->count > 0){
							$u = $you->row;
							if($u->password == $passw){
								$dp = empty($u->picture) ? 'no-dp.png' : $u->picture;
								$a = array(
									'sess' => true,
									'ut' => $u->utype == 'user' ? 1 : 2,
									'id' => Core::toHash($u->ID),
									'nm' => $u->fullname,
									'em' => $u->email,
									'dp' => Config::BASEURL . 'photo/dp/' . Core::Encode($dp) . '/{wxh}/default.jpg'
								);
								@list($plan, $expiry) = explode(Config::SEPERATOR, $u->premium);
								if($plan > 0 && $expiry > time()){
									$a['pro'] = array(
										'plan' => $plan,
										'expiry' => date(Config::DATE_FORMAT, $expiry)
									);
								}
								if($u->signin != 'none'){
									@list($_stamp, $_ip, $_city, $_c, $_cc) = explode(Config::SEPERATOR, $u->signin);
									self::Update($u->ID, array( 'signin' => time() . Config::SEPERATOR . $_ip . Config::SEPERATOR . $_city . Config::SEPERATOR . $_c . Config::SEPERATOR . $_cc ));
								}
								$return = $a;
							}
						}
					}
				}
			}
		} catch(Exception $e) {
		} finally {
		}

    }

    if($validate && $return['sess'] == false){
		Core::Respond(array( 'error' => true, 'reason' => 'oauth' ));
	}

    return Core::JSON($return, $obj);


}

public static function Authorized($next){
    if ( self::isGuest() ){
        header("location: $next"); exit;
    }
}

public static function isAdmin(){
    if( self::isGuest() ){
        return false;
    }
    $u = self::Session(false);
    return $u->sess == true && $u->ut == 2;
}

public static function UpdatePassword(){
    $you = self::Session();
    $post = Core::withPost();
    $_BROWSER = new Browser();   
    $ud = $_COOKIE[ Config::SESS_FIX . Config::SESS_UD ];

    if(!isset($post->cpsw) || !isset($post->psw)){
		Core::Respond(array(
			'error' => true,
			'reason' => 'InvalidPostData',
			'message' => 'One or more fields are missing or has invalid data format'
		));
	}

    $u = DB::SELECT("SELECT * FROM users WHERE ID=? LIMIT 1", array(Core::fromHash($you->id)), "i")->row;
    if($u->password != Core::Encode($post->cpsw)){
        Core::Respond(array(
            'error' => true,
            'kind' => 'invalidPassword',
            'message' => 'Current password is incorrect'
        ));
    }
    
    $update = DB::UPDATE("Update users SET password=? WHERE ID=?", array(Core::Encode($post->psw), $u->ID), "si");
    
    $sess = DB::SELECT(
        "SELECT ID FROM users_sess WHERE uid=? AND token=? AND expiry>? AND status=? LIMIT 1",
        array($u->ID, $ud, time(), 'yes'), "isis"
    );

    if($update->updated){
        $token = Core::Encode($u->ID . Config::SEPERATOR . $u->email . Config::SEPERATOR . Core::Encode($post->psw));
        DB::UPDATE(
            "UPDATE users_sess SET token=? WHERE ID=? AND uid=?",
            array($token, $sess->row->ID, $u->ID),
            "sii"
        );
        
        $jwt = Core::CreateJWT($u->ID);
 
        Core::Respond(array(
            'kind' => 'passwordUpdated',
            Config::SESS_UI => Core::toHash($u->ID),
            Config::SESS_UT => $jwt,
            Config::SESS_UD => $token,
            Config::SESS_SI => Core::toHash($sess->row->ID)
        ));
    }

    

    Core::Respond(array(
		'error' => true,
		'reason' => 'notUpdated',
		'message' => 'Something went wrong'
	));

}

}
?>