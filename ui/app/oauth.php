<?php if(!isset($_PARAMS->token)){ shouldNotSignin('cp'); } ?>
<div class="account<?php echo $isUser ? ' inc' : ''; ?> flex rel blurify" section="<?php echo $_PARAMS->section; ?>">

    <div class="form flex col rel"<?php echo isset($_GET['em']) ? ' style="width: auto !important;"' : ''; ?>>
        <?php echo Cover('rgba()'); ?>

        <?php if($_PARAMS->section == 'verify'){ 
            
            $cls = 'rel';
            $verify = U::VerifyToken('get', 'email');
            if($isUser){ 
                $cls = 'abs abc';
                echo '<div class="page flex">'; }
            
            if($verify == 'tokenVerified'){
                echo '<div class="done ' . $cls . ' flex aic jc col" style="width: auto !important;">
                    <div class="ico icon-check-circle red s50"></div>
                    <h2 class="ttl s20 font bold">Good Job</h2>
                    <h2 class="msg s16 font">Your email is verified now. Enjoy!</h2>
                </div>';
            }else if($verify == 'emVerified'){
                echo '<div class="done ' . $cls . ' flex aic jc col" style="width: auto !important;">
                    <div class="ico icon-plus-circle red s50" style="transform: rotate(45deg);"></div>
                    <h2 class="ttl s20 font bold">Already verified</h2>
                    <h2 class="msg s16 font">Your email is already verified boy! Don\'t worry</h2>
                </div>';
            }else{
                echo '<div class="done ' . $cls . ' flex aic jc col" style="width: auto !important;">
                    <div class="ico icon-plus-circle red s50" style="transform: rotate(45deg);"></div>
                    <h2 class="ttl s20 font bold">Nice Try</h2>
                    <h2 class="msg s16 font">Invalid Recovery Token</h2>
                </div>';
            }

            if($isUser){ echo '</div>'; }

            // echo '<div class="done rel flex aic jc col">
            //     <div class="ico icon-check-circle color s72"></div>
            //     <h2 class="ttl s20 b">That was easy :)</h2>
            //     <h2 class="msg s16 font">We have sent verification email to<div class="b" style="margin-bottom: 15px;">' . $em . '</div>Go check.</h2>
            //     <a href="' . BASEURL . '?_t=' . time() . '" class="noul b s15 cfff button">Continue</a>
            // </div>';

        }else if($_PARAMS->section == 'recover'){ ?>
            <?php if(isset($_GET['token']) && !empty($_GET['token'])){ 
                @list($UID, $ucode, $email) = explode("@@", decode($_GET['token']));    
                $get = DB::SELECT("SELECT * FROM users WHERE ID=? AND ucode=? AND email=? LIMIT 1",
                array($UID, $ucode, $email), "iss");
            if($get->hasRows && $get->count > 0){ ?>    

                <div class="sect rel">
                    <h2 class="b s24 lb">Update Password.</h2>
                    <h2 class="s16 lb">Choose a strong password<br />(Use Alphanumeric with special characters).</h2>
                </div>
                <div class="sect rel">
                    <input type="password" autocomplete="new-password" placeholder="New Password." class="input _passw s16" />
                    <input type="password" autocomplete="new-password" placeholder="Repeat Password." class="input _repassw s16" />
                </div>
                <button class="b cfff button s16 _try_recap" style="margin-top: 10px;">Update</button>
                <div class="fotr"></div>
                <div class="fotr"></div>

            <?php 
                }else{
                    echo '<div class="done rel flex aic jc col" style="width: auto !important;">
                        <div class="ico icon-close-circle red s50"></div>
                        <h2 class="ttl s20 b">Nice Try :)</h2>
                        <h2 class="msg s16 font">Invalid Recovery Token</h2>
                    </div>';
                }
            }else { ?>
                <div class="sect rel">
                    <h2 class="b s24 lb">Recover Account</h2>
                    <h2 class="s16 lb">Enter your email associated with <?php echo APP_NAME; ?>.</h2>
                </div>
                <div class="sect rel">
                    <input type="text" placeholder="hello@example.com" class="input _username s16" />
                </div>
                <button class="b cfff button s16 _try_recover" style="margin-top: 10px;">Continue</button>
                <div class="fotr"></div>
                <div class="fotr"></div>
            <?php } ?>
        <?php }else{ ?>

            <?php if($_PARAMS->section == 'signin'){ ?>
                
                <div class="sect rel flex col aic jcc">
                    <!-- <div class="s50 icon-vr-cardboard"></div> -->
                    <h2 class="b900 s36 tc lb">Welcome Back</h2>
                    <h2 class="s18 tc lb">Please enter your e-mail and password</h2>
                </div>
                <div class="sect rel">
                    <input type="text" placeholder="hello@example.com" class="input _username s16" />
                </div>
                <div class="sect rel">
                    <input type="password" placeholder="password" class="input _password s16" />
                </div>
                
                <div class="flex aic" style="margin-top: 10px;z-index: 1;">
                    <button class="bold cfff button s16 _try_sin">Sign in</button>
                    <div class="flex aic jce" style="flex: 1;">
                        <a href="<?php echo BASEURL . 'u/recover'; ?>" class="r tdn tdnh color bold s15">Forgot Password?</a>
                    </div>
                </div>

                <div class="spt flex col" style="margin-top: 60px;z-index: 1;">                    
                    <a href="<?php echo BASEURL . 'u/signup' . (isset($_GET['next']) ? '?next=' . urlencode(urldecode($_GET['next'])) : ''); ?>" class="anim tdn mbt bold s16">Sign up for <?php echo APP_NAME; ?></a>
                </div>

            <?php } ?>

            <?php if($_PARAMS->section == 'signup'){  
                if(isset($_GET['em'])){
                    $em = urldecode($_GET['em']);
                    echo '<div class="done rel flex aic jc col">
                        <div class="ico icon-check-circle color s72"></div>
                        <h2 class="ttl s20 b">That was easy :)</h2>
                        <h2 class="msg s16 font">We have sent verification email to<div class="b" style="margin-bottom: 15px;">' . $em . '</div>Go check.</h2>
                        <a href="' . BASEURL . '?_t=' . time() . '" class="noul b s15 cfff button">Continue</a>
                    </div>';
                }else{
            ?>
                
                <div class="sect rel flex col aic jcc">
                    <h2 class="b900 s30 tc lb">Sign up to Start Monitoring</h2>
                    <h2 class="s18 tc lb">No commitment. Cancel anytime.</h2>
                </div>
                
                <div class="sect rel">
                    <input type="text" placeholder="John Doe" class="input _fullname s16" />
                </div>
                <div class="sect rel">
                    <input type="text" placeholder="hello@example.com" class="input _username s16" />
                </div>
                <div class="sect rel">
                    <input type="password" placeholder="New Password" class="input _password s16" />
                </div>
                <div class="sect rel">
                    <input type="password" placeholder="Repeat Password" class="input _repassword s16" />
                </div>
                <div class="sect rel agree flex aic">
                    <label class="checkbox">
                        <input type="checkbox" value="1" id="i-agree" />
                        <div class="-slide rel"></div>
                    </label>
                    <h2 class="s16 font">I agree to <a href="<?php echo BASEURL; ?>help/terms" class="color tdn tdnh b"><?php echo APP_NAME; ?> terms</a></h2>
                </div>
                
                <button class="b cfff button s16 _try_sup" style="margin-top: 10px;">Create Account</button>

                <h2 class="s16" style="padding: 30px;">By signing up you agree to our <a href="<?php echo BASEURL . 'help/terms'; ?>" class="tdn tdnh bold color">Terms and Conditions</a> and <a href="<?php echo BASEURL . 'help/privacy'; ?>" class="tdn tdnh bold color">Privacy Policy</a></h2>

            <?php 
                }
            } ?>


        <?php } ?>
        
        
    </div>

</div><div class="fotr"></div>