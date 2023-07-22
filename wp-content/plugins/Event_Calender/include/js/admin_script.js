function openForm() {
    document.getElementById("add_event").style.display = "block";
}
  
function closeForm() {
    document.getElementById("add_event").style.display = "none";
}

function openeditForm() {
    
    document.getElementById("edit_event").style.display = "block";
}
  


function closeeditForm() {
    document.getElementById("edit_event").style.display = "none";
}



function displaydata(id) {
    
    var id=id;
   
    jQuery(document).ready(function($) {
        $.ajax({
            url: ajaxurl, // ajaxurl is a global variable that points to the WordPress AJAX handler
            type: 'post',
            data: {
                action: 'display_data', // Replace with the name of your plugin AJAX function
                post_id: id, // Pass the ID as a parameter
            },
            success: function(response) {
                alert(response);
                const divtag=document.getElementById("edit_event")
                divtag.innerHTML=response;
                //document.getElementById('id').value=id;
                
                openeditForm();
                
                // Handle the response from the server, if needed
                
            },
            error: function(error) {
                alert(error);
                // Handle errors, if any
                console.log(error);
            }
        });
    });
    
}

function deletedata(id) {
    
    
    jQuery(document).ready(function($) {
        $.ajax({
            url: ajaxurl, // ajaxurl is a global variable that points to the WordPress AJAX handler
            type: 'post',
            data: {
                action: 'delete_data', // Replace with the name of your plugin AJAX function
                post_id: id, // Pass the ID as a parameter
               
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


   
  

