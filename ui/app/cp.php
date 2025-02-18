<?php shouldSignin(); 
$section = isset($_PARAMS->section) ? $_PARAMS->section : 'overview';
?><div class="dashboard page flex">
    <?php if($section != 'onboarding'){ ?>
    <div class="flex secondary-nav col sticky">
        <?php 
            $section = isset($_PARAMS->section) ? $_PARAMS->section : 'overview';
            $nav = array(
                array( 'id' => 'overview', 'to' => 'cp', 'label' => 'Overview' ),
                array( 'id' => 'incidents-overview', 'to' => 'cp/incidents-overview', 'label' => 'Active incidents' ),
                array( 'id' => 'failure-logs', 'to' => 'cp/failure-logs', 'label' => 'Incidents log' ),
                array( 'id' => 'monitoring-logs', 'to' => 'cp/monitoring-logs', 'label' => 'Monitoring log' ),
            );
            foreach($nav as $n):
                echo '<a href="' . BASEURL . $n['to'] . '" class="link ass flex aic s16' . ($section == $n['id'] ? ' on' : '') . '">
                    <div class="primary-menu-item-name">' . $n['label'] . '</div>
                </a>';
            endforeach;
        ?>
    </div>
    <?php } ?>

    <div class="page-content rel"<?php if($section == 'onboarding'){ echo ' style="min-width: calc(100vw - 70px);"'; } ?>>
        <?php 
            if(file_exists( __DIR__ . '/dashboard/' . $section . '.php' ) ){
                echo '<style>' . @file_get_contents( __DIR__ . '/dashboard/page.css' ) . '</style>';
                include( __DIR__ . '/dashboard/' . $section . '.php' );
            }else{
                Death(
                    '404',
                    'That section does not exist'
                );
            }
        ?>
    </div>


</div>