<?php 

namespace Zuz;

use \Zuz\Config;
use \Zuz\Slugger;
use \Zuz\Countries;

use \Hashids\Hashids;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Request;
use \GuzzleHttp\Http\Exception\ClientErrorResponseException;
use \GuzzleHttp\Exception\ConnectException;

class Core{

protected static $_TIMER = 0;
protected static $_HASH;
protected static $_HTTP_CLIENT;

public static function Timer( $end = false, $display = 0, $precision = 3 ) {
	if($end){
		$timetotal = microtime( true ) - self::$_TIMER;
		$r         = ( function_exists( 'number_format_i18n' ) ) ? number_format_i18n( $timetotal, $precision ) : number_format( $timetotal, $precision );
		if ( $display ) {
			echo $r;
		}
		return $r;
	}else{
		self::$_TIMER = microtime( true );
	}
}

public static function GetCog($field, $defaultValue = "__", $json = false, $toArr = false){
    $query = DB::SELECT("SELECT valu FROM settings WHERE optn=? LIMIT 1", array($field), "s");    
    if($query->hasRows){
        return $json === true ? @json_decode($query->row->valu, $toArr) : $query->row->valu;
    }else{
        if($defaultValue == '__'){
            return $defaultValue === "__" ? "none" : $defaultValue;
        }
        self::SetCog($field, $defaultValue, $json);
        return $defaultValue;
    }    
}

public static function SetCog($field, $value, $json = false){
	$value = $json == true ? json_encode($value) : $value;
	$is = DB::SELECT("SELECT valu FROM settings WHERE optn=? LIMIT 1", array($field), "s");
	if($is->hasRows){
		DB::UPDATE("UPDATE settings SET valu=? WHERE optn=?", array($value,$field), "ss");
	}else{
		DB::INSERT("INSERT INTO settings (optn,valu) VALUES(?,?)", array($field,$value), "ss");
	}
}

public static function POST(){
	$RAW_POST = @file_get_contents("php://input");
	$POST = empty($RAW_POST) ? @json_decode(@json_encode($_POST)) : @json_decode($RAW_POST);
	return $POST;
}

public static function JSON($array, $decode = false){
	if($decode==true){
		return @json_decode(@json_encode($array));
	}else{
		return @json_encode($array, 128);
	}
}

public static function Respond($resp){ echo self::JSON($resp); exit;  }

public static function RequestMethod($method = 'post'){

	if($method != strtolower($_SERVER['REQUEST_METHOD'])){
		self::Respond(array( 'error' => true , 'message' => 'That Behaviour is unacceptable. Good try though!' ));
	}
}

public static function withPost(){ 
	self::RequestMethod(); 
	return self::POST();
}

public static function withGet(){ 
	self::RequestMethod('get'); 
	return self::JSON($_GET, true);
}

public static function isEmail($email){
	return !filter_var($email, FILTER_VALIDATE_EMAIL) === false ? true : false;
}

public static function CamelCase($str, $delimeter = "_"){
	return str_replace($delimeter, "", ucwords($str, $delimeter));
}

public static function getRandomInteger($min = 4, $max = 6){
	
	$range = ($max - $min);

	if ($range < 0) {
		// Not so random...
		return $min;
	}

	$log = log($range, 2);

	// Length in bytes.
	$bytes = (int) ($log / 8) + 1;

	// Length in bits.
	$bits = (int) $log + 1;

	// Set all lower bits to 1.
	$filter = (int) (1 << $bits) - 1;

	do {
		$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));

		// Discard irrelevant bits.
		$rnd = $rnd & $filter;

	} while ($rnd >= $range);

	return ($min + $rnd);
}

public static function UUID($len=10){
	$alphabet = implode(range('a', 'z')) . implode(range('A', 'Z')) . implode(range(0, 9));
	$alphabetLength = strlen($alphabet);
	$token = '';
	for ($i = 0; $i < $len; $i++) {
		$randomKey = self::getRandomInteger(0, $alphabetLength);
		$token .= $alphabet[$randomKey];
	}
	return $token;
}

public static function toHash($s){
	if(!self::$_HASH){
		self::$_HASH = new Hashids(Config::SECURE_KEY, Config::HASH_KEY_LENGTH);
	}
	return self::$_HASH->encode($s);
}

public static function fromHash($s){
	if(!self::$_HASH){
		self::$_HASH = new Hashids(Config::SECURE_KEY, Config::HASH_KEY_LENGTH);
	}
	if(!$s || empty($s)) return 0;
	try{
		$x = self::$_HASH->decode($s);
		return is_array($x) && count($x) > 0 ? (int)$x[0] : 0;
	}catch(Exception $e){
		return 0;
	}
}

