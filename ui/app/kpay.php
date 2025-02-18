<?php
if(!isset($_GET['utc_reff'])){ 
    if( !isset($_SERVER['HTTP_REFERER']) ||  empty($_SERVER['HTTP_REFERER']) ){  header("location: " . BASEURL . "pricing?_wx=2"); exit; }
    $allowed_reff = array( 'premiumsturkiye.com', 'www.premiumsturkiye.com', 'uat.kshared.com', 'kshared.com', 'www.kshared.com', 'jump.enhelpdesk.com', 'www.enhelpdesk.com' );
    $_reff = parse_url($_SERVER['HTTP_REFERER']);
    if(!in_array( $_reff['host'] , $allowed_reff )){ header("location: " . BASEURL . "pricing?_wx=3&" . $_reff['host']); exit; }
    if( !isset($_GET['wx']) || !isset($_GET['token']) || empty($_GET['wx']) || empty($_GET['token']) ){ header("location: " . BASEURL . "pricing?_wx=1"); exit; }
}
if(!isset($_GET['utc_reff'])){
    echo 'Redirecting...';
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '&utc_reff=' . time();
    echo '<script>setTimeout(() => window.location = "' . $url . '", 2000);</script>';
    exit;
}

if(isset($_GET['ccd'])){
    echo '<div class="premium appify rel flex aic jcc premium-auto">
        <div class="plans flex col rel">
            <div class="kpay flex col">
                <div class="klogo rel" style="transform: scale(1);width: 50px;margin: 30px auto 0px auto;"> <div class="p rel"></div> <div class="t abs"></div> </div>
                <div class="done rel flex aic jc col" style="margin: 100px;width: auto !important;">
                    <div class="ico icon-check-circle color s50"></div>
                    <h2 class="ttl s20 font b">Nice and easy</h2>
                    <h2 class="msg s16 font">Your payment is processed and account is upgrade to pro plan.</h2>
                </div>
            </div>
        </div>
    </div>';
}else{
@list($trxid, $umail, $uplan, $_uprice, $umod, $verifyUrl, $reportUrl) = explode( "@@", decode($_GET['token'], $_GET['wx']) );

$_uplan = match($uplan){
    '1' => 'person',
    '3' => 'pro',
    '6' => 'team',
    '12' => 'business'
};
$uprice = Cog('price_' . $_uplan . '_mo');

//TODO: Verify
?>
<div class="premium appify rel flex aic jcc<?php echo isset($_GET['pmt']) ? ' premium-auto' : ''; ?>">

<div class="plans flex col rel">

    <?php include(__DIR__ . '/cover.php'); ?>

    <div class="kpay flex col">
        <div class="klogo rel"> <div class="p rel"></div> <div class="t abs"></div> </div>

        <div class="choose-pmt rel flex col">
            <h2 class="title tc s30 font b">Choose Payment Method</h2>
            <div class="flex aic jc cpv">
                <h2 class="s16 font">Choosen Plan: <span class="choosen-plan b">Personal</span></h2>
                &nbsp;&nbsp;&nbsp;&ndash;
                <button class="flex aic anim color font b noulh s16 change-plan">Change</button>
            </div>
            <div class="flex col choose-pmts" data-pmt="<?php echo isset($_GET['pmt']) ? $_GET['pmt'] : 'stp'; ?>">
                <?php if(isset($_GET['pmt']) && $_GET['pmt'] == 'cc'){ ?><button class="flex aic anim" data-id="stp">
                    <div class="icn"><img src="<?php echo BASEURL; ?>ui/cards.svg" /></div>
                    <h2 class="s16 font b">Credit Card 1</h2>
                </button><?php } ?>
                <?php if(isset($_GET['pmt']) && $_GET['pmt'] == 'pdl'){ ?><button class="flex aic anim" data-id="pdl">
                    <div class="icn"><img src="<?php echo BASEURL; ?>ui/cards.svg" /></div>
                    <h2 class="s16 font b">Credit Card 2</h2>
                </button><?php } ?>
                <?php if(isset($_GET['pmt']) && $_GET['pmt'] == 'ppl'){ ?><button class="flex aic anim" data-id="ppl">
                    <div class="icn"><img src="<?php echo BASEURL; ?>ui/paypal.svg" /></div>
                    <h2 class="s16 font b">Paypal</h2>
                </button><?php } ?>
            </div>
            <button class="flex aic anim button cfff font b s16 continue-buy">Continue</button>
        </div>

        <div class="kparts flex col">
            <h2 class="font s24 b spc">You are about to make the following payment:</h2>
            <?php if(isset($_GET['ref']) && $_GET['ref'] != '__'){ ?><h2 class="font amt s15" style="margin-top: 5px;">You are paying an authorized agent of <?php echo '<span class="b color">' . $_GET['ref'] . '</span>'; ?>, which will deliver the products or services.</h2><?php } ?>
            <div class="font s18 spc flex col" style="margin: 30px 0px;">
                <h2 class="font amt b s50"><span class="c777 s36">€</span><?php echo $uprice; ?></h2>
                <?php if(isset($_GET['ref']) && $_GET['ref'] != '__'){ ?><h2 class="font amt s16" style="margin-top: 5px;"><?php echo '<span class="b color">' . $_GET['ref'] . '</span> premium account'; ?></h2><?php } ?>
            </div>
                
            <div class="flex aic btns" style="margin: 20px 0px;">
                <div class="choose-kpay" id="kpay"><img src="<?php echo BASEURL . 'ui/app/images/visa.png'; ?>" /></div>
                <div class="choose-kpay" id="kpay"><img src="<?php echo BASEURL . 'ui/app/images/mastercard.png'; ?>" /></div>
            </div>

            <label class="flex agree s15 font">
                <div class="ck rel"><input type="checkbox" id="agree" /></div>
                <h2>I hereby confirm that I am above 18 years old and I am of the full legal age in my country of residence, location and country/countries nationality.</h2>
            </label>
            <button class="button s18 font b cfff buy-now" id="kpay" data-pad="<?php echo Cog('paddle_' . $_uplan . '_id', 0); ?>" data-em="<?php echo base64_encode($umail); ?>" data-id="<?php echo $_uplan; ?>" data-wx="<?php echo $_wx = uuid(16); ?>" data-kpay="<?php echo encode($trxid . '@@' . $umail . '@@' . $uplan . '@@' . $uprice, $_wx); ?>" data-vu="<?php echo encode($verifyUrl, $_wx); ?>" data-ru="<?php echo encode($reportUrl, $_wx); ?>">Continue</button>
            <h2 style="text-align: right;margin-top: 15px;" class="s12 font c777">You will be redirected to complete the payment</h2>
        </div>

        <div class="kform" style="display: none;" data-spk="<?php echo Cog('stripe_public_key', 'none'); ?>"><form id="payment-form">
            <div id="link-authentication-element">
                <!--Stripe.js injects the Link Authentication Element-->
            </div>
            <div id="payment-element">
                <!--Stripe.js injects the Payment Element-->
            </div>
            <button id="submit-kst" class="button s18 font b cfff" style="line-height: 1;padding: 10px 50px;border-radius: 10px;margin-top: 20px;">
                <div class="spinner hidden" id="spinner"></div>
                <span id="button-text">Pay now</span>
            </button>
            <div id="payment-message" class="hidden"></div>
        </form></div>

    </div>

</div>

<div class="fotr"></div></div>

<?php } ?>
<style>
:root{
    --primary: #ff5959;
    --secondary: #01ede6;
}
.cover{
    background: rgba(255,255,255,0.95);
}
.klogo{
    transform: scale(0.75);
    width: 0px;
    margin-bottom: 30px;
}
.klogo .p{
    width: 50px;
    height: 50px;
    background: var(--primary);
    border-radius: 0px 50% 50% 0px;
    opacity: 0.9;
    z-index: 2;
}
.klogo .t{
    width: 20px;
    height: 70px;
    background: var(--secondary);
    top: 0px;
    left: 0px;
    z-index: 1;
    border-radius: 0px 0px 50px 50px;
}
.premium{
    background: #fff8ef;
    min-height: 100vh;
    width: 100vw;
    align-items: baseline;}
.prpemium-auto .kpay .choose-pmt{ display: none; }
.premium .plans{
    max-width: 700px;
    margin: 0 auto;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
}
.premium .plans .plan{
    box-shadow: 0px 0px 0px transparent;
    border-right: 1px #e4ded6 solid;
    border-radius: 0px;
}
.kpay{ padding: 40px; }
.kpay .btns{
    margin: 20px 0px 30px 0px;
    gap: 20px;
}
.kpay .btns div{
    border: 0px;
    background: #fff;
    overflow: hidden;
}
.kpay .btns div img{
    width: 100%;
    max-width: 50px;
}
.kpay .buy-now{
    line-height: 1;
    padding: 10px 50px;
    border-radius: 10px;
    margin-top: 20px;
    align-self: flex-end;
}
.agree{
    align-items: baseline;
    margin: 20px 0px;
}
.agree .ck {
    top: 2px;
    margin-right: 10px;
}
</style>