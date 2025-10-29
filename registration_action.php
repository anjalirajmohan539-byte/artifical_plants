<?php

 include("database.php");

 if(isset($_POST["button"]))
 {
    $email=$_POST("email");
    $password=$_POST("password");
    $name=$_POST("fullname");
    $gender=$_POST("gender");
    $dob=$_POST("dob");
    $phoneno=$_POST("phone");
    $whatsapp=$_POST("whatsapp_phone");
    $address=$_POST("address");
    $pincode=$_POST("pincode");
    $city=$_POST("city");
    $state=$_POST("state");
    $country=$_POST("country");


    $insert="";
 }

?>