public static function StartLimit($defaultLimit = 100){
	$post = self::POST();
	$limit = isset($post->limit) ? (int)$post->limit : $defaultLimit;
	$ostart = $post->pg == "pg" ? 0 : (is_numeric($post->pg) ? $post->pg : self::fromHash($post->pg)); 
	$start = ($ostart * $limit) - $limit;
	$start = $start < 0 ? 0 : $start;
	return array($start, $limit);
}

public static function Slug($str, $len = 0){
	return empty($str) || $str == "__" ? "__" : Slugger::Build($str);
}

public static function CURL($url, $method = "get", $data = array(), $headers = array(), $timeout = 3.14){
	
	if(!self::$_HTTP_CLIENT){
		self::$_HTTP_CLIENT = new \GuzzleHttp\Client();		
	}
	
	$request = count($data) > 0 ? new Request(
		strtoupper($method), $url, [ "json" => $data ]
	) : new Request(strtoupper($method), $url);
	$_headers = array(
		'User-Agent' => $_SERVER['HTTP_USER_AGENT']
	);

	try{

		$response = self::$_HTTP_CLIENT->sendAsync($request, array(
			'verify' => false,
			'connect_timeout' => $timeout,
			'timeout' => $timeout,
			// 'debug' => Config::DEBUG,
			'headers' => count($headers) > 0 ? array_merge( 
				$_headers, 
				$headers
			) : $_headers
		))->then(function($resp){ 
			return $resp->getBody();
		});
		
		return $response->wait();

	}catch(ConnectException $e){
		print_r($e);
	}catch(ClientErrorResponseException $e){
		print_r('cere: ' . $e->getMessage());
	}catch(RequestException $e){
		print_r('re: ' . $e->getMessage());
	}

}

public static function Mobile(){	
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
}

public static function safe_b64encode($string) {
    $data = base64_encode($string);
    $data = str_replace(array('+','/','='),array('-','_',''),$data);
	return $data;
}

public static function safe_b64decode($string){
	$data = str_replace(array('-','_'),array('+','/'),$string);
	$mod4 = strlen($data) % 4;
	if ($mod4) {
		$data .= substr('====', $mod4);
	}
	return base64_decode($data);
}

public static function Encode($value, $key = "none"){ 
	if(!$value){return false;}	
	$text = $value;
	$ENCRYPT_KEY = $key == "none" ? Config::SECURE_KEY : $key;
	if(function_exists('mcrypt_encrypt') && phpversion() < 7){
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($ENCRYPT_KEY), $text, MCRYPT_MODE_ECB, $iv);
		return trim(self::safe_b64encode($crypttext)); 
	}else if(function_exists('openssl_encrypt')){
		$iv = substr(md5($ENCRYPT_KEY), 0, 16);
		$output = openssl_encrypt($value, "AES-256-CBC", $ENCRYPT_KEY, 0, $iv);
        return trim(self::safe_b64encode($output));
	}else{
		return trim(self::safe_b64encode($value));
	}
}

public static function Decode($value, $key = "none"){
	if(!$value){return false;}
	$ENCRYPT_KEY = $key == "none" ? Config::SECURE_KEY : $key;
	if(function_exists('mcrypt_encrypt') && phpversion() < 7){
		$crypttext = self::safe_b64decode($value); 
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($ENCRYPT_KEY), $crypttext, MCRYPT_MODE_ECB, $iv);
		return trim($decrypttext);
	}else if(function_exists('openssl_encrypt')){		
		$iv = substr(md5($ENCRYPT_KEY), 0, 16);
		return openssl_decrypt(self::safe_b64decode($value), "AES-256-CBC", $ENCRYPT_KEY, 0, $iv);
	}else{		
		return self::safe_b64decode($value);
	}
}

public static function GoogleAnalytics($autoSend = false){
	$ga = self::GetCog('google_ga', 'ua-xxxxxxxx-x');
	if(strtolower($ga)!='ua-xxxxxxxx-x'){
		echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . $ga . '"></script>';
		echo '<script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}';
		echo 'gtag(\'js\', new Date());';
		if($autoSend === true){ echo 'gtag(\'config\', \'' . strtoupper($ga) . '\');'; }
		echo '</script>';
	}
}

public static function IP($withRemote = false){
	if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])){
		return $_SERVER['HTTP_CF_CONNECTING_IP'];
	}
	else if($withRemote == true){
		$content = self::CURL('http://checkip.dyndns.com/');
		preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $content, $ip);
		return $ip[1];
	}
	else{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
		{    $ip=$_SERVER['HTTP_CLIENT_IP'];    }
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];    }
		else
		{    $ip=$_SERVER['REMOTE_ADDR'];    }
		return $ip;
	}
}

public static function JWT_ENCODE($token){
	return JWT::encode($token, Config::SECURE_KEY, 'HS256');
}

