<?php shouldSignin();  ?><div class="settings page flex">
    <div class="flex secondary-nav col sticky">
        <?php 
            $section = $_PARAMS->section;
            $nav = array(
                array( 'id' => 'basic', 'to' => 'settings/basic', 'label' => 'Basic Info' ),
                array( 'id' => 'security', 'to' => 'settings/security', 'label' => 'Security' ),
                array( 'id' => 'maintenance', 'to' => 'settings/maintenance', 'label' => 'Maintenance' )
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
            if(file_exists( __DIR__ . '/settings/' . $section . '.php' ) ){
                echo '<style>' . @file_get_contents( __DIR__ . '/settings/page.css' ) . '</style>';
                include( __DIR__ . '/settings/' . $section . '.php' );
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