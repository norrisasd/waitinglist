<?php
 require 'conn.php';
 
 $filename="data_".date("ymd").".xls";
 header('Content-type: application/vnd-ms-excel');
 header("Content-Disposition:attachment;filename=\"$filename\"");

?>