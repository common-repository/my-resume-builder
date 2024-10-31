<?php

/*

Plugin Name: 	My Resume Builder
Plugin URI: 	https://wordpress.org/plugins/my-resume-builder/
Description: 	My Resume Builder plugin allows you to create appealing Resumes and share it with others.
Author: 		Abdi Tolessa
Author URI: 	https://abditsori.com
Version: 		1.0.3
Text Domain: 	my-resume-builder
Domain Path: 	languages
License:     	GPL2

*/

function mrb_custom_post_type(  )
{
    register_post_type( 
        'mrb',
        array( 
            'labels'      => array( 
                'name'          => __( 'My Resumes', 'textdomain' ),
                'singular_name' => __( 'My Resume', 'textdomain' ),
             ),
            'public'             => true,
            'publicly_queryable' => true,
            'has_archive'        => true,
            'supports'           => array( 'title', 'thumbnail' )
         )
     );
}

add_action( 'init', 'mrb_custom_post_type' );

function mrb_flush_rewrite_rules(  ) {
    mrb_custom_post_type(  );
    flush_rewrite_rules(  );
}
register_activation_hook(  __FILE__, 'mrb_flush_rewrite_rules'  );

function mrb_admin_scripts( $hook )
{
    $post_type = get_post_type(  );
    if ( $post_type == 'mrb' ) {
        // include scripts in the admin page
        wp_enqueue_script( 'mrb-admin-script', plugin_dir_url( __FILE__ ) . 'js/admin-script.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script( 'mrb-bootstrap-js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js' );
        wp_enqueue_script( 'mrb-media-uploader', plugin_dir_url( __FILE__ ) . 'js/media_uploader.js' );
        wp_enqueue_script( 'mrb-ckeditor', plugin_dir_url( __FILE__ ) . 'js/ckeditor/ckeditor.js' );

        // include styles in the admin page
        wp_enqueue_style( 'mrb-admin-style', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css' );
        wp_enqueue_style( 'mrb-custom-style', plugin_dir_url( __FILE__ ) . 'css/custom.css' );
        wp_enqueue_style( 'mrb-fontawesome', plugin_dir_url( __FILE__ ) . 'css/fontawesome-all.min.css' );
    }
}
add_action( 'admin_enqueue_scripts', 'mrb_admin_scripts' );

add_action( 'add_meta_boxes_mrb', 'mrb_single_box' );

function mrb_single_box( $post )
{
    $postmeta_value = get_post_meta( $post->ID, '_mrb_meta_key', false )[0];
    add_meta_box( 
        'mrb_exp_box',
        'Edit Your Resume',
        'mrb_single_box_template',
        'mrb',
        'normal',
        'low',
        array( 
            'meta_data' => $postmeta_value
         )
     );
}

function mrb_single_box_template( $post, $metabox )
{
?>
    <div class="row">
        <!-- <span><?php print_r( $metabox['args']['meta_data']['mrb_contact'] ) ?></span> -->
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active show" id="v-pills-contact-tab" data-toggle="pill" href="#contact" role="tab" aria-controls="v-pills-home" aria-selected="true">Personal Info</a>
            <a class="nav-link" id="v-pills-history-tab" data-toggle="pill" href="#history" role="tab" aria-controls="v-pills-profile" aria-selected="false">Work / Education</a>
            <a class="nav-link" id="v-pills-skills-tab" data-toggle="pill" href="#skills" role="tab" aria-controls="v-pills-messages" aria-selected="false">Skills</a>
            <a class="nav-link" id="v-pills-projects-tab" data-toggle="pill" href="#projects" role="tab" aria-controls="v-pills-settings" aria-selected="false">Projects</a>
        </div>
        <div id="content-block" class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div id="contact" class="tab-pane fade active show" role="tabpanel" aria-labelledby="v-pills-contact-tab">
                    <div class="heading">
                        <h5>Personal Information</h5>
                    </div>
                    <div class="fields-section">
                        <?php $mrb_contact = $metabox['args']['meta_data']['mrb_contact']; ?>
                        <div class="field-row"><label for="mrb_contact[name]">Name</label>
                            <input type="text" name="mrb_contact[name]" value="<?php 
                            if ( $mrb_contact['name'] ) echo esc_attr( $mrb_contact['name'] ) 
                            ?>">
                        </div>
                        <div class="field-row">
                            <label for="mrb_contact[email]">Email</label>
                            <input type="text" name="mrb_contact[email]" value="<?php 
                            if ( $mrb_contact['email'] ) echo esc_attr( $mrb_contact['email'] ) 
                            ?>">
                        </div>
                        <div class="field-row">
                            <label for="mrb_contact[website]">Website</label>
                            <input type="text" name="mrb_contact[website]" value="<?php 
                            if ( $mrb_contact['website'] ) echo esc_attr( $mrb_contact['website'] ) 
                            ?>">
                        </div>
                        <div class="field-row">
                            <label for="mrb_contact[phone]">Phone</label>
                            <input type="text" name="mrb_contact[phone]" value="<?php 
                            if ( $mrb_contact['phone'] ) echo esc_attr( $mrb_contact['phone'] ) 
                            ?>">
                        </div>
                        <div class="field-row">
                            <label for="mrb_contact[address]">Address</label>
                            <textarea id="mytextarea" type="text" class="ckeditor" name="mrb_contact[address]" value="<?php 
                                if ( $mrb_contact['address'] ) echo esc_attr( $mrb_contact['address'] ) 
                                ?>">
                                <?php if ( $mrb_contact['address'] ) echo esc_html( $mrb_contact['address'] ) ?> 
                            </textarea>
                        </div>
                        <div class="field-row">
                            <label for="mrb_contact[photo_url]">Profile Photo</label>
                            <input id="photo_url" type="text" name="mrb_contact[photo_url]" value="<?php 
                            if ( $mrb_contact['name'] ) echo esc_html( $mrb_contact['photo_url'] )
                            ?>">
                            <input id="upload_image_button" type="button" class="button-primary" value="Insert Image" />
                        </div>
                        <img style="width:5em;" src="<?php
                            if ( $mrb_contact['photo_url'] ) {
                                echo esc_html( $mrb_contact['photo_url'] );
                            } else {
                                echo plugin_dir_url( __FILE__ ) . 'images/avatar-default-circle.png';
                            }
                        ?>">
                    </div>
                </div>

                <div id="history" class="tab-pane fade" role="tabpanel" aria-labelledby="v-pills-history-tab">
                    <div class="sortable">
                        <div class="heading">
                            <h5>Work Experience / Education</h5>
                        </div>
                        <?php $mrb_experience = $metabox['args']['meta_data']['mrb_experience']; ?>
                        <span id="last_index" data-last_index="<?php echo max( array_keys( $mrb_experience ) ) ?>"></span>
                        <?php foreach ( $mrb_experience as $key => $experience ) {
                            //if the key starts with 'title'
                            if ( strpos( $key, 'title' ) === 0 ) {
                                echo '
                            <div style="position:relative;">
                                <div class="fields-section">
                                    <i class="fas fa-bars handle"></i>
                                    <div class="field-row">
                                        <input type="text" class="text-center" name="mrb_experience[' . $key . ']" value=" ' . $experience . ' ">
                                    </div>
                                    <div style="" class="delete_button">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                    </svg>
                                </div>
                                </div>
                            </div>
                            ';
                                continue;
                            }
                        ?>
                            <div style="position:relative;">
                                <div class="fields-section">
                                    <i class="fas fa-bars handle"></i>
                                    <div class="field-row">
                                        <label for=" mrb_experience[<?php echo esc_attr( $key ) ?>][date_range] ">Date Range</label>
                                        <input type="text" name="mrb_experience[<?php echo esc_attr( $key ) ?>][date_range]" value="<?php 
                                            echo esc_attr( $experience['date_range'] ) 
                                        ?>">
                                    </div>
                                    <div class="field-row">
                                        <label for=" mrb_experience[<?php echo esc_attr( $key ) ?>][position] ">Job Title / Degree</label>
                                        <input type="text" name="mrb_experience[<?php echo esc_attr( $key ) ?>][position]" value="<?php 
                                            echo esc_attr( $experience['position'] ) 
                                        ?>">
                                    </div>
                                    <div class="field-row">
                                        <label for=" mrb_experience[<?php echo $key ?>][company] ">Company / School</label>
                                        <input type="text" name="mrb_experience[<?php echo esc_attr( $key ) ?>][company]" value="<?php 
                                            echo esc_attr( $experience['company'] )
                                        ?>">
                                    </div>
                                    <div class="field-row">
                                        <label for=" mrb_experience[<?php echo $key ?>][roles] ">Key Roles / Courses</label>
                                        <textarea type="text" class="ckeditor" name="mrb_experience[<?php echo esc_html( $key ) ?>][roles]" value="<?php 
                                            echo esc_attr( $experience['roles'] ) 
                                        ?>"><?php echo esc_html( $experience['roles'] ) ?></textarea>
                                    </div>
                                    <div style="" class="delete_button">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div id="skills" class="tab-pane fade" role="tabpanel" aria-labelledby="v-pills-skills-tab">
                    <div class="sortable">
                        <div class="heading">
                            <h5>Professional Skills</h5>
                        </div>
                        <span><?php $mrb_skills = $metabox['args']['meta_data']['mrb_skills']; ?></span>
                        <span id="last_index_skills" data-last_index="<?php echo max( array_keys( $mrb_skills ) ) ?>"></span>
                        <?php foreach ( $mrb_skills as $key => $skill ) {
                            //if the key starts with title
                            if ( strpos( $key, 'title' ) === 0 ) {
                                //echo "<h3>$experience</h3>";
                                echo '
                            <div style="position:relative;">
                                <div class="fields-section">
                                    <i class="fas fa-bars handle"></i>
                                    <div class="field-row">
                                        <input type="text" class="text-center" name="mrb_skills[' . $key . ']" value=" ' . $skill . ' ">
                                    </div>
                                    <div style="" class="delete_button">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                    </svg>
                                </div>
                                </div>
                            </div>
                            ';
                                continue;
                            }
                        ?>
                            <div style="position:relative;">
                                <div class="fields-section">
                                    <i class="fas fa-bars handle"></i>
                                    <div class="field-row">
                                        <label for=" mrb_skills[<?php echo esc_attr( $key ) ?>][skill_type] ">Skill Type</label>
                                        <input type="text" name="mrb_skills[<?php echo esc_attr( $key ) ?>][skill_type]" value="<?php 
                                            echo esc_attr( $skill['skill_type'] )
                                        ?>">
                                    </div>
                                    <div class="field-row">
                                        <label for=" mrb_skills[<?php echo esc_attr( $key ) ?>][description] ">Description</label>
                                        <textarea type="text" class="ckeditor" name="mrb_skills[<?php echo esc_attr( $key ) ?>][description]" value="<?php 
                                            echo esc_attr( $skill['description'] ) 
                                            ?>">
                                            <?php echo esc_html( $skill['description'] ) ?>
                                        </textarea>
                                    </div>
                                    <div class="delete_button">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <br>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div id="projects" class="tab-pane fade" role="tabpanel" aria-labelledby="v-pills-projects-tab">
                    <div class="sortable">
                        <div class="heading">
                            <h5>Projects</h5>
                        </div>
                        <?php $mrb_projects = $metabox['args']['meta_data']['mrb_projects']; ?>
                        <span id="last_index_projects" data-last_index="<?php echo max( array_keys( $mrb_projects ) ) ?>"></span>
                        <?php foreach ( $mrb_projects as $key => $project ) {
                            //if the key starts with title
                            if ( strpos( $key, 'title' ) === 0 ) {
                                echo '
                            <div style="position:relative;">
                                <div class="fields-section">
                                    <i class="fas fa-bars handle"></i>
                                    <div class="field-row">
                                        <input type="text" class="text-center" name="mrb_projects[' . $key . ']" value=" ' . $project . ' ">
                                    </div>
                                    <div style="" class="delete_button">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            ';
                                continue;
                            }
                        ?>
                            <div style="position:relative;">
                                <div class="fields-section">
                                    <i class="fas fa-bars handle"></i>
                                    <div class="field-row">
                                        <label for=" mrb_projects[<?php echo esc_attr( $key ) ?>][project_type] ">Project Name</label>
                                        <input type="text" name="mrb_projects[<?php echo esc_attr( $key ) ?>][project_type]" value="<?php 
                                            echo esc_attr( $project['project_type'] ) 
                                        ?>">
                                    </div>
                                    <div class="field-row">
                                        <label for=" mrb_projects[<?php echo esc_attr( $key ) ?>][description] ">Description</label>
                                        <textarea type="text" class="ckeditor" name="mrb_projects[<?php echo esc_attr( $key ) ?>][description]" value="<?php 
                                            echo esc_attr( $project['description'] ) ?>"><?php echo esc_html( $project['description'] ) ?>
                                        </textarea>
                                    </div>
                                    <div class="delete_button">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <br>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}

/**  */

function is_mrb_field( $field_name )
{
    if ( strpos( $field_name, 'mrb' ) === 0 ) return true;
    return false;
}

function mrb_save_postdata( $post_id )
{
    $array_keys = array_keys( $_POST );
    $mrb_keys = array_filter( $array_keys, 'is_mrb_field' );

    // filter the POST data to destroy unwanted data
    foreach ( $_POST as $key => $val ) {
        if ( !in_array( $key, $mrb_keys ) ) {
            unset( $_POST[$key] );
        }
    }

    // assign the filtered POST data to a variable
    $mrb_post_data = $_POST;

    // Sanitize the filtered test data
    foreach ($mrb_post_data as $parent_key=>$type){
        if ( $parent_key == 'mrb_contact'){
            $mrb_post_data[$parent_key]['name'] = sanitize_text_field($mrb_post_data[$parent_key]['name']);
        } else {
            foreach ( $type as $current_key=>$val){

                $keys = array_keys($val);
    
                foreach ($keys as $key){
                        if ( !($key == 'roles' || $key == 'description' || $key == 'address') ){
                            $mrb_post_data[$parent_key][$current_key][$key] = sanitize_text_field($mrb_post_data[$parent_key][$current_key][$key]);
                            // echo '<script>alert("text input : '.var_dump($mrb_post_data[$parent_key][$current_key][$key]).'")</script>';
                        }
                }
            }
        }
    }
    // var_dump("test");
    // die("");

    if ( !add_post_meta( $post_id, '_mrb_meta_key', $mrb_post_data, true ) ) {
        update_post_meta( 
            $post_id,
            '_mrb_meta_key',
            $mrb_post_data
         );
    }
}
add_action( 'save_post', 'mrb_save_postdata' );

/**
 * Singular post template
 */
add_filter( 'single_template', 'mrbp_plugin_template' );

function mrbp_plugin_template(  )
{
    define( 'MRBP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
    load_template( MRBP_PLUGIN_PATH . 'templates/my-resume.php', false );
}

?>