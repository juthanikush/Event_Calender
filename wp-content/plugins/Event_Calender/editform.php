
<form method="post" id="editform"  enctype="multipart/form-data">
    <h1>Edit Event</h1>
    <input type="hidden" name="event" value="<?php echo $id; ?>">
    <div class="form-group">
        <label>Title:- </label>
        <input type="text" name="title" id="title" value="<?php echo $title   ?>">
    </div>
    <div class="form-group">
        <label>Description:- </label>
        <input type="text" name="description" id="description"  value="<?php echo $description; ?>">
    </div>
    <div class="form-group">
        <label>Date:- </label>
        <input type="date" name="date" id="date"  value="<?php echo $date ?>">
    </div>
    <div class="form-group">
        <label>Time:- </label>
        <input type="time" name="time" id="time"  value="<?php echo $time ?>">
    </div>
    <div class="form-group">
        <label>Location:- </label>
        <input type="text"  name="location" id="location" class="file"  value="<?php echo $location ?>">
    </div>
    <div class="form-group">
        <label>Organizer:- </label>
        <input type="text" name="organizer" id="organizer"  value="<?php echo $organizer ?>">
    </div>
    <div class="form-group">
        <label>Featured image:- </label>
        <input type="file" name="image" accept="image/*">
    </div> 
    <button type="submit" name="submit" class="btn btn-success">Submit</button>
    <button class="btn btn-danger" type="button" onclick="closeeditForm()" name="Submit">Close</button>
</form>



