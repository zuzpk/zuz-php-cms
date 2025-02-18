<div class="header-tall rel flex col aic jcc" style="background: url(<?php echo THEME . 'images/graph-bg.svg?v=' . time(); ?>) no-repeat center;">
    
    <h1 class="s36 b900">Check Website Availabilty</h1>
    <h1 class="s24">Check site availability from more than 30 locations around the world</h1>


    <div class="tst flex aic">
        <h2 class="s18 testing-tmp-uri">testing example.com...</h2>
        <input type="text" class="input s18 test-uri" placeholder="Website Url">
        <button class="s16 button test-web-now">Test Now</button>
    </div>

</div>

<div class="test-results flex col">
    <h1 class="s30 b900 test-web-url">www.example.com</h1>
    <div class="test-stats flex aic">
        <div class="test-sect flex col">
            <h1 class="s30 b900 tsts test-load-speed">--</h1>
            <h1 class="s20 b test-label">Average Load Speed</h1>
        </div>
        <div class="test-sect flex col">
            <h1 class="s30 b900 tsts test-locs">--</h1>
            <h1 class="s20 b test-label">Available Locations</h1>
        </div>
    </div>
</div>

<div class="points flex col aic">

    <h1 class="s30 b900">Latest tested websites</h1>
    
    <div class="data-table flex col">

        <div class="dt-row dt-head s12 flex aic">
            <div class="dt-col">
                <h1>Site Url</h1>
            </div>
            <div class="dt-col dt-sm">
                <h1>When</h1>
            </div>
            <div class="dt-col dt-sm">
                <h1>Status</h1>
            </div>
        </div>
        <?php 
            $get = DB::SELECT("SELECT * FROM tests WHERE status=? ORDER BY ID DESC LIMIT 10", array(1), "i");
            if($get->hasRows){
                for($n = 0; $n < count($get->fetch); $n++):
                    echo '<div class="dt-row dt-row-cont s15 flex aic">
                    <div class="dt-col dt-name">
                        <h1>' . $get->fetch[$n]->hostname . '</h1>
                    </div>
                    <div class="dt-col dt-sm">
                        <h1>' . date("d M Y", $get->fetch[$n]->stamp) . '</h1>
                    </div>
                    <div class="dt-col dt-sm">
                        <div style="transform: rotate(180deg);text-align: right;">
                            <div class="icon-chevron-down s16"></div>
                        </div>
                    </div>
                </div>';
                endfor;
            }else{
                echo '<div class="flex col aic jcc" style="margin-top: 100px;">
                    <h2 class="s30 font b900 tc">^_^</h2>
                    <h2 class="s18 font tc" style="margin-top: 20px;">no website tested yet.</h2>
                </div>';
            }
        ?>
    </div>

    <div class="points-cards flex aic">
    
        <div class="card flex col">
            <h1 class="s20 b900">Check page loading time from around the world</h1>
            <div class="s16">
                In addition to the website availability check, it also 
                shows how fast your site loads in each location. You can 
                use this information to find out if your website is fast
                on all continents. We use a real Mozilla Firefox web 
                browser to load your website entirely, with all heavy 
                design elements.
            </div>
        </div>
        <div class="icon-chevron-right s36 c777"></div>
        <div class="card flex col">
            <h1 class="s20 b900">Check website availability from 30 checkpoints</h1>
            <div class="s16">
                Your website might not load for you, but there is always a 
                chance happens because of your internet service provider,
                browser, or other local problems. Also, your website might be 
                unavailable only in the region you live in. Use our website 
                availability tool to get detailed information about your 
                website's health from around 30 checkpoints on 6 continents.
            </div>
        </div>
        
        <div class="icon-chevron-right s36 c777"></div>
        <div class="card flex col">
            <h1 class="s20 b900">How does this tool work?</h1>
            <div class="s16">
                We send a command to load your website to around 30 website
                monitoring probes and wait for an answer. As soon as we get a 
                response, we display the loading times on the map to get a 
                clear view of your site responsiveness worldwide. Also, we 
                provide more detailed information in the table below. Just enter 
                your website URL, and we will check it's availability immediately.
            </div>
        </div>

    </div>

    <div class="check-tools flex col aic">
        
        <h1 class="s30 b900">How to use our website availability checker tool?</h1>

        <div class="pblock flex col rel">

            <div class="dot a abs"></div>
            <div class="dot b abs"></div>

            <div class="tblock rel flex col">
                <h1 class="s24 b900">World map</h1>
                <div class="s16">
                    Use the world map section to see how your website 
                    performs on 6 continents. Check each location by 
                    pointing your mouse on a colored dot. The green 
                    color means that we could load it successfully. 
                    The red color indicates that we failed.
                </div>
            </div>    
            <div class="tblock rel flex col ase">
                <h1 class="s24 b900">Waterfall</h1>
                <div class="s16">
                    The waterfall will show how does exactly your 
                    page load. Every element will be displayed 
                    chronologically. You can select between locations 
                    we loaded your website from.
                </div>
            </div>    
            <div class="tblock rel flex col">
                <h1 class="s24 b900">History</h1>
                <div class="s16">
                    Check your website performance improved or 
                    decreased with time. Take action to fix slow 
                    parts of your site if it takes longer to 
                    load it than it used to. Also, compare your 
                    site performance relative to other websites 
                    tested with our availability checker tool.
                </div>
            </div>    
            <div class="tblock rel flex col ase">
                <h1 class="s24 b900">Analysis</h1>
                <div class="s16">
                    This section will provide you with data 
                    regarding time spent per content time, 
                    domain, number of requests, etc. Use this 
                    information to improve the loading speed 
                    of your website. Also, check if some 
                    elements are making your website slow 
                    only in specific regions.
                </div>
            </div>    

        </div>

        <h1 class="s24 ttt b900">WANT YOUR WEBSITE TESTED EVERY MINUTE?</h1>
        <h1 class="s18">Try <?php echo APP_NAME; ?> to get your website tested from 171 worldwide monitoring checkpoints and get alerted when it gets too slow.</h1>
        <a href="<?php echo BASEURL . 'u/signup'; ?>" class="button s20 tdn anim">Start 30-Day Trial</a>

    </div>

</div>