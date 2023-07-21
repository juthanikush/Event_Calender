
<form method="post" id="save_event" enctype="multipart/form-data">
    <h1>Add Event</h1>
    <div class="form-group">
        <label>Title:- </label>
        <input type="text" name="title" id="title">
    </div>
    <div class="form-group">
        <label>Description:- </label>
        <input type="text" name="description" id="description">
    </div>
    <div class="form-group">
        <label>Date:- </label>
        <input type="date" name="date" id="date">
    </div>
    <div class="form-group">
        <label>Time:- </label>
        <input type="time" name="time" id="time">
    </div>
    <div class="form-group">
        <label>Location:- </label>
        <input type="text"  name="location" id="location" class="file">
    </div>
    <div class="form-group">
        <label>Organizer:- </label>
        <input type="text" name="organizer" id="organizer">
    </div>
    <div class="form-group">
        <label>Featured image:- </label>
        <input type="file" name="image" accept="image/*">
    </div>
    
    <button type="submit" name="submit" class="btn btn-success">Submit</button>
    <button class="btn btn-danger" type="button" onclick="closeForm()" name="Submit">Close</button>
</form>


