<?php 
$apps = DB::SELECT("SELECT * FROM apps WHERE uid=? AND status!=? ORDER BY ID DESC", array($youID, 0), "ii");
$pauseCount = DB::SELECT("SELECT COUNT(ID) as total FROM apps WHERE uid=? AND status=?", array($youID, 2), "ii")->row->total;
$average = $apps->count > 0 ? 100 : 0;

if($apps->count > 0){ ?>

<div class="in-page rel flex col">

<h1 class="s30 b900 page-title">Dashboard</h1>

<div class="rel dashboard_top_datapoints flex aic">

    <div class="summary_average info-element-block-main static first">
        <div class="summary_average_desc info-element-block-desc">
            Average availability
        </div>
        <div class="info-element-block-info-holder flex aic">
            <div class="info-element-block-icon-holder">
                <div class="image dashboard icon-wave-square dashboard-element-icon summary_average_icon"></div>
            </div>

            <div class="info-element-block-value summary_average_text average_availability_holder"><?php echo number_format($average, $average < 100 ? 2 : 0); ?>%</div>
        </div>
    </div>

    <div class="summary_incidents info-element-block-main second">
        <div class="summary_incidents_desc info-element-block-desc">
            Active incidents
        </div>
        <div class="info-element-block-info-holder flex aic">
            <div class="info-element-block-icon-holder">
                <div class="image dashboard icon-exclamation-triangle dashboard-element-icon summary_incidents_icon"></div>
            </div>

            <div class="info-element-block-value summary_incidents_text monitors_with_incidents_holder">0</div>
        </div>
    </div>

    <div class="summary_paused info-element-block-main third">
        <div class="summary_paused_desc info-element-block-desc">
            Paused
        </div>
        <div class="info-element-block-info-holder flex aic">
            <div class="info-element-block-icon-holder">
                <div class="image dashboard icon-pause-circle dashboard-element-icon summary_paused_icon"></div>
            </div>

            <div class="info-element-block-value summary_paused_text paused_total"><?php echo $pauseCount; ?></div>
        </div>
    </div>

    <div class="summary_total info-element-block-main fifth">
        <div class="summary_total_desc info-element-block-desc">
            Total monitors
        </div>
        <div class="info-element-block-info-holder flex aic">
            <div class="info-element-block-icon-holder">
                <div class="image dashboard icon-server dashboard-element-icon summary_total_icon"></div>
            </div>

            <div class="info-element-block-value summary_total_text total_monitors_holder"><?php echo number_format($apps->count); ?></div>
        </div>
    </div>

    <div class="summary_healthy info-element-block-main sixth">
        <div class="summary_healthy_desc info-element-block-desc">
            Healthy monitors
        </div>
        <div class="info-element-block-info-holder flex aic">
            <div class="info-element-block-icon-holder">
                <div class="image dashboard icon-check-circle dashboard-element-icon summary_healthy_icon"></div>
            </div>

            <div class="info-element-block-value summary_healthy_text healthy_monitors_holder"><?php echo number_format($apps->count); ?></div>
        </div>
    </div>

    <div class="summary_maintenance info-element-block-main seventh">
        <div class="summary_maintenance_desc info-element-block-desc">
            Under maintenance
        </div>
        <div class="info-element-block-info-holder flex aic">
            <div class="info-element-block-icon-holder">
                <div class="image dashboard icon-cogs dashboard-element-icon summary_maintenance_icon"></div>
            </div>

            <div class="info-element-block-value summary_maintenance_text under_maintenance_total">0</div>
        </div>
    </div>

</div>

<div class="apps-list flex col" style="margin-bottom: 25px;">

    <div class="hdr flex aic">
        
        <div class="search flex aic">
            <div class="ico icon-search"></div>
            <input type="text" placeholder="Search" class="input s16 query" />
        </div>

        <div class="actions flex aic jce">

            <div class="choosen rel" 
                data-id="app-action" 
                data-onchange="appAction" 
                data-change="0"
                data-default-value="Action" 
                data-options="Pause,Schedule maintenance,Delete"></div>

            <button data-mode="list" class="switch-app-list-view icon-bars on s16 hidem"></button>
            <button data-mode="grid" class="switch-app-list-view icon-grip-horizontal s16 hidem"></button>
            <button class="button add-new act flex aic hidem" onClick="window.location='<?php echo BASEURL . 'monitoring/create'; ?>';">
                <div class="icon-plus-circle s16"></div>
                <h2 class="s14 bold">Add New Monitor</h2>
            </button>
        </div>

    </div>

    <div class="data-table flex col">
        <div class="dt-row dt-head s12 flex aic">
            <div class="dt-col dt-check">
                <input type="checkbox" value="all" />
            </div>
            <div class="dt-col dt-name">
                <h1>Name</h1>
            </div>
            <div class="dt-col dt-time hidem">
                <h1>Type</h1>
            </div>
            <div class="dt-col dt-time">
                <h1>Uptime</h1>
            </div>
            <div class="dt-col dt-time">
                <h1>Downtime</h1>
            </div>
            <div class="dt-col dt-time hidem">
                <h1>Performance</h1>
            </div>
            <div class="dt-col dt-time flex aic jce hidem">
                <h1>Action</h1>
            </div>
        </div>
        <?php if($apps->count > 0){
            for($n = 0; $n < count($apps->fetch); $n++):
                $a = $apps->fetch[$n];
                $to = $a->type == 'web' ? 'uptime' : $a->type;
                echo '<div class="dt-row s14 flex aic">
                    <div class="dt-col dt-check">
                        <input type="checkbox" value="' . toHash($a->ID) . '" />
                    </div>
                    <div class="dt-col dt-name">
                        <a href="' . BASEURL . 'monitoring/' . $to . '/' . toHash($a->ID) . '?v=' . time() . '" class="wordwrap tdn tdnh bold">' . stripslashes($a->title) . '</a>
                    </div>
                    <div class="dt-col dt-time hidem">
                        <h1>' . strtoupper($a->type == 'web' ? 'https' : $a->type) . '</h1>
                    </div>
                    <div class="dt-col dt-time">
                        <h1>' . $a->uptime . '%</h1>
                    </div>
                    <div class="dt-col dt-time">
                        <h1>' . $a->downtime . '</h1>
                    </div>
                    <div class="dt-col dt-time hidem">
                        <h1>' . number_format($a->resp_time, 2) . ($a->resp_time > 1000 ? 'sec' : 'ms') . '</h1>
                    </div> 
                    <div class="dt-col dt-time flex aic jce hidem">
                        <button class="icon-ellipsis-v action"></button>
                    </div>
                </div>';
            endfor;
        }else{
            echo '<div class="dt-row dt-empty flex col aic jcc">
                <h1 class="s16">You have not created any monitor yet</h1>
                <a href="' . BASEURL . 'cp/monitor-create" class="tdn s15 bold color tdnh">Add Monitor Now</a>
            </div>';
        } ?>
    </div>

</div>
</div>

<?php }else{ 
    
$options = array(
    array(
        'title' => 'Monitor uptime of your website',
        'detail' => 'Monitor the uptime of HTTP, HTTPS, DNS, UDP, TCP, email and more. Checks are performed as often as every 30 seconds, from 171 checkpoints!',
        'label' => 'uptime',
        'to' => BASEURL . 'monitoring/create'
    ),
    array(
        'title' => 'Monitor speed of your website',
        'detail' => 'Monitor website speed by loading it with a real Chrome browser. Receive reports on loading speeds or alerts if something goes wrong.',
        'label' => 'speed',
        'to' => BASEURL . 'monitoring/create/speed'
    ),
    array(
        'title' => 'Monitor important website transactions',
        'detail' => 'Monitor web transactions (login forms, check-out forms, etc.) and be notified if something goes wrong. Find out where the problem has occurred precisely!',
        'label' => 'transaction',
        'to' => BASEURL . 'monitoring/create/transaction'
    ),
    array(
        'title' => 'Monitor user experience',
        'detail' => 'Monitor the speed of user experience for visitors to your website. Receive detailed reports on loading speeds by country, browser, OS and more.',
        'label' => 'real user',
        'to' => BASEURL . 'monitoring/create/rum'
    )
);    
?>
<div class="in-page no-monitor rel flex col aic jcc">

    <div class="ico icon-satellite s72"></div>
    <h1 class="s24 tl b900">You have not created any monitor yet</h1>

    <div class="options flex">
        <?php foreach($options as $opt):
            echo '<div class="item flex col aic jcc">
                <h1 class="s18 b900">' . $opt['title'] . '</h1>
                <p class="s16">' . $opt['detail'] . '</p>
                <a href="' . $opt['to'] . '" class="button s14 bold tdn">Create ' . $opt['label'] . ' Monitor</a>
            </div>';
        endforeach; ?>
    </div>

</div>

<?php } ?>

