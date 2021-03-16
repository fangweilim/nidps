<?php
   $con = mysqli_connect("localhost","root","");
    if(!$con){
        die('connection error');
    }else{
        mysqli_select_db($con,"db") or die('unable to connect with the database');
    }
?>
