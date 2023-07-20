<?php
/*
 * Plugin Name:       Event Calender
 * Plugin URI:        https://github.com/juthanikush/Event_Calender
 * Description:       Add Event and get Notification and save all other information etc...
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Kush Juthani
 * Author URI:        https://github.com/juthanikush
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       Event_Calender
 */

// Add a Event Calender top-level menu item in the WordPress admin menu
function my_Event_Calender_menu() {
    add_menu_page(
        'My Event Calendar',
        'Event Calendar',
        'manage_options',
        'my-admin-component',
        'my_Event_Calendar_page',
        'dashicons-calendar',
        
    );
}
add_action('admin_menu', 'my_Event_Calender_menu');

// Callback function to display the admin page
function my_Event_Calendar_page() {
    include plugin_dir_path(__FILE__).'display_data.php';
}

function Save_Data(){
    if(is_user_logged_in()== true){
        if (isset($_POST['submit'])) {
            $image = $_FILES['image'];
            if ($image['name']) {
                // Set the upload directory and file name
                $upload_dir = wp_upload_dir();
                $image_name = $image['name'];
                $image_path = $upload_dir['path'] . '/' . $image_name;
        
                // Move the uploaded image to the destination directory
                if (move_uploaded_file($image['tmp_name'], $image_path)) {
                    // Image uploaded successfully, you can now save the image path or perform further actions
        
                   
                  
                } else {
                    
                    echo 'Failed to upload the image.';
                }
            }
           
            $post_id = wp_insert_post(array(
                'post_title' => $_POST['title'], // Set the post title
                'post_type' => 'event', // Set the post type (e.g., 'post', 'page', or a custom post type)
                'post_status' => 'publish' // Set the post status (e.g., 'publish', 'draft', etc.)
            ));
            if($post_id){
                update_post_meta($post_id, 'title',$_POST['title']);
                update_post_meta($post_id,  'description',$_POST['description']);
                update_post_meta($post_id,  'date',$_POST['date']);
                update_post_meta($post_id,  'time',$_POST['time']);
                update_post_meta($post_id,  'location', $_POST['location']);
                update_post_meta($post_id,  'organizer', $_POST['organizer'],);
                update_post_meta($post_id,  'img', $image_name);
            }
           
            
            
            
        }
    }
    else{
        echo "Please login first.";
    } 
}
add_action('init', 'Save_Data');


// Register custom page template
function custom_form_page_template($templates) {
    $templates['form.php'] = 'ADD Data';
    return $templates;
}
add_filter('theme_page_templates', 'custom_form_page_template');


 
// Load the custom page template
function load_custom_form_page_template($template) {
    if (is_page_template('form.php')) {
        $new_template = plugin_dir_path(__FILE__) . 'form.php';
        if (file_exists($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'load_custom_form_page_template');




function add_Event_Calender(){
    wp_enqueue_style('admin-style',plugins_url('include/css/style.css',__FILE__));
    wp_enqueue_style('admin-bootstrap',plugins_url('include/css/bootstrap.css',__FILE__));
    wp_enqueue_script('admin-javascript',plugins_url('include/js/admin_script.js',__FILE__));
}
add_action('admin_enqueue_scripts','add_Event_Calender');

