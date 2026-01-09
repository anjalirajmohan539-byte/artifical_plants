<?php
include('database.php');

if (isset($_POST['btn'])) {

    $imageId = $_POST['imageId'];
    $product_id = $_POST['proId'];
    $image_name = $_FILES['image']['name'];
    $tmp_name   = $_FILES['image']['tmp_name'];


    if ($image_name == "") {
        echo "Please select an image.";
        exit;
    }
    $upload_path = "images/product/" . $image_name;

    if (!move_uploaded_file($tmp_name, $upload_path)) {
        echo "Failed to upload image.";
        exit;
    }

        if($imageId != 0)
    {
    
    $update = "UPDATE `product_images` SET `Images`='$image_name',`ProductId`=$product_id,`LastUpdate`= CURRENT_TIMESTAMP WHERE `Id`=$imageId";
    $upstatemnt = mysqli_query($conn,$update);

    if(!$upstatemnt)
        {
            echo "error2";
        } 
        else {
                header("image.php?productId=$product_id");
            }
    }
    else
    {

    $check = "SELECT Id FROM product_images WHERE ProductId = $product_id  AND Images = '$image_name' AND IsDelete = 0";

    $check_result = mysqli_query($conn, $check);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Image already exists for this product!";
        exit;
    }

    $insert = "INSERT INTO product_images (Images, ProductId) 
               VALUES ('$image_name', $product_id)";
    
    $insert_result = mysqli_query($conn, $insert);

    if (!$insert_result) {
        echo "Error inserting into database!";
        exit;
    }
    header("Location: image.php?productId=$product_id");
    exit;
}
}
elseif(isset($_POST['delete']))
{
    $imgId = $_POST['id'];
    $proID = $_POST['pid'];

     $dupdate = "UPDATE product_images SET IsDelete = 1 WHERE Id = $imgId";
     $statement_delete = mysqli_query($conn,$dupdate);

     if(!$statement_delete)
     {
        echo "Error1";
     }
     else
     {
        header("location:image.php?productId=$proID");
     }
}
?>

