<div class="in-page rel flex col">

    <h1 class="s30 b900 page-title">Monitoring log</h1>

    <div class="flex with">
        
        <div class="opt-bar flex col">

            <div class="ohead flex aic">
                <h2 class="b900 s16">Status</h2>
            </div>

            <div class="expander flex col">

                <?php 
                    $list = array(
                        array( 'id' => 'up', 'label' => 'Up' ),
                        array( 'id' => 'down', 'label' => 'Down' )
                    );
                    foreach($list as $l):
                        echo '<label class="flex aic" data-id="' . $l['id'] . '">
                            <input type="checkbox" value="' . $l['id'] . '" />
                            <h2 class="s15">' . $l['label'] . '</h2>
                        </label>';
                    endforeach;
                ?>
            </div>

            <div class="ohead flex aic">
                <h2 class="b900 s16">Monitors</h2>
                <button class="rel check tdnh">Select All</button>
            </div>

            <div class="expander flex col">

                <?php 
                    $list = array(
                        array( 'id' => 'uptime', 'label' => 'Uptime' ),
                        array( 'id' => 'ssl', 'label' => 'SSL' ),
                        array( 'id' => 'transaction', 'label' => 'Transaction' ),
                        array( 'id' => 'speed', 'label' => 'Speed' ),
                        array( 'id' => 'real-user', 'label' => 'Real User' ),
                    );
                    foreach($list as $l):
                        echo '<label class="flex aic" data-id="' . $l['id'] . '">
                            <input type="checkbox" value="' . $l['id'] . '" />
                            <h2 class="s15">' . $l['label'] . '</h2>
                            <div class="icon-chevron-down aro"></div>
                        </label>';
                    endforeach;
                ?>
            </div>
            
            <div class="ohead flex aic">
                <h2 class="b900 s16">Locations</h2>
                <button class="rel check tdnh">Select All</button>
            </div>

            <div class="expander flex col">

                <?php 
                    $list = array(
                        array( 'id' => 'europe', 'label' => 'Europe' ),
                        array( 'id' => 'north-america', 'label' => 'North America' ),
                        array( 'id' => 'middle-east', 'label' => 'Middle East' ),
                        array( 'id' => 'asia', 'label' => 'Asia' ),
                        array( 'id' => 'south-america', 'label' => 'South America' ),
                        array( 'id' => 'africa', 'label' => 'Africa' ),
                        array( 'id' => 'oceania', 'label' => 'Oceania' ),
                    );
                    foreach($list as $l):
                        echo '<label class="flex aic" data-id="' . $l['id'] . '">
                            <input type="checkbox" value="' . $l['id'] . '" />
                            <h2 class="s15">' . $l['label'] . '</h2>
                            <div class="icon-chevron-down aro"></div>
                        </label>';
                    endforeach;
                ?>
            </div>

        </div>

        <div class="ins-list flex col" style="margin-bottom: 25px;">

            <div class="data-table flex col">
                <div class="dt-row dt-head s12 flex aic">
                    <div class="dt-col dt-name">
                        <h1>Name</h1>
                    </div>
                    <div class="dt-col dt-time">
                        <h1>Location</h1>
                    </div>
                    <div class="dt-col dt-time hidem">
                        <h1>Time</h1>
                    </div>
                    <div class="dt-col dt-time">
                        <h1>Status</h1>
                    </div>
                    <div class="dt-col dt-time hidem">
                        <h1>Duration</h1>
                    </div>
                </div>

                <?php 
                    echo '<div class="dt-row dt-empty flex col aic jcc">
                        <div class="s50 icon-engine-warning"></div>
                        <h1 class="s14">We could not find any logs based on your settings</h1>
                    </div>';
                ?>

            </div>

        </div>

    </div>

</div>