<?php 

use \Zuz\Config;
use \Zuz\User;

if ( User::isGuest() ){ header("location: " . Config::BASEURL . "u/login?" . time()); exit; }
$you = User::Session(false);
?>
<div class="profile flex blurify">
    <div class="block flex col aic jc">
        <div class="udp rel"><div class="abs abc icon-user-octagon"></div></div>
        <div class="section flex col aic jc">
            <h2 class="label s24 b900"><?php echo $you->nm; ?></h2>
            <h2 class="value s18"><?php echo $you->em; ?></h2>
        </div>
    </div>
    <div class="block flex col jc">
        <div style="align-self:center;" class="udp rel"><div class="abs abc icon-lock-1"></div></div>
        <div>
            <div class="section mt flex col aic jc">
                <h2 class="label s18 bold">Password</h2>
                <h2 class="value s24 bold">************</h2>
                <a href="javascript:;" class="chng-passw flex s16 tdnh">Change</a>
            </div>
            <div class="ch-form flex col">
                <input name="currentPassw" class="input" type="text" placeholder="Current Password" />
                <input name="newPassw" class="input" type="text" placeholder="New Password" />
                <button class="ch-passw buton ass">Change</button>
            </div>
        </div>
    </div>
</div>