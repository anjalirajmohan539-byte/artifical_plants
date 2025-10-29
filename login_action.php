<?php

include("database.php");

if(isset($_POST["button"]))
{
    $email=$_POST("email");
    $password=$_POST("password");


    $select="SELECT `Id`, `UserEmail`, `Password`, `UserType` FROM `login` WHERE "
}

?>