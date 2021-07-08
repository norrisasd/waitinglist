<?php
    require '../functions.php';
    $data = getUserByUsername($db,$_GET['user']);
    echo '
        <input type="text" value="'.$data['username'].'" id="prevUser" style="display:none">
        <div class="form-group">
            <label for="exampleFormControlInput1">Username</label>
            <input type="text" class="form-control" id="username1" value="'.$data['username'].'" placeholder="" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Password</label>
            <input type="text" class="form-control" id="password1" value="'.$data['password'].'" placeholder="" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Email</label>
            <input type="text" class="form-control" id="email1" value="'.$data['email'].'" autocomplete="off" required>
        </div>
        ';
?>