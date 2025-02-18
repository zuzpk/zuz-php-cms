<?php shouldSignin();  ?><div class="monitoring page flex">
    <div class="flex secondary-nav col sticky">
        <?php 
            $section = $_PARAMS->section;
            $appon = isset($_PARAMS->appid) ? "/$_PARAMS->appid?v=" . time() : "";
            $appon = isset($_PARAMS->mode) ? "/$_PARAMS->mode?v=" . time() : "";
            $nav = array(
                array( 'id' => 'uptime', 'to' => 'monitoring/uptime' . $appon, 'label' => 'Uptime Monitoring' ),
                array( 'id' => 'ssl', 'to' => 'monitoring/ssl' . $appon, 'label' => 'SSL Monitoring' ),
                array( 'id' => 'speed', 'to' => 'monitoring/speed' . $appon, 'label' => 'Speed Monitoring' ),
                array( 'id' => 'transaction', 'to' => 'monitoring/transaction' . $appon, 'label' => 'Transaction Monitoring' ),
            );
            foreach($nav as $n):
                echo '<a href="' . BASEURL . $n['to'] . '" class="link ass flex aic s16' . ($section == $n['id'] ? ' on' : '') . '">
                    <div class="primary-menu-item-name">' . $n['label'] . '</div>
                </a>';
            endforeach;
        ?>
    </div>

    <div class="page-content rel">
        <?php 
            if(file_exists( __DIR__ . '/monitoring/' . $section . '.php' ) ){
                echo '<style>' . @file_get_contents( __DIR__ . '/monitoring/page.css' ) . '</style>';
                include( __DIR__ . '/monitoring/' . $section . '.php' );
            }else{
                Death(
                    '404',
                    'That section does not exist',
                    true
                );
            }
        ?>
    </div>


</div>