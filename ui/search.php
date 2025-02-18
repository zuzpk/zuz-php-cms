<?php 
use \Zuz\DB;

$cate = DB::SELECT("SELECT * FROM categories WHERE slug=?", array($_GET['cate']), "s")->row;
$get = DB::SELECT("SELECT * FROM apps WHERE cate=? AND status=? ORDER BY ID DESC LIMIT 24", array($_GET['cate'], 1), "si");
if($get->hasRows){
?><div class="featured rel">
    <h2 class="page-title s20 font" style="padding: 20px 10px;">Browse Apps in <span class="b"><?php echo $cate->label; ?></span></h2>
    <div class="app-list flex aic">
        <?php 
            for($n = 0; $n < count($get->fetch); $n++):
                $poster = explode(",", $get->fetch[$n]->media)[0];
                echo '<a href="' . BASEURL . 'app/' . $get->fetch[$n]->ID . '/' . $get->fetch[$n]->slug . '" class="item anim flex aic noul anim">
                    <div class="thumb rel" style="background: #dee5ed url(' . BASEURL . 'assets/posters/' . $poster . ') no-repeat center" /></div>
                    <div class="meta flex col">
                        <h2 class="s18 font b">' . stripslashes($get->fetch[$n]->title) . '</h2>
                        <h2 class="s16 font">' . stripslashes($get->fetch[$n]->tagline) . '</h2>
                    </div>
                </a>';
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
} ?>