function openForm() {
    document.getElementById("add_event").style.display = "block";
}
  
function closeForm() {
    document.getElementById("add_event").style.display = "none";
}

function displaydata(id) {
    
    jQuery(document).ready(function($) {
        $.ajax({
            url: ajaxurl, // ajaxurl is a global variable that points to the WordPress AJAX handler
            type: 'post',
            data: {
                action: 'display_data', // Replace with the name of your plugin AJAX function
                post_id: id // Pass the ID as a parameter
            },
            success: function(response) {
                alert(response.event);
                document.getElementById("add_event").style.display = "block";
                //location.reload();
                // Handle the response from the server, if needed
                alert(response);
            },
            error: function(error) {
                alert(error);
                // Handle errors, if any
                console.log(error);
            }
        });
    });
    
}

function deletedata(id){
    var id=id;
    
    jQuery(document).ready(function($) {
        $.ajax({
            url: ajaxurl, // ajaxurl is a global variable that points to the WordPress AJAX handler
            type: 'post',
            data: {
                action: 'delete_data', // Replace with the name of your plugin AJAX function
                post_id: id // Pass the ID as a parameter
            },
            success: function(response) {
                
                location.reload();
                // Handle the response from the server, if needed
                console.log(response);
            },
            error: function(error) {
                alert(error);
                // Handle errors, if any
                console.log(error);
            }
        });
    });

}


   
  

