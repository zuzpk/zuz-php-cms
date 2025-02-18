<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="<?php echo THEME; ?>images/favicon.png">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="Manage all your files in one place.">
    <link rel="apple-touch-icon" href="<?php echo THEME; ?>ui/logo192.png">
    <title><?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link href="<?php echo THEME . 'css/props.css?v=' . $APP_VERSION; ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://icons.zuzcdn.net/public/oz53Vr3Jr0/style.css" />
    <link href="<?php echo THEME . 'css/styles.css?v=' . $APP_VERSION; ?>" rel="stylesheet">
    <link href="<?php echo THEME . 'css/media.css?v=' . $APP_VERSION; ?>" rel="stylesheet">

</head>
<body class="rel<?php echo $isUser ? ' u' : ''; ?>">

<div class="app flex <?php echo $isUser ? 'aic' : 'col guest'; ?>"
<?php 
    echo !$isUser ? 'style="background: url(' . THEME . 'images/waves.svg?v=1) no-repeat bottom;"' : '';
?>>

<?php global $_PAGE; 
if(Cog('app_status') == '1' && $_PAGE != "admin" && $_PAGE != "kpay"){ ?>
<div class="primary-nav-user-menu fixed flex col">
    <?php
        if($isUser){ ?><div class="uinfo flex aic">
            <div class="u s18 bold flex rel jcc aic<?php echo isset($_USER->me->pro) ? ' pro' : ''; ?>"><?php echo $_USER->me->nm[0]; ?></div>
            <div class="uim flex col">
                <div class="unm wordwrap b"><?php echo $_USER->me->nm; ?></div>
                <div class="uem s14 c777 wordwrap"><?php echo $_USER->me->em; ?></div>
            </div>            
        </div>
        <div class="uinfo prou flex col">
            <?php 
            echo '<h1 class="s16 bold">' . (isset($_USER->me->pro) ? "Pro " . $_USER->me->pro->plan : "Free") . '</h1>';
            if(isset($_USER->me->pro)){
                echo '<h1 class="s15 c777">' . $_USER->me->pro->expiry . '</h1>';
            }
            ?>
        </div>
        <div class="rev flex col">
            <?php              
                $plan_uptime_checks = 1;
                $plan_testing_interval = 1;
                $plan_advance_check = 1;
                $plan_speed = 1;
                $plan_ssl = 1;
                $plan_rum = 1;
                $plan_reports = 1;
                $plan_alerts = 1;
                $plan_pages = 1;
                $plan_integrations = 1;
                $plan_mu = 1;
                
                $plan_uid = fromHash($_USER->me->ID);
                $total_uptime_checks = DB::SELECT("SELECT COUNT(ID) as total FROM apps WHERE uid=? AND type=?", array($plan_uid, "web"), "is")->row->total;
                $total_rum_checks = DB::SELECT("SELECT COUNT(ID) as total FROM apps WHERE uid=? AND type=?", array($plan_uid, "real-user"), "is")->row->total;
                
                if(isset($_USER->me->pro)){
                    global $proPlans;
                    foreach($proPlans as  $plan):
                        if($plan['id'] == $_USER->me->pro->id){
                            @list(
                                $plan_uptime_checks, 
                                $plan_testing_interval, 
                                $plan_advance_check,
                                $plan_speed,
                                $plan_ssl,
                                $plan_rum,
                                $plan_reports,
                                $plan_alerts,
                                $plan_pages,
                                $plan_integrations,
                                $plan_mu
                            ) = $plan['features'];
                            @list($rumTotal, $rumViews) = explode("~", $plan_rum);
                            $plan_rum = $rumViews;
                            break;
                        }
                    endforeach;
                }

                $rev = array(
                    array(
                        'lbl' => 'Upime Monitors',
                        'value' => "$total_uptime_checks/$plan_uptime_checks",
                    ),
                    array(
                        'lbl' => 'Advanced Monitors',
                        'value' => "$total_uptime_checks/$plan_advance_check",
                    ),
                    array(
                        'lbl' => 'SSL Monitors',
                        'value' => "$total_uptime_checks/$plan_ssl",
                    ),
                    array(
                        'lbl' => 'Domain Monitors',
                        'value' => "0/$plan_pages",
                    ),
                    array(
                        'lbl' => 'RUM Pageviews',
                        'value' => "$total_rum_checks/$plan_rum",
                    )
                );
                foreach($rev as $q):
                    echo '<div class="rvi flex aic"><div>' . $q['value'] . '</div>'
                        . $q['lbl'] .'
                    </div>';
                endforeach;
            ?>            
        </div>
        <div class="uout">
            <a href="javascript:;" class="link logout flex aic s14">
                <div class="image icon-sign-out-alt s16"></div>
                Log out
            </a>
        </div>        
        <?php
        }?>
</div>
<?php if($isUser){ ?>

<div class="small-header hided flex aic">
    <div class="flex aic jcc log">
        <a href="<?php echo BASEURL . "cp?v=" . time(); ?>" class="tdn nous flex aic s24 b900">
            <img width="30px" src="<?php echo BASEURL . 'ui/app/images/web-logo.png'; ?>" alt="<?php echo APP_NAME . ' Logo'; ?>" />
            <h2 style="font-size: 20px;font-weight: 900;text-transform: uppercase;"><?php echo APP_NAME; ?></h2>
        </a>
    </div>
    <button class="mob-menu abs"><div></div><div></div><div></div></button>    
</div>

<div class="in-header flex col sticky">
    <div class="menu-logo hidem flex aic s20">
        <a href="<?php echo BASEURL . "cp?v=" . time(); ?>" class="tdn nous flex aic">
            <img width="30px" src="<?php echo BASEURL . 'ui/app/images/web-logo.png'; ?>" alt="<?php echo APP_NAME . ' Logo'; ?>" />
            <h2 style="font-size: 18px;font-weight: 900;text-transform: uppercase;"><?php echo APP_NAME; ?></h2>
        </a>
    </div>

    <div class="flex primary-nav col">
        <?php 
            $nav = array(
                array( 'id' => 'cp', 'to' => 'cp', 'icon' => 'th-large', 'label' => 'Dashboard' ),
                array( 'id' => 'monitoring', 'to' => 'monitoring/uptime', 'icon' => 'wave-square', 'label' => 'Monitoring' ),
                array( 'id' => 'reporting', 'to' => 'reporting/contacts', 'icon' => 'window-alt', 'label' => 'Reporting' ),
                array( 'id' => 'settings', 'to' => 'settings/basic', 'icon' => 'cog', 'label' => 'Settings' ),
                array( 'id' => 'subscription', 'to' => 'pro/plans', 'icon' => 'shield', 'label' => 'Subscription' )
            );
            foreach($nav as $n):
                echo '<a href="' . BASEURL . $n['to'] . '?v=' . time() . '" class="link flex aic s16' . ($_PAGE == $n['id'] ? ' on' : '') . '">
                    <div class="image anim icon-' . $n['icon'] . ' dashboard"></div>
                    <div class="primary-menu-item-name anim">' . $n['label'] . '</div>
                </a>';
            endforeach;
        ?>
    </div>

    <div class="flex aic rel primary-nav" style="flex: none;">
        <a href="javascript:;" class="link user flex aic">
            <div class="u flex aic jcc rel s16 bold<?php echo isset($_USER->me->pro) ? ' pro' : ''; ?>"><?php echo $_USER->me->nm[0]; ?></div>
            <div class="flex col">
                <h2 class="s16 b"><?php echo $_USER->me->nm; ?></h2>
                <h2 class="s15 wordwrap" style="max-width: 80%;"><?php echo $_USER->me->em; ?></h2>
            </div>
        </a>
        
    </div>
</div><?php }else{ 
    // echo '<style>:root{ --primary: #3f4f54; }</style>';
    ?>
    <div class="header flex aic sticky">

        <button class="mob-menu abs flex col hided"><div></div><div></div><div></div></button>    

        <div class="menu-logo flex aic"><a href="<?php echo BASEURL . '?sv=' . time(); ?>" class="tdn nous flex aic">
            <img width="40px" src="<?php echo BASEURL . 'ui/app/images/web-logo.png'; ?>" alt="<?php echo APP_NAME . ' Logo'; ?>" />
            <h2 style="font-size: 20px;font-weight: 900;text-transform: uppercase;"><?php echo APP_NAME; ?></h2>
        </a></div>

        <div class="flex aic primary-nav jcc hidem" style="flex: 2;">
            <?php 
                $nav = array(
                    array( 'id' => 'pricing', 'to' => 'pricing', 'icon' => 'shopping-bag', 'label' => 'Pricing' ),
                    array( 
                        'id' => 'products', 'to' => '#', 'icon' => 'shapes', 'label' => 'Products',
                        'items' => array(
                            array('id' => 'website_uptime_monitoring', 'to' => 'website-uptime-monitoring', 'icon' => 'waveform-path', 'label' => 'Website Uptime Monitoring', 'txt' => 'Monitor the uptime of HTTP, HTTPS, DNS, UDP, TCP, email and more.' ),
                            array('id' => 'website_speed_monitoring', 'to' => 'website-speed-monitoring', 'icon' => 'tachometer-alt-fast', 'label' => 'Website Speed Monitoring', 'txt' => 'Monitor full website performance by loading it with a real Chrome browser.' ),
                            array('id' => 'website_transaction_monitoring', 'to' => 'website-transaction-monitoring', 'icon' => 'file-alt', 'label' => 'Website Transaction Monitoring', 'txt' => 'Monitor web transactions (login-forms, checkout-forms, etc.) and be notified if something goes wrong.' ),
                            array('id' => 'website_real_user_monitoring', 'to' => 'website-real-user-monitoring', 'icon' => 'user-friends', 'label' => 'Website Real User Monitoring', 'txt' => 'Monitor the speed of user experience for visitors to your website' )
                        )
                    ),
                    array( 
                        'id' => 'free-tools', 'to' => '#', 'icon' => 'trophy-alt', 'label' => 'Free Tools',
                        'items' => array(
                            array('id' => 'website_availability_monitoring', 'to' => 'website-availability-test', 'icon' => 'satellite-dish', 'label' => 'Website Availability Test', 'txt' => 'Use this tool to find out if your website is available from 30+ different locations worldwide.' )
                        )
                    ),
                    array( 
                        'id' => 'help', 'to' => '#', 'icon' => 'umbrella', 'label' => 'Support',
                        'items' => array(
                            array('id' => 'knowledge_base', 'to' => 'knowledge-base', 'icon' => 'question-circle', 'label' => 'Knowledge Base', 'txt' => 'Find answers to the most frequently asked questions and learn how to use ' . APP_NAME .'.' ),
                            array('id' => 'contact-us', 'to' => 'contact-us', 'icon' => 'envelope-open-text', 'label' => 'Contact Us', 'txt' => 'If you have any questions, feel free to send us a message.' )
                        )
                    ),
                );
                foreach($nav as $n):
                    echo '<div class="rel nav-block"><a href="' . BASEURL . $n['to'] . '" class="link flex aic jcc s16' . ($_PAGE == $n['id'] ? ' on' : '') . '">
                        <div class="image icon-' . $n['icon'] . ' dashboard"></div>
                        <div class="primary-menu-item-name bold">' . $n['label'] . '</div>
                        ' . (isset($n['items']) ? "<div class=\"icon-chevron-down s14\"></div>" : "") . '
                    </a>';
                    if(isset($n['items'])){
                        echo '<div class="sub-menu abs">';
                        foreach($n['items'] as $i):
                            echo '<a href="' . ($i['to'] == '#' ? 'javascript:;' : BASEURL . $i['to']) . '" class="link flex col s16' . ($_PAGE == $i['id'] ? ' on' : '') . '">
                                <div class="flex aic">
                                    <div class="image icon-' . $i['icon'] . ' dashboard"></div>
                                    <div class="primary-menu-item-name bold">' . $i['label'] . '</div>
                                </div>
                                <p class="s14">' . $i['txt'] . '</p>
                            </a>';
                        endforeach;
                        echo '</div>';
                    }
                    echo '</div>';
                endforeach;
            ?>
        </div>
        
        <div class="flex aic primary-nav hidem jce">
            <?php 
                $nav = array(
                    array( 'id' => 'signin', 'to' => 'u/signin', 'icon' => 'user-circle', 'label' => 'Sign in' ),
                    array( 'id' => 'try', 'to' => 'u/signup', 'icon' => 'sign', 'label' => 'Create Account' )
                );
                foreach($nav as $n):
                    echo '<a href="' . BASEURL . $n['to'] . '" class="' . $n['id'] . ' link flex aic s16' . ($_PAGE == $n['id'] ? ' on' : '') . '">
                        <div class="image icon-' . $n['icon'] . ' dashboard"></div>
                        ' . ( empty($n['label']) ? '' : '<div class="primary-menu-item-name bold">' . $n['label'] . '</div>' ) . '
                    </a>';
                endforeach;
            ?>
        </div>


    </div>


    <div class="flex aic mob-nav primary-nav jcc fixed hided">
        <h1 class="s24 menu-title b900">MENU</h1>   
        <?php 
            $nav = array(
                array( 'id' => 'pricing', 'to' => 'pricing', 'icon' => 'shopping-bag', 'label' => 'Pricing' ),
                array( 
                    'id' => 'products', 'to' => '#', 'icon' => 'shapes', 'label' => 'Products',
                    'items' => array(
                        array('id' => 'website_uptime_monitoring', 'to' => 'website-uptime-monitoring', 'icon' => 'waveform-path', 'label' => 'Website Uptime Monitoring', 'txt' => 'Monitor the uptime of HTTP, HTTPS, DNS, UDP, TCP, email and more.' ),
                        array('id' => 'website_speed_monitoring', 'to' => 'website-speed-monitoring', 'icon' => 'tachometer-alt-fast', 'label' => 'Website Speed Monitoring', 'txt' => 'Monitor full website performance by loading it with a real Chrome browser.' ),
                        array('id' => 'website_transaction_monitoring', 'to' => 'website-transaction-monitoring', 'icon' => 'file-alt', 'label' => 'Website Transaction Monitoring', 'txt' => 'Monitor web transactions (login-forms, checkout-forms, etc.) and be notified if something goes wrong.' ),
                        array('id' => 'website_real_user_monitoring', 'to' => 'website-real-user-monitoring', 'icon' => 'user-friends', 'label' => 'Website Real User Monitoring', 'txt' => 'Monitor the speed of user experience for visitors to your website' )
                    )
                ),
                array( 
                    'id' => 'free-tools', 'to' => '#', 'icon' => 'trophy-alt', 'label' => 'Free Tools',
                    'items' => array(
                        array('id' => 'website_availability_monitoring', 'to' => 'website-availability-test', 'icon' => 'satellite-dish', 'label' => 'Website Availability Test', 'txt' => 'Use this tool to find out if your website is available from 30+ different locations worldwide.' )
                    )
                ),
                array( 
                    'id' => 'help', 'to' => '#', 'icon' => 'umbrella', 'label' => 'Support',
                    'items' => array(
                        array('id' => 'knowledge_base', 'to' => 'knowledge-base', 'icon' => 'question-circle', 'label' => 'Knowledge Base', 'txt' => 'Find answers to the most frequently asked questions and learn how to use ' . APP_NAME .'.' ),
                        array('id' => 'contact-us', 'to' => 'contact-us', 'icon' => 'envelope-open-text', 'label' => 'Contact Us', 'txt' => 'If you have any questions, feel free to send us a message.' )
                    )
                ),
            );
            foreach($nav as $n):
                echo '<div class="rel nav-block"><a href="' . BASEURL . $n['to'] . '" class="link flex aic s16' . ($_PAGE == $n['id'] ? ' on' : '') . '">
                    <div class="image icon-' . $n['icon'] . ' dashboard"></div>
                    <div class="primary-menu-item-name bold">' . $n['label'] . '</div>
                    ' . (isset($n['items']) ? "<div class=\"icon-chevron-down s14\"></div>" : "") . '
                </a>';
                if(isset($n['items'])){
                    echo '<div class="sub-menu flex col">';
                    foreach($n['items'] as $i):
                        echo '<a href="' . ($i['to'] == '#' ? 'javascript:;' : BASEURL . $i['to']) . '" class="link flex col s16' . ($_PAGE == $i['id'] ? ' on' : '') . '">
                            <div class="flex aic dv">
                                <div class="image icon-' . $i['icon'] . ' dashboard"></div>
                                <div class="primary-menu-item-name bold">' . $i['label'] . '</div>
                            </div>
                            <p class="s14 hidem">' . $i['txt'] . '</p>
                        </a>';
                    endforeach;
                    echo '</div>';
                }
                echo '</div>';
            endforeach;

            $nav = array(
                array( 'id' => 'signin', 'to' => 'u/signin', 'icon' => 'user-circle', 'label' => 'Sign in' ),
                array( 'id' => 'try', 'to' => 'u/signup', 'icon' => 'sign', 'label' => 'Create Account' )
            );
            foreach($nav as $n):
                echo '<a href="' . BASEURL . $n['to'] . '" class="' . $n['id'] . ' link flex aic s16' . ($_PAGE == $n['id'] ? ' on' : '') . '">
                    <div class="image icon-' . $n['icon'] . ' dashboard"></div>
                    ' . ( empty($n['label']) ? '' : '<div class="primary-menu-item-name bold">' . $n['label'] . '</div>' ) . '
                </a>';
            endforeach;

        ?>
    </div>


<?php } 
} ?>