<?php
use \Zuz\Config;
use \Zuz\Core;
use \Zuz\Router;
$section = Router::getParams()->section; 
// $section = isset($params->section) && $params->section == 'checkout';
?><div class="sidebar flex col">
    <div class="logo flex sticky">
        <a href="/cp/dashboard?cd=<?php echo time(); ?>" class="flex noul font b aic s18 nous">
            <div class="fav">
                <img src="/ui/app-icon.svg" />
            </div>
            <h2 class="s20 bold"><?php echo Core::GetCog('site_title'); ?></h2>
        </a>
    </div>

    <div class="nav hidem col flex rel">
        <a href="/cp/dashboard'; ?>" class="rel noul flex aic b link anim<?php echo $section == "dashboard" ? " color b on" : ""; ?>"><div class="icon-category-25 s24"></div>Dashboard</a>
        <a href="/cp/users'; ?>" class="rel noul flex aic b link anim<?php echo $section == "users" ? " color b on" : ""; ?>"><div class="icon-profile-2user5 s24"></div>Users</a>
        <a href="/cp/payments'; ?>" class="rel noul flex aic b link anim<?php echo $section == "payments" ? " color b on" : ""; ?>"><div class="icon-clipboard5 s24"></div>Payments</a>
        <a href="<?php echo Config::BASEURL . 'cp/servers'; ?>" class="rel noul flex aic b link anim<?php echo $section == "servers" ? " color b on" : ""; ?>"><div class="icon-driver5 s24"></div>Servers</a>
        <a href="<?php echo Config::BASEURL . 'cp/settings'; ?>" class="rel noul flex aic b link anim<?php echo $section == "settings" ? " color b on" : ""; ?>"><div class="icon-setting5 s24"></div>Settings</a>
        <a href="javascript:;" class="rel noul flex aic b link anim sin-meout"><div class="icon-logout-15 s24"></div>Sign out</a>
    </div>

</div>