<?php
use \Zuz\Config;
use \Zuz\User;
use \Zuz\Core;
use \Zuz\DB;

if ( User::isGuest() ){ header("location: " . Config::BASEURL . "u/login?" . time()); exit; }
$you = User::Session(false);
?>
<div class="my-apps rel flex col">
    <?php 
        $youID = Core::fromHash($you->id);
        $get = DB::SELECT("SELECT aid FROM myapps WHERE uid=? AND status=?", array($youID, 1));

        if($get->hasRows){
            echo '<div class="page-title s20 b900 flex aic"><div class="ico icon-box s24"></div>My Apps (' . count($get->fetch) . ')</div>';
            echo '<div class="items flex col">';
            for($n = 0; $n < count($get->fetch); $n++):
                $app = DB::SELECT("SELECT * FROM apps WHERE ID=?", array($get->fetch[$n]->aid))->row;
                $dlink = Config::BASEURL . 'with/download/get?token=' . Core::Encode($app->ID . Config::SEPERATOR . $app->fileid . Config::SEPERATOR . Core::IP() . Config::SEPERATOR . (time() + 3600));
                echo '<div class="cart-item item flex aic">
                    <div class="appicon" style="background: var(--green-medium) url(/ui/images/apps/' . $app->thumb . ') no-repeat center;"></div>
                    <div class="meta flex col">
                        <h2 class="s20 bold name">' . stripslashes($app->title) . '</h2>
                        <h2 class="s16">' . stripslashes($app->tagline) . '</h2>
                    </div>
                    <div class="actions flex aic je">
                        <a href="' . $dlink . '" class="buton s16 bold rel anim tdn flex aic"><div class="ico icon-file_download"></div>Download (.zip)</a>
                    </div>
                </div>';
            endfor;
            echo '</div>';
        }else{
            echo '<div class="error-404 flex aic jc">
                <h2 class="s40 bold tc icon-box"></h2>
                <h2 class="s18 font" style="text-align: left;">You have not purchased any app yet.<br />Why not start <a href="/?frm=_mya" class="tdnh bold">browsing awesome apps</a>.</h2>
            </div>';
        }
    ?>
</div>