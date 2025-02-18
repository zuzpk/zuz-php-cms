</div>

<?php 
global $_PAGE; if(Cog('app_status') == '1' && $_PAGE != "kpay"){ 
if(!$isUser){ ?><div class="footer flex">
    <div class="foot foot2 flex col">
        <h1 class="s20 b900">Products</h1>
        <a href="<?php echo BASEURL . 'website-uptime-monitoring'; ?>" class="tdn tdnh s16 flex ass">Website Uptime Monitoring</a>
        <a href="<?php echo BASEURL . 'website-speed-monitoring'; ?>" class="tdn tdnh s16 flex ass">Website Speed Monitoring</a>
        <a href="<?php echo BASEURL . 'website-transaction-monitoring'; ?>" class="tdn tdnh s16 flex ass">Website Transaction Monitoring</a>
        <a href="<?php echo BASEURL . 'website-real-user-monitoring'; ?>" class="tdn tdnh s16 flex ass">Website Real User Monitoring</a>
    </div>
    <div class="foot foot2 flex col">
        <h1 class="s20 b900">Resources</h1>
        <a href="<?php echo BASEURL . 'help/privacy'; ?>" class="tdn tdnh s16 flex ass">Privacy Policy</a>
        <a href="<?php echo BASEURL . 'help/cookies'; ?>" class="tdn tdnh s16 flex ass">Cookie Policy</a>
        <a href="<?php echo BASEURL . 'help/terms'; ?>" class="tdn tdnh s16 flex ass">Terms & Conditions</a>
        <a href="<?php echo BASEURL . 'help/gdpr'; ?>" class="tdn tdnh s16 flex ass">GDPR</a>
        <a href="<?php echo BASEURL . 'help/checkpoints'; ?>" class="tdn tdnh s16 flex ass">Monitoring Checkpoints</a>
    </div>
    <div class="foot flex col">
        <h1 class="s20 b900">Products</h1>
        <a href="<?php echo BASEURL . 'knowledge-base'; ?>" class="tdn tdnh s16 flex ass">Knowledge Base</a>
        <a href="<?php echo BASEURL . 'help/refund-policy'; ?>" class="tdn tdnh s16 flex ass">Refund Policy</a>
        <a href="<?php echo BASEURL . 'contact-us'; ?>" class="tdn tdnh s16 flex ass">Contact us</a>
    </div>
</div><?php } } ?>

<?php if($_PAGE_FOUND){  global $proPlans; ?>
<script defer src="<?php echo THEME . 'js/jquery.js'; ?>"></script>
<script defer src="<?php echo THEME . 'js/jquery.ui.js'; ?>"></script>
<script defer src="https://www.gstatic.com/charts/loader.js"></script>
<script defer src="<?php echo THEME . 'js/cki.js'; ?>"></script>
<script defer src="<?php echo THEME . 'js/axios.js'; ?>"></script>
<script defer src="<?php echo THEME . 'js/core.js?' . $APP_VERSION; ?>"></script>
<script defer src="<?php echo THEME . 'js/base.js?' . $APP_VERSION; ?>"></script>
<script defer="" src="https://js.stripe.com/v3/"></script>
<?php if($_PAGE == 'kpay'){ ?>
<script defer="" src="https://cdn.paddle.com/paddle/paddle.js"></script>
<?php } ?>
<script>const __ = { base: `<?php echo BASEURL; ?>`, at: "<?php echo $_PAGE; ?>", with: `<?php echo API_URL_KEY; ?>`, sess: `<?php echo SESS_UI .',' . SESS_UT .',' . SESS_UD .',' . SESS_SI .',' . SESS_FIX; ?>`, me: <?php echo $isUser ? JSON($_USER->me) : JSON(array('ID' => -1)); ?>, plans: <?php echo JSON($proPlans); ?> }</script>
<script defer src="<?php echo THEME . 'js/app.js?' . $APP_VERSION; ?>"></script>
<?php if(file_exists( THEMES . $theme . '/js/' . $_PAGE . '.js')){ ?><script defer src="<?php echo THEME . 'js/' . $_PAGE . '.js?' . $APP_VERSION; ?>"></script><?php } ?>
<?php if($_PAGE == "admin" && isset($_USER->kind) && $_USER->me->ut == 1){ ?><script defer src="<?php echo THEME . 'js/amin.js?' . $APP_VERSION; ?>"></script><?php } ?>
<?php } ?>