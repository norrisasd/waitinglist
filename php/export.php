<?php
    require 'functions.php';
    $filename="data_".date("ymd").".xls";
        header('Content-type: application/vnd-ms-excel');
        header("Content-Disposition:attachment;filename=\"$filename\"");
        echo $_SESSION['exportData'];
?>