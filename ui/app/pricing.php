<?php echo '<style>' . @file_get_contents( __DIR__ . '/pricing/page.css' ) . '</style>'; ?>
<div class="pricing flex col in-page">
    <div class="pre-pricing flex col">
        <h1 class="s30 b900 t-c" style="text-transform: uppercase;">It costs much less than downtime</h1>

        <h1 class="s24 b900 t1 t-c">Our plans</h1>
        <h1 class="s18 t2 t-c">Choose a suitable plan and try us without any obligations!</h1>

        <!-- <div class="flex aic jcc price-switch">
            <h1 class="s15 b900 o1 o1-yr t-c">Pay Yearly (2 Months free)</h1>
            <label class="checkbox" style="margin: 0px 15px;">
                <input type="checkbox" value="1" id="price-mod" />
                <div class="-slide rel"></div>
            </label>
            <h1 class="s15 b900 o1 o1-mo on t-c">Pay Monthly</h1>
        </div> -->

        <?php include(__DIR__ . '/pricing/table.php'); ?>    

        <h1 class="s24 b900 t1 t-c offers-label" style="margin-top: 75px;">All plans includes</h1>

        <div class="flex jcc aic offers">
            <div class="offer flex col aic jcc">
                <div class="color s50 icon-dewpoint"></div>
                <h1 class="s24 b900">Transaction monitoring</h1>
                <p class="s16">Extended montoring for your website applications, such as login, sign up and checkout forms. Monitoring is available with 10 minute intervals.</p>
            </div>
            <div class="offer flex col aic jcc">
                <div class="color s50 icon-waveform-path"></div>
                <h1 class="s24 b900">Daily reporting</h1>
                <p class="s16">Receive daily, weekly, monthly or yearly reports with all information about your monitored website uptime.</p>
            </div>
            <div class="offer flex col aic jcc">
                <div class="color s50 icon-satellite"></div>
                <h1 class="s24 b900">171 locations worldwide</h1>
                <p class="s16">The uptime of your monitors will be tracked with datacenters from 171 locations worldwide.</p>
            </div>
        </div>
    </div>

    <div class="processing-pro rel flex aic jcc col">
    
    </div>

</div>