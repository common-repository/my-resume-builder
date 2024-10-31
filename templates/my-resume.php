<?php

if (is_singular('mrb')) {

    function mrb_template_scripts()
    {
        wp_enqueue_style('mrb-custom-style', plugin_dir_url(__DIR__) . 'css/style.css');
        wp_enqueue_style('mrb-bootstrap', plugin_dir_url(__DIR__) . 'css/bootstrap.min.css');
    }

    add_action('wp_enqueue_scripts', 'mrb_template_scripts');

    get_header();

    $postmeta_value = get_post_meta(get_the_ID(), '_mrb_meta_key', false)[0];

    $mrb_contact = $postmeta_value['mrb_contact'];
    $mrb_history = $postmeta_value['mrb_experience'];
    $mrb_skills = $postmeta_value['mrb_skills'];
    $mrb_projects = $postmeta_value['mrb_projects'];
?>
    <div class="container">
        <!-- <div id="download_button">
            <button id="btn_download" type="button" style="float:right;" class="btn btn-secondary ml-5">Download pdf</button>
        </div> -->
        <div id="resume_box" class="row py-2 col-10" style="border-radius:5px; border-style:solid; border-width: 1px; border-color: #a9a7a7; width:100% !important; margin-top:10em !important;">

            <div class="col-3" style="background: #423e3e; color: #fff; ">
                <div class="sidebar-container py-2">
                    <img class="mb-3 aligncenter" style="width:10rem; border-radius:50%;" src="<?php if ($mrb_contact['photo_url']) echo esc_url( $mrb_contact['photo_url'] );
                                                                                                else {
                                                                                                    echo plugin_dir_url(__DIR__) . 'images/avatar-default-circle.png';
                                                                                                } ?>">
                    <div class="row pl-3 d-block py-2">
                        <img style="width:2em" src="<?php echo plugin_dir_url(__DIR__) . 'images/loc.jpg' ?>">
                        <span class="pl-2"><?php 
                            echo $mrb_contact['address']; 
                            ?>
                        </span>
                    </div>
                    <div class="row pl-3 d-block py-2">
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                        </svg>
                        <br>
                        <span class="pl-2"><?php echo esc_html( $mrb_contact['email'] ); ?></span>
                    </div>
                    <div class="row pl-3 d-block py-2">
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-phone" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M11 1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z" />
                            <path fill-rule="evenodd" d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                        <br>
                        <span class="pl-2"><?php echo esc_html( $mrb_contact['phone'] ); ?></span>
                    </div>
                    <div class="row pl-3 d-block py-2">
                        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-globe" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4H2.255a7.025 7.025 0 0 1 3.072-2.472 6.7 6.7 0 0 0-.597.933c-.247.464-.462.98-.64 1.539zm-.582 3.5h-2.49c.062-.89.291-1.733.656-2.5H3.82a13.652 13.652 0 0 0-.312 2.5zM4.847 5H7.5v2.5H4.51A12.5 12.5 0 0 1 4.846 5zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5H7.5V11H4.847a12.5 12.5 0 0 1-.338-2.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12H7.5v2.923c-.67-.204-1.335-.82-1.887-1.855A7.97 7.97 0 0 1 5.145 12zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11H1.674a6.958 6.958 0 0 1-.656-2.5h2.49c.03.877.138 1.718.312 2.5zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12h2.355a7.967 7.967 0 0 1-.468 1.068c-.552 1.035-1.218 1.65-1.887 1.855V12zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5h-2.49A13.65 13.65 0 0 0 12.18 5h2.146c.365.767.594 1.61.656 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4H8.5V1.077c.67.204 1.335.82 1.887 1.855.173.324.33.682.468 1.068z" />
                        </svg>
                        <br>
                        <span class="pl-2"><?php echo esc_html( $mrb_contact['website'] ); ?></span>
                    </div>

                </div>

            </div>
            <div id="main" class="col-8 py-3">
                <div class="name-block">
                    <!-- <h1><?php echo esc_html( explode(" ", $mrb_contact['name'])[0] ) ?></h1> -->
                    <?php 
                    $name_arr = explode(" ", $mrb_contact['name']);
                    if ( count($name_arr) > 0 ) {
                        foreach($name_arr as $name){
                            echo "<h1>".esc_html( $name )."</h1>";
                        }
                    } 
                    ?> 
                </div>
                <?php
                if(count($mrb_history) > 0){
                ?>
                    <section id="experience">
                        <div>
                            <div style="display:flex">
                                <h3 class="section-title">Education and Work History</h3>
                                <svg height="10" style="margin-left:5% !important; width:100%; align-self: center; margin-left: auto;">
                                    <line x1="0" y1="0" x2="100%" y2="0" style="stroke:rgb(150,150,150);stroke-width:5"></line>
                                </svg>
                            </div>

                            <?php foreach ($mrb_history as $key => $history) {
                                if (strpos($key, 'title') === 0) { // if it is a title
                                    echo '<h4 class="section-title text-center">' . esc_html( $history ) . '</h4>';
                                    continue;
                                }
                            ?>
                                <div class="row px-2 my-1">
                                    <svg width="100%" height="15">
                                        <circle cx="10" cy="10" r="5" fill="none" stroke="#565656" stroke-width="2"></circle>
                                    </svg>
                                    <svg width="20px" viewBox="0 0 20 20" preserveAspectRatio="none">
                                        <line x1="10" y1="0" x2="10" y2="100%" stroke="#565656" stroke-width="3" vector-effect="non-scaling-stroke"></line>
                                    </svg>
                                    <div class="history-block col">
                                        <span style="font-size: 1vw; color: #454545;">
                                            <?php $history['date_range'] ?>
                                        </span><br>
                                        <span style="font-weight: bold; color: #454545; font-size: 1.5vw;">
                                            <?php echo $history['position'] ?>
                                        </span><br>
                                        <span style="font-size: 1vw; color: #454545;">
                                            <?php echo $history['company'] ?>
                                        </span><br>
                                        <span><?php echo $history['roles'] ?></span>
                                    </div>
                                </div>
                            <?php
                            }

                            ?>
                        </div>
                    </section>
                <?php
                }
                ?>
                
                <?php
                    if(count($mrb_skills) > 0){
                ?>
                <section id="skills">
                    <div>
                        <div style="display:flex">
                            <h3 class="section-title">Skills</h3>
                            <svg height="10" style="margin-left:5% !important; width:75%; align-self: center; margin-left: auto;">
                                <line x1="0" y1="0" x2="100%" y2="0" style="stroke:rgb(150,150,150);stroke-width:5"></line>
                            </svg>
                        </div>

                        <?php foreach ($mrb_skills as $key => $skill) {
                            if (strpos($key, 'title') === 0) { // if it is a title
                                echo '<h4 class="section-title text-center">' .  $skill . '</h4>';
                                continue;
                            }
                        ?>
                            <div class="skills-block col">
                                <p><?php echo  $skill['skill_type']  ?></p>
                                <p><?php echo  $skill['description']  ?></p>
                            </div>
                        <?php
                        }

                        ?>
                    </div>
                </section>
                <?php
                }
                ?>
                <?php
                    if(count($mrb_projects) > 0){
                ?>
                <section id="projects">
                    <div>
                        <div style="display:flex">
                            <h3 class="section-title">Projects</h3>
                            <svg height="10" style="margin-left:5% !important; width:75%; align-self: center; margin-left: auto;">
                                <line x1="0" y1="0" x2="100%" y2="0" style="stroke:rgb(150,150,150);stroke-width:5"></line>
                            </svg>
                        </div>
                        <?php foreach ($mrb_projects as $key => $project) {
                            if (strpos($key, 'title') === 0) { // if it is a title
                                echo '<h4 class="section-title text-center">' . esc_html( $project ) . '</h4>';
                                continue;
                            }
                        ?>
                            <div class="projects-block col">
                                <p><?php echo $project['project_type'] ?></p>
                                <p><?php echo $project['description'] ?></p>
                            </div>
                        <?php
                        }

                        ?>
                    </div>
                </section>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>

<?php
}

?>