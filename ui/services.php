<div class="services flex col aic jc">

    <h2 class="s50 b900">Our Services</h2>
    <h2 class="s18 bold">Expert Solutions, Thoroughly Documented for Your Success—Delivered by Industry-Leading Specialists.</h2>

    <div class="list flex aic">
        <?php 
            foreach(
                array(
                    array(
                        'label' => 'Fullstack React & GraphQL',
                        'line' => 'Comprehensive Fullstack Development with React & GraphQL—Building Robust, Scalable Web Applications.',
                        'img' => 'fullstack.webp'
                    ),
                    array(
                        'label' => 'Python',
                        'line' => 'Advanced Python Development—Creating Efficient, High-Performance Solutions Tailored to Your Needs.',
                        'img' => 'python.webp'
                    ),
                    array(
                        'label' => 'SAP Cloud Apps',
                        'line' => 'Innovative SAP Cloud Apps—Enhancing Business Processes with Scalable, Secure Solutions.',
                        'img' => 'sap.webp'
                    ),
                    array(
                        'label' => 'Unity',
                        'line' => 'Immersive Unity Development—Crafting Engaging, High-Performance Interactive Experiences.',
                        'img' => 'unity.webp'
                    ),
                    array(
                        'label' => 'Usability Testing',
                        'line' => 'Comprehensive Usability Testing—Ensuring Intuitive, User-Friendly Experiences Across Your Applications.',
                        'img' => 'usability-testing.webp'
                    ),
                    array(
                        'label' => 'UX Design',
                        'line' => 'Exceptional UX Design—Creating Seamless, Engaging User Experiences Tailored to Your Audience.',
                        'img' => 'ux.webp'
                    ),
                )
                as $s
            ):
                echo '<div class="item flex aic">
                    <div class="poster">
                        <img src="/ui/images/' . $s['img'] . '" />
                    </div>
                    <div class="meta flex col">
                        <h2 class="s36 b900">' . $s['label'] . '</h2>
                        <p class="s18">' . $s['line'] . '</p>
                    </div>
                </div>';
            endforeach;
        ?>
    </div>

</div>