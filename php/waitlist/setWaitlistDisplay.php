<?php
    session_start();
    $type = $_POST['type'];
    $_SESSION[$type]=true;
?>