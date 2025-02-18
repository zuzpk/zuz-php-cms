<?php 
use \Zuz\Router;
// use \Zuz\Core;
$section = Router::getParams()->section;
echo $section !== "contact" ? '<div class="flex"><div class="help blurify rel">' : '';
include(__DIR__ . '/' . $section . '.php');
echo $section !== "contact" ? '</div>': '';

if($section != "contact"){  ?>

    <div class="help-nav flex col">
        <?php 
            $nav = array(
                array( 'href' => '/help/about', 'label' => 'About Us', 'icon' => 'home-1' ),
                array( 'href' => '/help/tos', 'label' => 'Terms of Service', 'icon' => 'briefcase' ),
                array( 'href' => '/help/privacy', 'label' => 'Privacy Policy', 'icon' => 'emoji-happy' ),
            );
            foreach( $nav as $n ):
                echo '<a href="' . $n['href'] . '"class="tdn s18 bold nous rel flex aic ' . ($n['href'] == "/help/$section"? "active":"") . '">' . $n['label'] . '</a>';
            endforeach;
        ?>
    </div>

</div>

<?php } ?>