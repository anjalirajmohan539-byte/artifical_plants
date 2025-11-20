<?php

include('database.php');

if(isset($_POST['btn']))
{
    $image = $_FILES['image']['name'];
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $material = $_POST['productMaterial'];
    $type = $_POST['productType'];
    $colorname = $_POST['colorName'];
    $colorcode = $_POST['colorCode'];
    $description = $_POST['productDesc'];

    // Check duplicate product
    $select = "SELECT Id FROM `add_product` WHERE ProductName='$name' AND CategoryId=$type";
    $statemnt = mysqli_query($conn, $select);

    if(!$statemnt) {
        echo "Error checking duplicate.";
        exit;
    }

    if(mysqli_num_rows($statemnt) > 0) {
        echo "Product already exists";
        exit;
    }

    // Insert into add_product
    $insert_product = "INSERT INTO `add_product`
        (`ProductImage`, `ProductName`, `Description`, `Price`, `CategoryId`, `MaterialId`,)
        VALUES ('$image','$name','$description',$price,$type,$material)";

    $statement = mysqli_query($conn, $insert_product);

    if(!$statement) {
        echo "Product insert error";
        exit;
    }

    // Get last inserted product ID
    $product_id = mysqli_insert_id($conn);

    // Insert color details table
    $insert_color = "INSERT INTO `product_color_details` (`ProductId`, `ColorCode`, `ColorName`)
                     VALUES ($product_id, '$colorname', '$colorcode')";

    $color_statement = mysqli_query($conn, $insert_color);

    if(!$color_statement){
        echo "Color insert error";
        exit;
    }

    // Upload Product Image
    $image_path = "images/product/";
    $product_image = $image_path . basename($image);

    if(move_uploaded_file($_FILES['image']['tmp_name'], $product_image)) {
        echo "Product added successfully with color!";
    } else {
        echo "Image Upload Failed";
    }
}

?>