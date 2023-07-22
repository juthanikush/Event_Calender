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
session_start();
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
                    $upload_dir = 'upload/';
    
                    // Create the 'uploads' directory if it doesn't exist
                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0755, true);
                    }
                    $image_name = $_FILES["image"]["name"];
                    $image_tmp_name = $_FILES["image"]["tmp_name"];
                    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                    $image_name=uniqid('image_') . '.' . $image_extension;
                    $image_path = $upload_dir . $image_name;
            
                    // Move the uploaded image to the destination directory
                    if (move_uploaded_file($image['tmp_name'], $image_path)) {
                        // Image uploaded successfully, you can now save the image path or perform further actions
                    } else {
                        echo 'Failed to upload the image.';
                    }
                }
            if(isset($_POST['event'])){
                //update data
                //post update
                $post_id=$_POST['event'];
                $post_data = array(
                    'ID' => $post_id,           // Required: The post ID of the post to update.
                    'post_title' => $_POST['title'], // The updated post title.
                    'post_content' => "", // The updated post content.
                    // Add any other post properties you want to update here.
                  );
                wp_update_post($post_data);
            }
            else{
                //insert data
                $post_id = wp_insert_post(array(
                    'post_title' => $_POST['title'], // Set the post title
                    'post_type' => 'event', // Set the post type (e.g., 'post', 'page', or a custom post type)
                    'post_status' => 'publish' // Set the post status (e.g., 'publish', 'draft', etc.)
                ));
                
            }
            update_post_meta($post_id, 'title',$_POST['title']);
            update_post_meta($post_id,  'description',$_POST['description']);
            update_post_meta($post_id,  'date',$_POST['date']);
            update_post_meta($post_id,  'time',$_POST['time']);
            update_post_meta($post_id,  'location', $_POST['location']);
            update_post_meta($post_id,  'organizer', $_POST['organizer'],);
            update_post_meta($post_id,  'img', $image_path);
            
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

function delete_data() {
    
    $id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
    // Delete post meta data
    delete_post_meta($id, 'title');
    delete_post_meta($id, 'description');
    delete_post_meta($id, 'date');
    delete_post_meta($id, 'time');
    delete_post_meta($id, 'location');
    delete_post_meta($id, 'organizer');
    delete_post_meta($id, 'img');
    // Delete the post
    wp_delete_post($id, true);
    echo 'Data Deleted successfully';
    wp_reset_postdata();
    wp_die();
    
}
add_action('wp_ajax_delete_data', 'delete_data');

function display_data(){
    
    $id =$_POST['post_id'];
    
    $title=get_post_meta($id,'title',true);
    $description=get_post_meta($id,'description',true);
    $location=get_post_meta($id,'location',true);
    $date=get_post_meta($id,'date',true);
    $time=get_post_meta($id,'time',true);
    $organizer=get_post_meta($id,'organizer',true);
 

  include plugin_dir_path(__FILE__).'editform.php'; 

} 


add_action('wp_ajax_display_data', 'display_data');

