<link rel="stylesheet" href="<?php echo BASEURL . 'ui/app/css/admin.css?v=' . $APP_VERSION; ?>" /><?php 
if(isset($_PARAMS->section)){
shouldSignin(); 
?>
    
<div class="in-header flex col sticky">

    <div class="menu-logo flex aic s20">
        <a href="<?php echo BASEURL . "cp?v=" . time(); ?>" class="tdn nous flex aic">
            <div class="s30 icon-vr-cardboard"></div>
            Admin
        </a>
    </div>
    <div class="flex primary-nav col">
        <?php 
            $nav = array(
                array( 'id' => 'dashboard', 'to' => 'am/dashboard', 'icon' => 'th-large', 'label' => 'Dashboard' ),
                array( 'id' => 'users', 'to' => 'am/users', 'icon' => 'wave-square', 'label' => 'Users' ),
                array( 'id' => 'payments', 'to' => 'am/payments', 'icon' => 'window-alt', 'label' => 'Payments' ),
                // array( 'id' => 'servers', 'to' => 'am/servers', 'icon' => 'cog', 'label' => 'Servers' ),
                array( 'id' => 'settings', 'to' => 'am/settings', 'icon' => 'shield', 'label' => 'Settings' )
            );
            foreach($nav as $n):
                echo '<a href="' . BASEURL . $n['to'] . '?v=' . time() . '" class="link flex aic s16' . ($_PARAMS->section == $n['id'] ? ' on' : '') . '">
                    <div class="image anim icon-' . $n['icon'] . ' dashboard"></div>
                    <div class="primary-menu-item-name anim">' . $n['label'] . '</div>
                </a>';
            endforeach;
            echo '<a href="javascript:;" class="link flex aic s16 logout">
                <div class="image anim icon-sign-out-alt dashboard"></div>
                <div class="primary-menu-item-name anim">Logout</div>
            </a>';
        ?>
    </div>
</div>

<div class="in-page rel flex col">
    <?php
        if(file_exists( __DIR__ . '/admin/' . $_PARAMS->section . '.php')){
            include( __DIR__ . '/admin/' . $_PARAMS->section . '.php' );
        }else{
            echo '<div class="empty rel flex aic jc col">
                <h2 class="s20 font b s1">You are lost!</h2>
            </div>';
        }
    ?>
</div>

<?php }else{
    shouldNotSignin("am/dashboard"); 
    include( __DIR__ . '/admin/signin.php' );
} ?>