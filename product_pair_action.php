<?php
include('database.php');

if(isset($_POST['btn']))
{
    $image = $_FILES['Image']['name'];
    $proId = $_POST['product_Id'];
    $name = $_POST['Name'];
    $price = $_POST['Price'];
    $description = $_POST['Description'];
    

    $select = "SELECT `Id` FROM `product_pair` WHERE";
}
?>