<?php 
use \Zuz\Config;
use \Zuz\Core;
use \Zuz\Router;
use \Zuz\User;

$you = User::Session(false);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/ui/images/favicon.png?<?php echo Config::VERSION; ?>" type="image/png" sizes="64x64">
    <title><?php echo Config::APP_NAME; ?></title>
    <meta name="description" content="We build Web & Mobile Apps for businesses of all sizes, from startups to global enterprises.">
    <meta name="application-name" content="<?php echo Config::APP_NAME; ?>">
    <meta name="generator" content="<?php echo Config::APP_NAME; ?>">
    <meta name="referrer" content="origin-when-cross-origin">
    <?php 
        $GOOGLE_GA = Core::GetCog('google_ga');
        if( $GOOGLE_GA != '__'){
            echo '<link rel="preload" href="https://www.googletagmanager.com/gtag/js?id=' . $GOOGLE_GA . '" as="script">';
        }
        foreach( array('props', 'style', 'media', 'stars', 'swiper') as $css ):
            echo '<link rel="stylesheet" href="/ui/css/'. $css .'.css?v=' . ( Config::DEBUG == 1 ? time() : Config::VERSION ) . '" />';
        endforeach;
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="true">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&amp;display=swap" rel="stylesheet">
</head>
<body data-pg="<?php echo Router::getCurrentPage(); ?>" class="pg-<?php echo Router::getCurrentPage(); ?>">

<?php if(Router::getCurrentPage() != "admin"){ ?>

<div class="header sticky flex aic">
    
    <button class="s30 icon-menu only-mob sh-menu"></button>

    <div class="logo flex rel">
        <a class="tdn c222" href="/">
            <div class="flex aic">
                <img alt="<?php echo Config::APP_NAME; ?> Logo" src="/ui/images/app-icon.svg?v=1.3" height="32">
                <h1 class="s24 b900"><?php echo Config::APP_NAME; ?></h1>
            </div>
        </a>
    </div>

    <div class="robx flex aic jc nav only-desk">
        <?php 
            $nav = array(
                array( 'href' => '/', 'label' => 'Home', 'icon' => 'home-1' ),
                array( 'href' => '/services', 'label' => 'Services', 'icon' => 'briefcase' ),
                array( 'href' => '/apps', 'label' => 'Apps', 'icon' => 'emoji-happy' ),
            );
            foreach( $nav as $n ):
                echo '<a href="' . $n['href'] . '" aria-label="' . $n['label'] . '" data-mask-id="nav-' . Core::Slug($n['label']) . '" class="tdn s18 bold nous mask rel flex aic"><div class="s20 icon-' . $n['icon'] . '"></div>' . $n['label'] . '</a>';
            endforeach;
        ?>
    </div>

    <div class="robx flex aic je">
        <a href="/cart?ce=<?php echo time(); ?>" class="mycart anim rel s20 tdn" aria-label="Shopping Cart">
            <div class="icon-shopping_cart"></div>
        </a>
        <a href="/help/contact" aria-label="Contact us" data-mask-id="c-u" class="only-desk button tdn s18 bold nous mask rel">Contact Us</a>
        <?php if($you->sess){ ?>
            <a href="/profile?v=<?php echo time(); ?>" aria-label="My Account" data-mask-id="u-u" class="anim you button tdn s36 bold nous rel"><div class="icon-user-octagon"></div></a>
            <div id="user-menu" class="umenu abs flex col">
                <a href="/profile?v=<?php echo time(); ?>" class="tdn anim font s18">My Account</a>
                <a href="/my-apps?v=<?php echo time(); ?>" class="tdn anim font s18">My Apps</a>
                <a href="/u/signout?v=<?php echo time(); ?>" class="sin-meout tdn anim font s18">Sign out</a>
            </div>
        <?php }else{ ?>
            <a href="/u/login?v=<?php echo time(); ?>" aria-label="Sign in" data-mask-id="u-u" class="anim you button tdn s36 bold nous rel"><div class="icon-user-octagon"></div></a>
        <?php } ?>
    </div>

</div>

<div class="sidebar fixed flex col only-mob anim">
    
    <button class="s30 icon-close abs sh-menu"></button>

    <div class="logo flex rel">
        <a class="tdn c222" href="/">
            <div class="flex aic">
                <img alt="<?php echo Config::APP_NAME; ?> Logo" src="/ui/images/app-icon.svg?v=1.3" height="32">
                <h1 class="s24 b900"><?php echo Config::APP_NAME; ?></h1>
            </div>
        </a>
    </div>
        
    <h2 class="lill-more s14 opacity-75">MENU</h2>
    <div class="nav flex col">
    <?php 
        foreach( $nav as $n ):
            echo '<a href="' . $n['href'] . '" aria-label="' . $n['label'] . '" data-mask-id="nav-' . Core::Slug($n['label']) . '" class="tdn s24 bold rel">' . $n['label'] . '</a>';
        endforeach;
    ?>
    </div>
    
    <h2 class="lill-more s14 opacity-75">ABOUT</h2>
    <div class="nav-f nav flex col">
        <a href="/help/tos" class="s24 bold tdn">Terms of Service</a>
        <a href="/help/privacy" class="s24 bold tdn">Privacy Policy</a>
        <a href="/?our-team" class="s24 bold tdn">Our Team</a>
        <a href="/help/contact" class="s24 bold tdn">Contact Us</a>
    </div>

</div>

<?php } ?>