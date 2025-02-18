<div class="admin flex rel">
    <div class="acontent settings flex col">
        <div class="page-title flex aic">
            <div class="_l">
                <h2 class="s20 font b the-title">Settings</h2>
            </div>
            <div class="_r flex aic je">
                
            </div>
        </div>
        
        <div class="settings rel">
            <div class="uform flex col rel">
                <?php 
                    include(dirname( dirname(__FILE__) ) . '/cover.php');
                    $ga = Cog('google_ga', 'ua-xxxxxxxx-xx');
                    $ga = $ga == 'ua-xxxxxxxx-xx' ? '' : $ga;
                    $status = (int)Cog('app_status', 1);
                    $vmail = (int)Cog('verify_email_on_signup', 1);
                    $wmail = (int)Cog('send_wmail_tparty', 0);
                ?>
                
                <div class="stc flex col">
                    <h2 class="s15 lbl font b">Status</h2>
                    <select class="font input site_status s16">
                        <option value="0"<?php echo $status == 0 ? ' selected' : ''; ?>>Maintenance</option>
                        <option value="1"<?php echo $status == 1 ? ' selected' : ''; ?>>Live</option>
                    </select>
                </div>
                <div class="stc flex col">
                    <h2 class="s15 lbl font b">Site Title</h2>
                    <input type="text" value="<?php echo Cog('site_title', 'Site'); ?>" placeholder="Title." class="font input site_title s16" />
                </div>
                <div class="flex group aic">
                    <div class="stc flex col">
                        <h2 class="s15 lbl font b">Currency</h2>
                        <input type="text" value="<?php echo Cog('currency', '$'); ?>" placeholder="$" class="font input currency s16" />
                    </div>
                    <div class="spt"></div>
                    <div class="stc flex col">
                        <h2 class="s15 lbl font b">Currency Code</h2>
                        <input type="text" value="<?php echo Cog('currency_code', 'usd'); ?>" placeholder="$" class="font input currency_code s16" />
                    </div>
                </div>
                <div class="stc flex col">
                    <h2 class="s15 lbl font b">Google Analytics</h2>
                    <input type="text" value="<?php echo strtolower($ga) == "ua-xxxxxxxxx-xx" ? "" : $ga; ?>" placeholder="UA-XXXXXXXXX-X" class="font input googlega s16" />
                </div>
                <div class="stc flex col">
                    <h2 class="s15 lbl font b">Verify Email Before Signin</h2>
                    <select class="font input verify-mail s16">
                        <option value="0"<?php echo $vmail == 0 ? ' selected' : ''; ?>>Disabled</option>
                        <option value="1"<?php echo $vmail == 1 ? ' selected' : ''; ?>>Enabled</option>
                    </select>
                </div>
                <div class="stc flex col">
                    <h2 class="s15 lbl font b">Send Welcome Email to users from 3rd party apps</h2>
                    <select class="font input welcome-mail s16">
                        <option value="0"<?php echo $wmail == 0 ? ' selected' : ''; ?>>Disabled</option>
                        <option value="1"<?php echo $wmail == 1 ? ' selected' : ''; ?>>Enabled</option>
                    </select>
                </div>
                <div class="stc ste flex aic">
                    <button class="button cfff font s16 b save-settings-cog">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>