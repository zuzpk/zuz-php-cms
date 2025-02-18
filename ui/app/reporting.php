<?php shouldSignin();  ?><div class="monitoring page flex">
    <div class="flex secondary-nav col sticky">
        <?php 
            $section = $_PARAMS->section;
            $nav = array(
                array( 'id' => 'uptime', 'to' => 'reporting/contacts', 'label' => 'Contacts' ),
                array( 'id' => 'transaction', 'to' => 'reporting/scheduled-reports', 'label' => 'Scheduled Reports' ),
                array( 'id' => 'transaction', 'to' => 'reporting/reports-editor', 'label' => 'Send Custom Report' ),
                
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
            if(file_exists( __DIR__ . '/reporting/' . $section . '.php' ) ){
                echo '<style>' . @file_get_contents( __DIR__ . '/reporting/page.css' ) . '</style>';
                include( __DIR__ . '/reporting/' . $section . '.php' );
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