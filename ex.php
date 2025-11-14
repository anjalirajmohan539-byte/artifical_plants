<?php
include('database.php');

if(isset($_POST['btn']))
{
    $cid = $_POST['id'];             // material_type Id
    $name = $_POST['productType'];   // category name

    // Validation
    if(empty($name) || empty($cid)){
        echo "Missing fields!";
        exit;
    }

    // Prevent duplicate category under same type
    $check = "SELECT * FROM material_category WHERE Name = '$name' AND Type = '$cid'";
    $checkResult = mysqli_query($conn, $check);

    if(mysqli_num_rows($checkResult) > 0){
        echo "Category already exists!";
        exit;
    }

    // Insert new category
    $insert = "INSERT INTO material_category (Name, Type) VALUES ('$name', $cid)";
    $result = mysqli_query($conn, $insert);

    if($result){
        header("Location: material_category.php");
        exit;
    } else {
        echo "Insert Error!";
    }
}
?>

