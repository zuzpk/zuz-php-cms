<?php shouldNotSignin('cp'); ?><div class="landing flex col rel">

    <div class="icon-waveform-path wave abs"></div>
    <!-- <img src="<?php echo THEME . 'images/calender.png' ?>" class="abs rbg"> -->

    <div class="hed flex aic rel">
        
        <div class="typo flex col rel">
            <h1 class="s50 rel slog-1 b900">Website</h1>
            <h1 class="rel slog-2 b900">Performance</h1>
            <h1 class="rel slog-2 b2 b900">Monitoring</h1>
            <div class="s30 rel slog-3">World's most reliable website<br />monitoring service.</div>
        </div>
        <div class="poster flex aic rel">
            <img src="<?php echo THEME . 'images/landing-webup.png' ?>">
        </div>

    </div>

    <?php include( __DIR__ . '/pricing.php' ); ?>

    <div class="sector-scnd rel flex col aic jcc">
        <div class="presentation flex col">
            <h1 class="s30 flex asc b900">Frequently asked questions</h1>
            <?php 
                $list = array(
                     array(
                        'title' => 'What happens when my trial plan expires?',
                        'txt' => 'We will remind you about the expiration of your plan a few days in advance. If you are satisfied with our services, we will invite you to upgrade to one of our premium plans. If you do not wish to upgrade your plan, we will automatically change your plan to "Free." With our free plan, you can monitor one website as often as 5 minutes.'
                    ),    
                    array(
                        'title' => 'Do you offer a free plan?',
                        'txt' => 'Yes, we do. With our free plan, you can monitor one website as often as 5 minutes. Free plan does not include <a href="#"  class="tdnh">Website Transaction Monitoring</a>, <a href="#" class="tdnh">Website Speed Monitoring</a>, and <a href="#" class="tdnh">Real User Monitoring.</a>'
                    ),    
                    array(
                        'title' => 'Can I upgrade or downgrade my plan?',
                        'txt' => 'Of course! You can do it anytime in your Control Panel.'
                    ),
                    array(
                        'title' => 'What are the benefits of an annual plan?',
                        'txt' => 'The annual plan gives you a discount of up to 2 months worth of services!'
                    ),
                    array(
                        'title' => 'My needs are bigger than your enterprise plan. What should I do?',
                        'txt' => 'Please do not hesitate to <a href="#" class="tdnh">contact us</a> and we will offer you an individual plan.'
                    ),
                    array(
                        'title' => 'What kind of payment methods do you accept?',
                        'txt' => 'We accept credit card payments (Visa, Mastercard, and American Express) and PayPal.'
                    )
                );
                foreach($list as $k => $v):
                    echo '<div class="li flex col">
                        <div class="li-hed s20 b700 pointer flex jcb aic">
                            ' . $v['title'] . '
                            <div class="icon-chevron-down anim"></div>
                        </div>
                        <div class="li-ans s18 hide">' . $v['txt'] . '</div>
                    </div>';
                endforeach;
            ?>
        </div>

        <h1 class="s24 ttt b900">WANT YOUR WEBSITE TESTED EVERY MINUTE?</h1>
        <h1 class="s18">Try <?php echo APP_NAME; ?> to get your website tested from 171 worldwide monitoring checkpoints and get alerted when it gets too slow.</h1>
        <a href="https://uptime.enhelpdesk.com/u/signup" class="button s20 tdn anim">Start 30-Day Trial</a>

    </div>

    
    
    
</div>