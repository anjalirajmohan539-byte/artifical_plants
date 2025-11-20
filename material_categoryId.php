<?php
include("database.php");

if($_SERVER['REQUEST_METHOD'] == 'Post')
{
    echo $_POST['productMaterial'];

    $name= $_POST['productMaterial'];
    $id = $_POST['materialCategory'];

    $select="SELECT `Name`, `Type` FROM `material_category` WHERE `Type`=$id";
    $statement = mysqli_query($conn,$select);

    if(mysqli_num_rows($statement)>0)
    {
      
    }
}

?>