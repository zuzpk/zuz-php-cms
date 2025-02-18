<?php shouldSignin();  ?><div class="monitoring page flex">
    <div class="flex secondary-nav col sticky">
        <?php 
            $section = $_PARAMS->section;
            $nav = array(
                array( 'id' => 'plans', 'to' => 'pro/plans', 'label' => 'Plans' ),
                array( 'id' => 'methods', 'to' => 'pro/methods', 'label' => 'Payment Methods' ),
                array( 'id' => 'info', 'to' => 'pro/info', 'label' => 'Billing Info' ),
                array( 'id' => 'history', 'to' => 'pro/history', 'label' => 'Billing History' ),
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
            if(file_exists( __DIR__ . '/pro/' . $section . '.php' ) ){
                echo '<style>' . @file_get_contents( __DIR__ . '/pro/page.css' ) . '</style>';
                include( __DIR__ . '/pro/' . $section . '.php' );
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