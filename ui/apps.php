<?php 
use \Zuz\DB;
use \Zuz\Router;
use \Zuz\Config;
use \Zuz\Core;

if(Router::hasParams(array('id', 'slug'))){

    $g = Router::getParams();
    $app = DB::SELECT("SELECT * FROM apps WHERE ID=? AND status=? LIMIT 1", array($g->id, 1), "si");

    if( $app->hasRows ){ 
        
        $app = $app->row;
        @list($price, $decimal) = explode(".", $app->price);    
        $mediaList = explode(",", $app->media);
    ?>

    <div class="app-detail flex col rel">
            
        <div class="head flex aic rel<?php echo empty(trim($app->cate)) ? "" : " " . $app->cate; ?>">

            <div class="_l flex rel col">
                <h2 class="s36 b900 name"><?php echo stripslashes($app->title); ?></h2>
                <h2 class="s20"><?php echo stripslashes($app->tagline); ?></h2>
                <?php if($price < 0){ ?>
                    <div class="flex aic rel">
                        <?php //<a href="javascript:;" style="width: 175px;" class="tdn preview s18 buton cfff anim flex aic"><div class="icon-eye s24"></div><h2 class="tc jc bold">Request Price</h2></a> ?>
                        <a href="<?php echo Config::TELEGRAM_LINK; ?>" style="max-width: 100px;" class="tdn  buton telegram s18 cfff anim flex aic"><div class="rel"><img src="/ui/images/telegram.svg" width="40px" class="abs abc"></div><h2 class="tc jc bold">Telegram</h2></a>
                        <a href="<?php echo Config::SKYPE_LINK; ?>" style="max-width: 100px;" class="tdn  buton skype s18 cfff anim flex aic"><div class="rel"><img src="/ui/images/skype.svg" class="abs abc"></div><h2 class="tc jc bold">Skype</h2></a>
                    </div>
                <?php }else{ ?>
                    <div class="flex col jc rel">
                        <h2 class="price s70 b900"><?php echo Config::CURRENCY . $price . '<span class="decimal bold rel s36">.' . $decimal . '</span>'; ?></h2>
                        <button data-id="<?php echo Core::toHash($app->ID); ?>" class="addtocart ass buton s18 anim flex aic"><div class="icon-add_shopping_cart s20"></div><h2 class="bold">Add to Cart</h2></button>
                    </div>
                <?php } ?>
                
            </div>

            <div class="_r flex aic jc rel">
                <img class="appicon" src="/ui/images/apps/<?php echo $mediaList[0]; ?>" />
            </div>

        </div>

        <div class="gallery flex aic jc<?php echo empty(trim($app->cate)) ? "" : " " . $app->cate; ?>">
            <?php 
                foreach($mediaList as $ap):
                    echo '<a href="javascript:;" class="anim tdn"><img class="' . $app->cate . '" src="/ui/images/apps/' . $ap . '" /></a>';
                endforeach;
            ?>
        </div>

    </div>

    <?php }
    else{
        echo '<div class="error-404" style="height: 80vh;display: flex;align-items: center;justify-content: center;">
            <h2 style="font-size: 30px;font-weight: 900;border-right: 1px #000 solid;padding-right: 30px;margin-right: 30px;">404</h2>
            <p style="font-size: 24px;">You have took a wrong turn.</p>
        </div>';
    }

}else{

if(isset($_GET['cate'])){
    $cate = DB::SELECT("SELECT * FROM categories WHERE slug=?", array($_GET['cate']), "s")->row;
    $get = DB::SELECT("SELECT * FROM apps WHERE cate=? AND status=? ORDER BY ID DESC LIMIT 24", array($_GET['cate'], 1), "si");
}else{
    $get = DB::SELECT("SELECT * FROM apps WHERE status=? ORDER BY RAND() LIMIT 24", array(1), "i");
}
if($get->hasRows){
?><div class="featured rel flex aic col jc">
    <div class="page-title flex aic col jc">
        <h2 class="s70 b900">Discover your  next idea.<?php 
        echo !isset($_GET['cate']) ? "" : " / <span class=\"b\">' . $cate->label . '</span>"; ?></h2>
        <h2 class="s24">Handpicked design resources to accelerate your creative workflow</h2>
        <a href="/help/contact" class="tdn buton flex aic s20 bold">Get Started<div class="icon-arrow_forward s24 cfff anim"></div></a>
    </div>
    <div class="app-list">
        <?php 
        for($n = 0; $n < count($get->fetch); $n++):
            $poster = explode(",", $get->fetch[$n]->media)[0];
            echo '<div class="tdn item anim flex col noul anim rel">
                <a href="/app/' . $get->fetch[$n]->ID . '/' . $get->fetch[$n]->slug . '"><img class="thumb rel anim" src="/ui/images/apps/' . $poster . '"></a>
                <div class="meta flex col abs">
                    <h2 class="s18 tc b900 wordwrap">' . stripslashes($get->fetch[$n]->title) . '</h2>
                </div>
            </div>';
        endfor;
    ?>
    </div>
</div>
<?php }else{
    echo '<div class="error-404 flex aic jc">
        <h2 class="s40 font b tc icon-bubble5"></h2>
        <div class="line"></div>
        <h2 class="s18 font" style="text-align: left;">No app found in <span class="b">' . stripslashes($cate->label) . '</span>.<br />Why not start <a href="' . BASEURL . '?frm=_cart" class="noul noulh color font">browsing awesome apps</a>.</h2>
    </div>';
} 

} ?>