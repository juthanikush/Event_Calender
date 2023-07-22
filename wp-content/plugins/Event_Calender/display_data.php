
<div class="wrap">
<h1 >My Event Calendar</h1>
<button type="button" onclick="openForm()" class="btn btn-success add-button" >+Add Event</button>
<table>
    <tr>
     
        <th>Title</th>
        <th>Description</th>
        <th>Date</th>
        <th>Time</th>
        <th>Location</th>
        <th>Organizer</th>
        <th>Featured image</th>
        
        <th>Action</th>
    </tr>
    <?php

        $args=array(
            'post_type'=>'event',
            'posts_per_page'=>-1
        );
        $query= get_posts($args);

        foreach($query as $post) {
            //Retrieve Post Data
            $post_id=$post->ID;
            $post_title = $post->post_title;
            $post_content = $post->post_content;

            //Retrieve Post Meta Data
            $description=get_post_meta($post_id,'description',true);
            $date=get_post_meta($post_id,'date',true);
            $time=get_post_meta($post_id,'time',true);
            $location=get_post_meta($post_id,'location',true);
            $organizer=get_post_meta($post_id,'organizer',true);
            $img=get_post_meta($post_id,'img',true);
            $upload_dir = wp_upload_dir();
            $path=$upload_dir['path'];
            ?>
            <tr>
                
                <td><?php echo $post_title ?></td>
                <td><?php echo $description ?></td>
                <td><?php echo $date ?></td>
                <td><?php echo $time ?></td>
                <td><?php echo $location ?></td>
                <td><?php echo $organizer ?></td>
                <td><img src="<?php echo $img ?>" alt="Girl in a jacket" width="100" height="100"> </td>
              
                <td><button class="btn btn-info" onclick="displaydata('<?php echo $post_id ?>')" >Edit</button>
                <button  class="btn btn-danger" onclick="deletedata('<?php echo $post_id ?>')">Delete</button></td>
            </tr>
           <?php } ?>
</table>
</div>





<div class="add_event" id="add_event">
<?php
include plugin_dir_path(__FILE__).'form.php';

?>
</div>

<div class="edit_event" id="edit_event"></div>

<!-- <?php
//include plugin_dir_path(__FILE__).'editform.php';

?>
</div> -->

