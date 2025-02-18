<section data-scene="bg-c" class="sector sec-d rel flex col c111 aic jc">
    <h1 class="s70 b900 heading">Meet Our Team</h1>
    <div class="team flex aic rel">
        <?php 
            foreach(
                array(
                    array(
                        'name' => 'Umer Farooq',
                        'desig' => 'CEO',
                        'dp' => 'umer-dp.png'
                    ),
                    array(
                        'name' => 'Irfan',
                        'desig' => 'Founding Partner',
                        'dp' => 'irfan-dp.png'
                    ),
                    array(
                        'name' => 'Ahmed Nazeh',
                        'desig' => 'Senior Software Engineer',
                        'dp' => 'ahmed-nazeh-dp.jpeg'
                    ),
                    array(
                        'name' => 'Usman Asif',
                        'desig' => 'Frontend Engineer',
                        'dp' => 'usman-asif-dp.jpeg'
                    ),
                    array(
                        'name' => 'Mustafa Darwish',
                        'desig' => 'Software Testing Engineer',
                        'dp' => 'mustafa-darwish-dp.jpeg'
                    ),
                    array(
                        'name' => 'Kamran Wajdani',
                        'desig' => 'UI/UX Designer',
                        'dp' => 'kamran-dp.png'
                    ),
                    array(
                        'name' => 'Daniel Vermeulen',
                        'desig' => 'Full Stack Developer',
                        'dp' => 'daniel-vermeulen-dp.jpeg'
                    ),
                    array(
                        'name' => 'Shahbaz Ali',
                        'desig' => 'iOS Team Lead',
                        'dp' => 'shahbaz-dp.png'
                    ),
                    array(
                        'name' => 'Mubashir Labar',
                        'desig' => 'Head of PR',
                        'dp' => 'mubashir-dp.png'
                    )
                )
                as $m
            ):
                echo '<div class="member flex col">
                    <img src="/ui/images/team/' . $m['dp'] . '" />
                    <h1 class="s20 b900">' . $m['name'] . '</h1>
                    <h1 class="s16 bold opacity-75">' . $m['desig'] . '</h1>
                </div>';
            endforeach;
        ?>
    </div>
</section>