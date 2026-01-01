<?php
include('database.php');

if (isset($_POST['btn'])) {

    $image = $_FILES['Image']['name'];
    $tmp_name = $_FILES['Image']['tmp_name'];
    $proId = $_POST['product_Id'];
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $price = $_POST['Price'];
    $description = mysqli_real_escape_string($conn, $_POST['Description']);


    $select = "SELECT `Id` FROM product_pair WHERE ProductId = $proId";
    $check = mysqli_query($conn, $select);

    if (!$check) {
        echo "Select error";
    }

    if (mysqli_num_rows($check) > 0) {
        echo "Already exists";
    }


    $insert = "INSERT INTO `product_pair`(`ProductId`, `Image`, `Name`, `Price`, `Description`)
               VALUES ($proId, '$image', '$name', $price, '$description')";

    $statement = mysqli_query($conn, $insert);
    // var_dump($insert);

    if (!$statement) {
        echo "Insert error";
    }


    $image_path = "images/pair/";
    $target = $image_path . basename($image);

    if (move_uploaded_file($tmp_name, $target)) {
        header("Location: product_pair.php?productId=$proId");
    } else {
        echo "Image upload failed";
    }
}
?>
