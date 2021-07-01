<?php
    require 'functions.php';
    $data = getListById($db,$_GET['id']);
    echo '<input type="text" name="waitID" id="waitID" value="'.$data['waitlist_id'].'" style="display:none">
        <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="'.$data['name'].'" placeholder="" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Phone</label>
            <input type="number" class="form-control" name="phone" id="phone" value="'.$data['phone'].'" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="'.$data['email'].'" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Start Date</label>
            <input type="date" class="form-control" name="sdate" id="sdate" value="'.$data['waitlist_start_date'].'" autocomplete="off" value="02/05/2021" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">End Date</label>
            <input type="date" class="form-control" name="edate" id="edate" value="'.$data['waitlist_end_date'].'" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Number of Passengers</label>
            <input type="number" class="form-control" name="passengers" id="passengers" value="'.$data['waitlist_num_passengers'].'" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Activity Name</label>
            <select name="aname" id="aname" required>
                <option value="'.$data['waitlist_activity_name'].'" selected hidden>'.$data['waitlist_activity_name'].'</option>
                <option value="MORNING SNORKELING TOURS">MORNING SNORKELING TOURS</option>
                <option value="AFTERNOON SNORKELING TOURS">AFTERNOON SNORKELING TOURS</option>
                <option value="GROUPS & PRIVATE CHARTERS">GROUPS & PRIVATE CHARTERS</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Additional Notes</label>
            <textarea class="form-control" name="notes" id="notes" autocomplete="off" >'.$data['waitlist_notes'].'</textarea>
        </div>';
?>