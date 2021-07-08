<?php
    require '../functions.php';
    $data = getClientById($db,$_GET['id']);
    $check = $data['client_dnd'] == 1?"checked":"";
    echo '<input type="text" name="waitID" id="clientID" value="'.$data['client_id'].'" style="display:none">
        <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="'.$data['client_name'].'" placeholder="" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Phone</label>
            <input type="number" class="form-control" name="phone" id="phone" value="'.$data['client_phone'].'" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="'.$data['client_email'].'" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Client DND : </label>
            <input type="checkbox" class="form-check-input" style="margin : 0.4rem 0.5rem;height:20px;width:20px" name="email" id="dnd" value="'.$data['client_dnd'].'" autocomplete="off" '.$check.'>
        </div>
        ';
?>