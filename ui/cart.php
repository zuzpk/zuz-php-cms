<?php 
use \Zuz\Config;
use \Zuz\Core;
use \Zuz\DB;
use \Zuz\Router;
use \Zuz\User;

$params = Router::getParams(); 
$checkout = isset($params->section) && $params->section == 'checkout';
$processed = isset($params->section) && $params->section == 'processed';
if($checkout && User::isGuest()){ header('location: ' . Config::BASEURL . 'u/login?nxt=' . urlencode('/cart/checkout')); exit; }
$apps = isset($_COOKIE['__cart']) ? json_decode($_COOKIE['__cart'], true) : array();
?><div class="app-cart cart rel flex col<?php echo Router::hasParams(array("checkout")) ? ' checkedout' : ''; ?>">
    <?php 
        include( __DIR__ . "/cover.php");
        if($processed){
            echo '<div class="error-404 cart-processed flex aic jc">
                <h2 class="s70 tc icon-shopping_cart"></h2>
                <h2 class="s18" style="text-align: left;"><span class="bold s24">Good Job.</span><br />Apps are added to your account.<br /><br /><a href="/my-apps?frm=_cart" class="tdn tdnh bold">Download Now</a>.</h2>
            </div>';
        }else if(count($apps) > 0){ ?>
        <div class="page-title s30 b900 flex aic"><div class="ico icon-shopping_cart s30"></div>Shopping Cart</div>
        <div class="cart-meta-data flex">
            <?php 
                if($checkout){
                    echo '<div class="methods flex col">
                        <h2 class="page-title s16 bold">Choose Payment Method</h2>
                        <div class="item flex aic pointer anim" data-pmt="pp">
                            <div class="ico rel"><img src="/ui/images/paypal.webp?v=1.1" class="abc abs" /></div>
                            <div class="mta flex col">
                                <h2 class="s16 name bold nous">PayPal</h2>
                                <h2 class="s13 c777 line nous">Pay securely with PayPal</h2>
                            </div>
                        </div>
                        <div class="item flex aic pointer anim" data-pmt="cc">
                            <div class="ico rel"><img src="/ui/images/credit_card.webp?v=1.1" class="abc abs" /></div>
                            <div class="mta flex col">
                                <h2 class="s16 bold nous">Credit Card</h2>
                                <h2 class="s13 c777 line nous">Pay securely with Credit Card</h2>
                            </div>
                        </div>
                    </div>';
                }
            ?>
            <div class="items flex col">
                <?php if($checkout){ echo '<h2 class="page-title s16 bold">Order Summary</h2>'; } ?>
                <?php 
                    $ids = array();
                    foreach($apps as $app):
                        array_push($ids, Core::fromHash($app['id']));
                    endforeach;
                    $ids = implode(",", $ids);
                    $get = DB::SELECT("SELECT * FROM apps WHERE ID IN (" . $ids . ") AND status=?", array(1), "i");
                    $total = 0;
                    for($n = 0; $n < count($get->fetch); $n++):
                        $app = $get->fetch[$n];
                        $total += $app->price;
                        echo '<div class="cart-item-' . Core::toHash($app->ID) . ' item flex aic">';
                        if(!$checkout){ echo '<div class="appicon" style="background: #dfe5ef url(/ui/images/apps/' . $app->thumb . ') no-repeat center;"></div>'; }
                        echo '<div class="meta flex col">
                                <h2 class="s20 b900 name">' . stripslashes($app->title) . '</h2>
                                <h2 class="s16">' . stripslashes($app->tagline) . '</h2>
                            </div>
                            <div class="price s20 bold flex aic jc">
                                ' . Config::CURRENCY . '<span class="s30 b900">' . $app->price . '</span>
                            </div>';
                        if(!$checkout){ 
                            echo '<div class="actions flex aic je">
                                <button class="rm-fcart s36  rel anim" data-id="' . Core::toHash($app->ID) . '"><span class="abs abc">&times;</span></button>
                            </div>';
                        }
                        echo '</div>';
                    endfor;
                    $xtion = $checkout ? '' : '<div class="actions flex aic je">&nbsp;</div>';
                    $css = !$checkout ? '' : ' style="margin-bottom: 30px;"';
                    echo '<div class="total item flex aic">
                        <div class="appicon"></div>
                        <div class="meta flex col je">
                            <h2 class="s18  name flex je">Handling Fee</h2>
                        </div>
                        <div class="price s20 bold flex aic jc">
                            ' . Config::CURRENCY . '<span class="s30 b900">0.00</span>
                        </div>
                        ' . $xtion . '
                    </div>';
                    echo '<div class="total item flex aic"' . $css . '>
                        <div class="appicon"></div>
                        <div class="meta flex col je">
                            <h2 class="s18 name flex je">Your Cart Total</h2>
                        </div>
                        <div class="price s20 bold flex aic jc">
                            ' . Config::CURRENCY . '<span class="s30 b900">' . number_format($total, 2) . '</span>
                        </div>
                        ' . $xtion . '
                    </div>';
                    if(!Router::hasParams(array('checkout'))){ 
                        echo '<div class="total item check flex aic">
                            <div class="appicon"></div>
                            <div class="meta flex col je">
                                &nbsp;
                            </div>
                            <div class="price flex aic jc" style="justify-content:flex-end;">
                                ' . ($checkout ?  
                                    '<button class="flex aic s16 bold anim pay-ndl jc" disabled><div class="ico icon-lock-1"></div>Pay & Download</button>' : 
                                    '<a href="/cart/checkout" class="s18 bold buton tdn anim cfff tocheck flex aic"><div class="ico icon-lock-1"></div>Secure Checkout</a>'
                                )
                            .'</div>
                        </div>';
                    }
                ?>
            </div>
        </div>
    <?php }else{ 

        echo '<div class="error-404 flex aic jc col">
            <div style="margin-bottom: 30px;" class="s40 bold tc icon-shopping_cart"></div>
            <h2 class="s24 bold tc">Your cart is empty.</h2>
            <h2 class="s18 tc">Why not start <a href="/apps?frm=_cart" class="tdnh bold">browsing awesome apps</a>.</h2>
        </div>';
    } ?>
</div>