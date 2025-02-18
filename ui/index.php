<?php 
use \Zuz\Config;
?><div class="anim bgs bg-a fixed fill bg-gradient">
    <div class="stars abs fill"></div>
    <div class="stars2 abs fill"></div>
    <div class="stars3 abs fill"></div>
</div>
<div class="anim bgs bg-b fixed fill bg-green"></div>
<div class="anim bgs bg-c fixed fill bg-yellow"></div>
<div class="anim bgs bg-d fixed fill bg-blue"></div>

<div class="landing flex col rel">
    
    <!-- section a -->
    <section data-scene="bg-a" class="sector sec-a rel flex col aic jc">
        <div class="flex aic land jc">
            
            <div class="xyz flex aic jcc col">
                <h1 class="s50 b900 wb rel">we build</h1>
                <h1 class="b900 wma rel">Web & Mobile Apps</h1>
                <h1 class="s16" style="opacity: 0.5;">with innovative strategies and a results-driven approach, brands thrive in the digital landscape</h1>
                <a href="/help/contact-us" class="s20 rel mask bold tc button tdn anim">start building your next big idea</a>
            </div>

            <!-- <div class="abc abs">

                <div class="slider abs anim"></div>
                <div class="graph abs flex col anim2">
                    <h1 class="s16">Conversion</h1>
                    <h1 class="s30">654</h1>
                    <h1 class="s16">+22% of target</h1>
                    <div class="blocks flex aic">
                        <div class="block"></div>
                        <div class="block"></div>
                        <div class="block"></div>
                        <div class="block"></div>
                        <div class="block"></div>
                        <div class="block"></div>
                    </div>
                </div>

            </div> -->

        </div>
    </section>

    <section data-scene="bg-b" class="sector sec-b rel">
        <h1 class="s70 b900 heading"><span class="dark-green">Innovation and Expertise</span> at the Heart of Everything We Do</h1>
        <h1 class="s24 heading2">At our core, we blend innovation and expertise to fuel every project, striving to pioneer digital solutions that redefine success.</h1>

        <div class="sub-section black flex aic">

            <div class="sx flex col">
                <div class="ico flex ass jc aic"><div class="icon-rocket_launch s24"></div></div>
                <h1 class="s40 b900 cfff t1">Our Mission to Transform Your Digital Future</h1>
                <p class="s20 cfff opacity-75">At the heart of our ethos lies a powerful mission to empower businesses with cutting-edge digital strategies. We're committed to igniting their path to success and fostering sustainable growth through expertise.</p>
            </div>
            <div class="sy flex aic jc">
                <img src="/ui/images/inovation.svg" />
            </div>

        </div>

    </section>
    
    <section data-scene="bg-b" class="sector sec-c rel c111">
        <h1 class="s40 b900 tc">Our Services</h1>
        <div class="grid blocks">
            <?php 
                $i = 0;
                foreach(
                    array(
                        array( 'label' => 'Graphic Design', 'img' => 'graphic-design.png' ),
                        array( 'label' => 'UX/UI Design', 'img' => 'ux-ui-design.webp' ),
                        array( 'label' => 'Web Development', 'img' => 'web-dev.webp' ),
                        array( 'label' => 'Game Development', 'img' => 'game-dev.webp' ),
                        array( 'label' => 'Project Management', 'img' => 'project-management.webp' ),
                        array( 'label' => 'Marketing', 'img' => 'marketing.webp' ),
                        array( 'label' => 'Backend Development', 'img' => 'backend.webp' ),
                        array( 'label' => 'Artificial Intelligence', 'img' => 'ai.webp' ),
                        array( 'label' => 'Data Science', 'img' => 'data-science.webp' )
                    )
                    as $c
                ):
                    echo '<div class="block rel flex col a' . ++$i . '">
                        <h1 class="s30 cfff rel">' . $c['label'] . '</h1>
                        <img class="abs anim" src="/ui/images/' . $c['img'] . '" />
                    </div>';
                endforeach;
            ?>
        </div>
    </section>

    <?php include( __DIR__ . '/team.php' ); ?>

    <section data-scene="bg-d" class="sector sec-e rel flex c111 jc">
        <div class="poster" style="background: url(/ui/images/team.png) no-repeat;">
            <h1 class="s100 cfff b900">We are <?php echo Config::APP_NAME; ?></h1>
        </div>
        <div class="features flex col">
            <div class="item flex col">
                <h1 class="lbl s100 b900">№1</h1>
                <p class="para s18">In terms of Design & Build quality. According to the rating of Smart Ranking.</p>
            </div>
            <div class="item flex col">
                <h1 class="lbl s100 b900">15+ Years</h1>
                <p class="para s18"><?php echo Config::APP_NAME; ?> has been transforming innovative ideas into exceptional digital solutions. We're proud to continue serving our clients with unmatched expertise and dedication.</p>
            </div>
            <div class="item flex col">
                <h1 class="lbl s100 b900">24/7</h1>
                <p class="para s18">Support group is ready to help you if you have questions.</p>
            </div>
        </div>
    </section>

</div>