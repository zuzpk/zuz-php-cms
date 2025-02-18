<div class="in-page rel flex col aic jcc" style="width: 500px;margin: 50px auto;">

<h1 class="s36 b900 page-title">Let's Get Started</h1>

<h1 class="s16 on-title">You are just 2 short steps away from setting up your account</h1>

<div class="steps rel">
    
    <div class="stp flex aic">
        <div class="sp sp-1 flex on aic">
            <h1 class="s18 n bold flex aic jcc">1</h1>
            <h1 class="s18 l bold">Websites</h1>
        </div>
        <div class="sp spl-2 spl"></div>
        <div class="sp sp-2 flex aic">
            <h1 class="s18 n bold flex aic jcc">2</h1>
            <h1 class="s18 l bold">Alerts</h1>
        </div>
        <div class="sp spl-3 spl"></div>
        <div class="sp sp-3 flex aic">
            <h1 class="s18 n bold flex aic jcc">3</h1>
            <h1 class="s18 l bold">Done!</h1>
        </div>
    </div>

    <div class="step-1 flex col">
        <h1 class="s24 bold tl">Which websites do you want to monitor?</h1>
        <h1 class="s18">Website URL</h1>
        <input type="text" placeholder="https://" class="input s18 web-url" />
        <div class="flex aic f1">
            <div></div>
            <button class="button s18 bold next-step" data-step="url">Next</button>
        </div>
    </div>
    <div class="step-2 flex col rel">
        <?php echo Cover('rgba(255,255,255,.95)'); ?>
        <h1 class="s24 bold tl">Whom should we alert when something breaks?</h1>
        <h1 class="s18">Send alerts to these contacts:</h1>
        <input type="text" placeholder="you@email.com" value="<?php echo $_USER->me->em; ?>" class="input s18 ur-mail" />
        <div class="flex aic f1">
            <div class="flex aic">
                <a href="javascript:;" class="go-back tdn tdnh s14 c777" data-step="back">Change URL</a>
            </div>
            <button class="button s18 bold next-step" data-step="email">Next</button>
        </div>
    </div>
    <div class="step-3 flex col aic jcc">
        <div class="icon-bell-on s100 color" style="margin-bottom: 20px;"></div>
        <h1 class="s24 bold tl">Great job!</h1>
        <h1 class="s18">Now you are all set. We will start monitoring your website(s) and will notify you when someting is wrong.</h1>
        <button class="button s18 bold next-step" onClick="window.location='<?php echo BASEURL . 'cp?_added=1'; ?>';" data-step="done">Go to Dashboard</button>
    </div>

</div>

<a href="<?php echo BASEURL . 'cp?sup=1'; ?>" class="skip tdn tdnh s16 c777">Skip onboarding</a>


</div>