public static function JWT_DECODE($token){
	return JWT::decode($token, new Key(Config::SECURE_KEY, 'HS256'));
}

public static function CSRF($exp){
	return self::JWT_ENCODE(array(
		"iss" => Config::BASEURL,
		"aud" => Config::BASEURL,
		"iat" => time(),
		"exp" => time() + $exp,
		"pi" => self::Encode(self::IP())
	));
}

public static function Geo($MIP = 'none'){
	if(isset($_SERVER['HTTP_CF_IPCOUNTRY'])){
		return array(
			$_SERVER['HTTP_CF_CONNECTING_IP'],
			'unknown',
			Countries::byCode($_SERVER['HTTP_CF_IPCOUNTRY'])['name'],
			$_SERVER['HTTP_CF_IPCOUNTRY'],
			'cf',
			'cf'
		);
	}
	$ip = $MIP == 'none' ? self::IP() : $MIP;
	$key = Config::GEO_API_KEY;
	$geo = @json_decode(self::CURL('http://proxycheck.io/v2/' . $ip . '?key=' . $key . '&asn=1&vpn=1'), true);
	if(isset($geo['status']) && $geo['status'] == 'ok'){
		return array(
			$ip,
			isset($geo[$ip]['city']) ? $geo[$ip]['city'] : 'unknown',
			$geo[$ip]['country'],
			$geo[$ip]['isocode'],
			$geo[$ip]['proxy'],
			$geo[$ip]['type']
		);
	}
	return array('unknown', 'unknown', 'unknown', 'unknown', 'unknown', 'unknown');	
}

public static function ParseUri($uri){
	$u = parse_url($uri);
	$url = $u['scheme'] . '://' . $u['host'];
	return array(
		'uri' => $url,
		'host' => strtolower($u['host']),
		'hash' => md5($url)
	);
}

public static function CreateJWT($UID){
	return self::JWT_ENCODE(array(
		"iss" => Config::BASEURL,
		"aud" => Config::BASEURL,
		"iat" => time(),
		"exp" => time() + (86400 * 7),
		"ui" => self::toHash($UID)
	));
}

public static function Pagination($current, $total, $limit, $labels = false){
	$p = array('pages' => array());
	$pages = ceil($total / $limit);
	$currentPage = is_numeric($current) ? $current : self::fromHash($current)[0];
	if($currentPage > 1){
		$p['prev'] = self::toHash($currentPage-1);
	}
	
	$range = 5;
	if($currentPage < $range){
		$begin = 1;	
	}else{
		$begin = $currentPage-2;
	}	
	if(($begin+$range) <= $pages){
		$end = $begin+$range;	
	}else{
		$begin = $pages-$range;
		$end = $pages;
	}
	if($begin<=0){ $begin = 1;	}			
	for($i=$begin;$i<=$end;$i++):
		if($labels){
			$hash = self::toHash((int)trim($i));
			$p['pages'][] = array('id' => $hash, 'lbl' => $i);
		}else{
			array_push($p['pages'], self::toHash($i));																	
		}
	endfor;
	if(!($currentPage >= $total-$limit)){
		$currentPage = $currentPage == 0 ? 1 : $currentPage;
		$p['next'] = self::toHash($currentPage + 1);
	}
	$p['total'] = $pages;
	return $p;
}

public static function getCombinations($array){	
	$length = count($array);
	$combocount=pow(2,$length);
	for ($i = 0;$i<=$combocount;$i++){
		$binary=self::decextbin($i,$length);
		$combination='';
		for($j=0;$j<$length;$j++)
		{
			if($binary[$j]=="1")
				$combination.=$array[$j].' ';
		}
		$combinationsarray[]=$combination;			
	}
	return array_reverse($combinationsarray);
}
	
public static function decextbin($decimalnumber,$bit){
	$binarynumber = '';
	$maxval = 1;
	$sumval = 1;
	for($i=1;$i< $bit;$i++){
		$maxval = $maxval * 2;
		$sumval = $sumval + $maxval;
	} 
	if ($sumval < $decimalnumber) return 'ERROR - Not enough bits to display this figure in binary.';
	for($bitvalue=$maxval;$bitvalue>=1;$bitvalue=$bitvalue/2){
		if (($decimalnumber/$bitvalue) >= 1) $thisbit = 1; else $thisbit = 0;
		if ($thisbit == 1) $decimalnumber = $decimalnumber - $bitvalue;
		$binarynumber .= $thisbit;
	}
	return $binarynumber;
}

public static function formatSize($size, int $precision = 2){
	$base = log($size, 1024);
	$suffixes = array('', 'Kb', 'MB', 'GB', 'TB');   
	return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}

public static function is($input, string $type = "string" ) : bool {
	return gettype($input) === $type;
}

public static function Has(array $input, string $key) : bool {
	return array_key_exists($key, $input);
}


}
?>