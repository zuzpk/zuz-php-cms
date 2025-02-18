<?php shouldNotSignin('cp'); ?><div class="checkpoints flex col rel">
    
    <div class="header-tall rel flex" style="background: url(<?php echo THEME . 'images/graph-bg.svg?v=' . time(); ?>) no-repeat center;">
        
        <div class="qqx a flex col jcc">
        
            <h1 class="s50 b900">171 Monitoring Checkpoints</h1>
            <h1 class="s24">Dedicated monitoring probes on six continents, over 60 countries</h1>
    
        </div>
        
        <div class="qqx b flex col aie jcc">
            <a href="#north-america" class="anim c777 s16 b900">North America</a>
            <a href="#south-america" class="anim c777 s16 b900">South America</a>
            <a href="#middle-east" class="anim c777 s16 b900">Middle East</a>
            <a href="#oceania" class="anim c777 s16 b900">Oceania</a>
            <a href="#europe" class="anim c777 s16 b900">Europe</a>
            <a href="#africa" class="anim c777 s16 b900">Africa</a>
            <a href="#asia" class="anim c777 s16 b900">Asia</a>
        </div>
           
    </div>

    <div class="slices flex col aic">

        <div class="slice flex col aic">
            <h1 class="s30 b900">The complete list of our monitoring probe locations</h1>
            <div class="s16">
                We have built this massive list of monitoring checkpoints to be as close to our customers as possible. Our clients are free to choose from any of these checkpoints to get the best website monitoring service on the market.
                You can find a plain list of IP addresses for whitelisting <a href="#" class="s16 b900 tdnh anim">here</a>.
            </div>
        </div>

        
    <?php 
        $ii = array(
            'north-america' => array(
                array(
                    'country' => 'United States',
                    'city' => 'San Francisco (CA)',
                    'status' => 'Alive',
                    'ip' => '137.184.94.36'
                ),
                array(
                    'country' => 'United States',
                    'city' => 'Fremont (CA)',
                    'status' => 'Alive	',
                    'ip' => '45.56.89.150'
                ),	
                array(
                    'country' => 'United States',
                    'city' => 'New York City (NY)',
                    'status' => 'Alive',
                    'ip' => '74.119.194.122'
                ),
                array(
                    'country' => 'United States',
                    'city' => 'Dallas (TX)',
                    'status' => 'Alive',
                    'ip' => '209.145.48.145'
                ),
                array(
                    'country' => 'United States',
                    'city' => 'Orlando (FL)',
                    'status' => 'Alive',
                    'ip' => '92.38.133.18'
                ),
                array(
                    'country' => 'United States',
                    'city' => 'Atlanta (GA)',
                    'status' => 'Alive',
                    'ip' => '155.138.203.9'
                ),
                array(
                    'country' => 'United States',
                    'city' => 'Austin (TX)',
                    'status' => 'Alive',
                    'ip' => '208.81.246.2'
                ),
                array(
                    'country' => 'United States',
                    'city' => 'Boston (MA)',
                    'status' => 'Alive',
                    'ip' => '192.34.85.32'
                ),	
                array(
                    'country' => 'United States',
                    'city' => 'Chicago (IL)',
                    'status' => 'Alive',
                    'ip' => '154.12.235.24'
                ),
                array(
                    'country' => 'United States',
                    'city' => 'Denver (CO)',
                    'status' => 'Alive',
                    'ip' => '192.73.242.94'
                ),
            ),
            'europe' => array(
                array(
                    'country' => 'Austria',
                    'city' => 'Vienna',
                    'status' => 'Alive',
                    'ip' => '158.255.211.83'
                ),
                
                array(
                    'country' => 'Austria',
                    'city' => 'Graz',
                    'status' => 'Alive',
                    'ip' => '151.236.9.94'
                ),
                		 	
	 
                array(
                    'country' => 'Belgium',
                    'city' => 'Antwerpen',
                    'status' => 'Dead',
                    'ip' => '34.77.51.213'
                ),
                array(
                    'country' => 'Belgium',
                    'city' => 'Brussels',
                    'status' => 'Alive',
                    'ip' => '192.71.249.132'
                ),
                array(
                    'country' => 'Bulgaria',
                    'city' => 'Sofia',
                    'status' => 'Alive',
                    'ip' => '77.91.100.135'
                ),
            ),
            'asia' => array(
                array(
                    'country' => 'Japan',
                    'city' => 'Tokyo',
                    'status' => 'Alive',
                    'ip' => '45.77.178.221'
                ),
                array(
                    'country' => 'Japan',
                    'city' => 'Nagoya',
                    'status' => 'Alive',
                    'ip' => '155.133.7.23'
                ),
                array(
                    'country' => 'Japan',
                    'city' => 'Osaka',
                    'status' => 'Alive',
                    'ip' => '64.176.38.5'
                ),
                array(
                    'country' => 'Japan',
                    'city' => 'Sapporo	',
                    'status' => 'Alive',
                    'ip' => '103.19.2.131'
                ),
                array(
                    'country' => 'Singapore',
                    'city' => 'Sofia',
                    'status' => 'Alive',
                    'ip' => '51.79.240.138'
                )
            ),
            'oceania' => array(
                array(
                    'country' => 'Australia',
                    'city' => 'Sydney',
                    'status' => 'Alive',
                    'ip' => '139.99.236.25'
                ),
                array(
                    'country' => 'Australia',
                    'city' => 'Adelaide',
                    'status' => 'Alive',
                    'ip' => '146.185.214.151'
                ),
                array(
                    'country' => 'Australia',
                    'city' => 'Brisbane',
                    'status' => 'Alive',
                    'ip' => '172.105.180.165'
                ),
                array(
                    'country' => 'Australia',
                    'city' => 'Canberra	',
                    'status' => 'Alive',
                    'ip' => '45.76.117.187'
                ),
                array(
                    'country' => 'New Zealand',
                    'city' => 'Auckland',
                    'status' => 'Dead',
                    'ip' => '103.208.86.179'
                )
            ), 
            'south-america' => array(
                array(
                    'country' => 'Argentina',
                    'city' => 'Buenos Aires',
                    'status' => 'Alive',
                    'ip' => '200.42.136.21'
                ),
                array(
                    'country' => 'Brazil',
                    'city' => 'Brasília',
                    'status' => 'Alive',
                    'ip' => '189.40.216.10'
                ),
                array(
                    'country' => 'Brazil',
                    'city' => 'Sao Paolo',
                    'status' => 'Alive',
                    'ip' => '216.238.110.248'
                ),
                array(
                    'country' => 'Brazil',
                    'city' => 'Fortaleza	',
                    'status' => 'Alive',
                    'ip' => '5.252.24.165'
                ),
                array(
                    'country' => 'Chile',
                    'city' => 'Santiago',
                    'status' => 'Dead',
                    'ip' => '216.73.159.125'
                )
            ), 
            'middle-east' => array(
                array(
                    'country' => 'Bahrain',
                    'city' => 'Manamah',
                    'status' => 'Alive',
                    'ip' => '87.237.196.10'
                ),
                array(
                    'country' => 'Israel',
                    'city' => 'Tel Aviv',
                    'status' => 'Alive',
                    'ip' => '77.91.74.201'
                ),
                array(
                    'country' => 'Saudi Arabia',
                    'city' => 'Riyadh',
                    'status' => 'Alive',
                    'ip' => '95.177.214.34'
                ),
                array(
                    'country' => 'United Arab Emirates',
                    'city' => 'Dubai	',
                    'status' => 'Alive',
                    'ip' => '38.54.75.244'
                ),
                array(
                    'country' => 'Qatar',
                    'city' => 'Doha',
                    'status' => 'Dead',
                    'ip' => '213.130.121.18'
                )
            ), 
            'africa' => array(
                array(
                    'country' => 'Egypt',
                    'city' => 'Egypt',
                    'status' => 'Alive',
                    'ip' => '213.158.188.34'
                ),
                array(
                    'country' => 'Australia',
                    'city' => 'South Africa',
                    'status' => 'Alive',
                    'ip' => 'Johannesburg'
                ),
                array(
                    'country' => 'Cape Town',
                    'city' => 'Brisbane',
                    'status' => 'Alive',
                    'ip' => '197.98.12.17'
                )
            ),
            
        );

        $frag = array(
            'north-america' => 'North America',
            'europe' => 'Europe',
            'south-america' => 'South America',
            'middle-east' => 'Middle East',
            'oceania' => 'Oceania',
            'africa' => 'Africa',
            'asia' => 'Asia'
        );

        foreach($frag as $k => $v):
            
            echo '<div class="slice flex col" id="' . $k . '">
            <h1 class="s24 b900 tc" style="margin-bottom: 6px;">' . $v . '</h1>
            <div class="data-table flex col">
                <div class="dt-row dt-head s12 flex aic">
                    <div class="dt-col">
                        <h1>Country</h1>
                    </div>
                    <div class="dt-col">
                        <h1>city</h1>
                    </div>
                    <div class="dt-col">
                        <h1>Status</h1>
                    </div>
                    <div class="dt-col">
                        <h1>IP</h1>
                    </div>
                </div>';

            foreach($ii[$k] as $m):
                echo '<div class="dt-row dt-row-cont s15 flex aic">
                    <div class="dt-col">
                        <h1>' . $m['country'] . '</h1>
                    </div>
                    <div class="dt-col">
                        <h1>' . $m['city'] . '</h1>
                    </div>
                    <div class="dt-col">
                        <h1>' . $m['status'] . '</h1>
                    </div>
                    <div class="dt-col">
                        <h1>' . $m['ip'] . '</h1>
                    </div>
                </div>';

            endforeach;
            echo '</div></div>';
        endforeach;
    
    ?>

        

    </div>

</div>