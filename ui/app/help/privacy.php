<?php shouldNotSignin('cp'); ?><div class="privacy flex col rel">

    <div class="header-tall small rel flex col aic jcc" style="background: url(<?php echo THEME . 'images/graph-bg.svg?v=' . time(); ?>) no-repeat center;">

        <h1 class="s50 b900">Privacy Policy </h1>
        <h1 class="s36"><?php echo  APP_NAME;?> collects some Personal Data from its Users.</h1>


        <div class="icon-chevron-down s30 chevron anim abs"></div>

    </div>

    <div class="ssec flex col aic">
        
        <h1 class="s30 b900">Personal Data processed for the following purposes and using the following services:</h1>

        <div class="boxes flex"> 
        <?php 
            $qq = array(
                array(
                    'icon' => 'icon-waveform-path',
                    'title' => 'Advertising',
                    'txt' => 'Google Ads Similar audiences Personal Data: Trackers; Usage Data',
                ),
                array(
                    'icon' => 'icon-waveform-path',
                    'title' => 'Analytics',
                    'txt' => 'Google Analytics and Google Ads conversion tracking Personal Data: Trackers; Usage Data',
                ),
                array(
                    'icon' => 'icon-waveform-path',
                    'title' => 'Interaction with data collection',
                    'txt' => 'Hotjar Recruit User Testers Personal Data: Trackers; Usage Data; various types of Data',
                ),
                array(
                    'icon' => 'icon-waveform-path',
                    'title' => 'Tag Management',
                    'txt' => 'Google Tag Manager Personal Data: Trackers; Usage Data',
                ),
                array(
                    'icon' => 'icon-waveform-path',
                    'title' => 'SPAM protection',
                    'txt' => 'Google reCAPTCHA Personal Data: answers to questions; clicks; keypress events; motion sensor events; mouse movements; scroll position; touch events; Trackers; Usage Data',
                ),
                array(
                    'icon' => 'icon-waveform-path',
                    'title' => 'Remarketing and behavioral targeting',
                    'txt' => 'Google Ads Remarketing Personal Data: Trackers; Usage Data',
                ),
                array(
                    'icon' => 'icon-waveform-path',
                    'title' => 'Heat mapping and session recording',
                    'txt' => 'Hotjar Heat Maps & Recordings Personal Data: Trackers; Usage Data; various types of Data as specified in the privacy policy of the service Microsoft Clarity Personal Data: clicks; country; custom events; device information; diagnostic events; interaction events; layout details; mouse movements; page events; positional information; scroll-to-page interactions; session duration; time zone; Trackers; Usage Data',
                )
                        
            );
                
            foreach($qq as $x => $y):
                echo '<div class="box flex">
                <div class="' . $y['icon'] . ' s30 flex ass">
                    <div class="box-desc s18 flex col">
                        <h1 class="s24 b900">' . $y['title'] . '</h1>
                        ' . $y['txt'] . '
                    </div>
                </div>
            </div>';
            endforeach;
        ?>        
        </div>
        
        <!-- <div class="own-inf flex col">
            <div class="icon-waveform-path s30 own-tt flex aic jcc">
                <div class="flex col" style="margin-left:10px; gap: 10px 0;">
                    <h1 class="s24 b900" style="margin-bottom: 20px;">Contact information</h1>
                    <h1 class="s20 b900">Owner and Data Controller</h1>
                    <div class="s16">JJ Online GmbH, Schönhauser Allee 163, DE-10435 Berlin, Germany</div>
                
                    <div class="flex aic s16">
                        Owner contact email:<?php echo EMAIL_ACCOUNT['user'];?>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="inf flex col aic">
            <h1 class="s24 b900">Information on opting out of interest-based advertising</h1>
            <div class="s18">In addition to any opt-out feature provided by any of the services listed in this document, Users may learn more on how to generally opt out of interest-based advertising within the dedicated section of the Cookie Policy.</div>   
        </div>

        

    </div>

    

</div>