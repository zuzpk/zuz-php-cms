<?php 
use \Zuz\Config;
use \Zuz\User;
use \Zuz\Router;
use \Zuz\Core;
use \Zuz\DB;

if ( !User::isGuest() ){ header("location: " . Config::BASEURL . "buy?" . time()); exit; }
$section = Router::hasParams(array('section')) ? str_replace("-", "", Router::getParams()->section) : "signin"; 

$imgs = array(
    array(
        'ai.webp',
        'backend.webp',
        'c-hash.webp',
        'Brown-cliff-50.jpg' 
    ),
    array(
        'paypal.webp',
        'netherlands.png',
        'python.webp',
        'unity.webp'
    )
);

?>

<div class="account flex rel blurify account-<?php echo $section; ?>" section="<?php echo $section; ?>" dun="<?php echo isset($_GET["dn"]) ? 1 : 0; ?>">
    
    <?php if ( $section != "recover" ){ ?>

        <div class="appbox rel">
            
            <h1 style="text-align:center;margin:40px 10px 0 10px;" class="s50 b900">
                <?php echo $section == 'login' ? "Welcome back! Let's get started." : "Welcome! Create your account to get started."; ?>
            </h1>
                
            <div class="pbox-wrapper abs">
                <div class="pboxes rel flex aic jc">
                    <div class="pbox2 flex aic jc rel">
                        <?php foreach ($imgs[0] as $i => $url): ?>
                            <img class="abs img<?= $i ?>" src="/ui/images/<?= $url ?>" alt="Image <?= $url ?>" />
                        <?php endforeach; ?>
                        <div class="pbox3 flex aic jc rel">
                            <?php foreach ($imgs[1] as $url): ?>
                                <img class="abs img<?= $i ?>" src="/ui/images/<?= $url ?>" alt="Image <?= $url ?>" />
                            <?php endforeach; ?>
                            <div class="pbox4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="formbox rel flex aic jc">
        
        <?php include( __DIR__ . "/cover.php"); ?>

        <?php 
        //RECOVER
        if($section == 'recover'){ 
            
            if(isset($_GET['token']) && !empty($_GET['token'])){

                @list($UID, $ucode, $email) = explode(Config::SEPERATOR, Core::Decode($_GET['token']));    
                $get = DB::SELECT("SELECT * FROM users WHERE ID=? AND ucode=? AND email=? LIMIT 1", array($UID, $ucode, $email));

                if($get->hasRows){ ?>

                <div class="signin block flex col rel" style="max-width: 700px;min-width: 700px;margin: 0 auto;">

                    <div class="ahead">
                        <h2 class="slogan s40 b900">Update Password.</h2>  
                        <h2 class="slogan2 s16 bold">Choose a strong password<br />(Use Alphanumeric with special characters).</h2>   
                    </div>

                    <div class="uform flex col rel">
                        
                        <input type="password" autocomplete="new-password" placeholder="New Password." class="input _passw s18" />
                        <input type="password" autocomplete="new-password" placeholder="Repeat Password." class="input _repassw s18" />
                        
                        <button class="bold buton s18 recv-meup" style="margin-top: 30px;">Update</button>

                    </div>
                    
                </div>

                <?php }else{
                    echo '<div class="error-404 jc flex aic rel">
                        <h2 class="s18 bold">:)</h2>
                        <h2 class="s18 font">Invalid Recovery Token</h2>
                    </div>';
                }

            }else{    
        ?>

            <div class="signin block flex col rel" style="max-width: 700px;min-width: 700px;margin: 0 auto;">

                <div class="ahead">
                    <h2 class="slogan s40 b900">Recover Account.</h2>  
                    <h2 class="slogan2 s16 bold">Enter your email associated with <?php echo Config::APP_NAME; ?>.</h2>   
                </div>

                <div class="uform flex col rel">

                    <input type="text" placeholder="Enter your email." class="input _username s18" />
                    <button class="bold buton s18 recv-mein" style="margin-bottom: 30px;">Continue</button>

                    <div class="cat s18">Already have account? <a href="/u/login?v=<?php echo time(); ?>" class="tdnh s18 bold">Sign in here</a></div>

                </div>
                    
            </div>

        <?php } 
    
        }else{ ?>

        <?php if($section == 'login'){ ?><div class="signin block flex col rel">
            

            <div class="ahead">
                <h2 class="slogan s40 b900">Sign in</h2>  
                <h2 class="slogan2 s16 bold">Never enter your password on a device that you do not fully trust.<br /> Do not log into your account from a shared or public computer.</h2>   
            </div>

            <div class="uform flex col rel">
                <input type="text" placeholder="Enter your email." class="input _username s18" />
                <input type="password" placeholder="Your Password." class="input _passw s18" />
                
                <button class="bold buton s18 sin-mein">Sign in</button>

                <a href="<?php echo Config::BASEURL . 'u/recover?v=' . time(); ?>" class="flex ass tdnh s18 bold">Forgot Password?</a>
                <div class="cat s18">New here? <a href="<?php echo Config::BASEURL . 'u/create?v=' . time(); ?>" class="tdnh s18 bold">Create Account</a></div>
            </div>
                
        </div><?php } ?>


        <?php if($section == 'create'){ ?><div class="signin signup block flex col rel">
            
            <div class="ahead">
                <h2 class="slogan s40 b900">Join <?php echo Config::APP_NAME; ?></h2>  
                <h2 class="slogan2 s18">Create account and feel the power of our system.</h2>   
            </div>

            <div class="uform flex col rel">
                <input type="text" autocomplete="new-password" placeholder="Enter your email." class="input _username s18" />
                <input type="password" autocomplete="new-password" placeholder="Your Password." class="input _passw s18" />
                <input type="password" autocomplete="new-password" placeholder="Repeat Password." class="input _repassw s18" />
                
                <div class="flex aic agree">
                    <button class="app-checkbox" data-value="0"></button>
                    <h2 class="s18">I agree to <a href="<?php echo Config::BASEURL; ?>help/tos" class="tdnh bold"><?php echo Config::APP_NAME; ?> terms</a></h2>
                </div>
                <button class="bold buton s18 sin-meup">Create Account</button>
            </div>
                
        </div><?php } ?>

        <?php } ?>
    </div>

</div>