<?php 
use \Zuz\Config;
use \Zuz\Core;
use \Zuz\User;
use \Zuz\Router;

if(Router::getCurrentPage() != "admin"){
?>
<div class="footer flex c111 rel">
    <div class="area flex col">
        <div class="logo flex rel">
            <a class="tdn c222" href="/">
                <div class="flex aic">
                    <img alt="<?php echo Config::APP_NAME; ?> Logo" src="/ui/images/app-icon.svg?v=1.3" height="32">
                    <h1 class="s24 b900 c111"><?php echo Config::APP_NAME; ?></h1>
                </div>
            </a>
        </div>
        <p class="s18">Being fully bootstrapped means we’re driven by passion, not profit. We cut through the noise to build exceptional apps with designers and developers, embracing a hands-on approach with a strict policy.</p>
        <h1 class="s18 bold flag flex aic">with <div class="icon-heart s20"></div> from <img alt="Netherlands" src="/ui/images/netherlands.png" width="20" /></h1>
    </div>
    <div class="area flex col aie je c111">
        <h2 class="s20 b900">General</h2>
        <a href="/help/tos" class="s16 bold tdn tdnh c111">Terms of Service</a>
        <a href="/help/privacy" class="s16 bold tdn tdnh c111">Privacy Policy</a>
    </div>
    <div class="area flex col aie je c111">
        <h2 class="s20 b900">Meet us</h2>
        <a href="/team" class="s16 bold tdn tdnh c111">Our Team</a>
        <a href="/help/contact" class="s16 bold tdn c111 tdnh">Contact Us</a>
        <a href="/help/about" class="s16 bold tdn c111 tdnh">About Us</a>
    </div>
</div>

<?php 
}

if( $GOOGLE_GA != '__'){ ?><script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $GOOGLE_GA; ?>"></script>
<script>
    window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date());
    gtag('config', 'G-1394468DDH');
</script><?php } ?>
<link rel="stylesheet" href="https://icons.zuzcdn.net/public/pE27JK86j0/style.css?v=<?php echo Config::DEBUG == 1 ? time() : Config::VERSION; ?>" />
<script defer src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script defer src="/ui/js/axios.js"></script>
<script defer src="/ui/js/cki.js"></script>
<script defer src="/ui/js/transit.js"></script>
<script defer src="/ui/js/scroll.js"></script>
<script defer src="/ui/js/tilt.js"></script>
<script defer src="/ui/js/idle.js"></script>
<script defer src="/ui/js/swiper.js"></script>
<script defer src="/ui/js/core.js"></script>
<script>var baseurl = "<?php echo Config::BASEURL; ?>", siteName = "<?php echo Core::GetCog('site_title'); ?>", sessout = 300, usi = "<?php echo Config::SESS_UI . ',' . Config::SESS_UT . ',' . Config::SESS_UD . ',' . Config::SESS_SI . ',' . Config::SESS_FIX; ?>", ume = <?php echo User::Session(false, false); ?>;</script>
<script defer src="/ui/js/app.js?v=<?php echo Config::DEBUG == 1 ? time() : Config::VERSION; ?>"></script>
<?php if(Router::getCurrentPage() != "admin"){ ?><script defer src="/ui/js/amin.js?v=<?php echo Config::DEBUG == 1 ? time() : Config::VERSION; ?>"></script><?php } ?>