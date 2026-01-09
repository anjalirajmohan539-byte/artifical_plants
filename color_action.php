<?php
include('database.php');

if(isset($_POST['btn']))
{
    $coid = $_POST['coid'];
    $pid = $_POST['productId'];
    $color = $_POST['color'];
    $code = $_POST['colorCode'];
    $status = $_POST['colorStatus'];


    if ($coid != 0)
    {
    $update = "UPDATE `product_color_details` SET `ColorCode`='$code',`ColorName`='$color',`Status`=$status,`LastDate`=CURRENT_TIMESTAMP WHERE `Id`= $coid";
    $upstatemnt = mysqli_query($conn,$update);

    if (!$upstatemnt) 
        {
            echo "error2";
        } 
        else {
                header("color.php?productId=$pid");
            }
    } 
    else 
{
    $select = "SELECT `ProductId` FROM `product_color_details` WHERE ProductId = $pid AND IsDelete = 0 AND (ColorName='$color' OR ColorCode='$code')";
    $statemnt = mysqli_query($conn, $select);

    if(mysqli_num_rows($statemnt) > 0)
    {
        echo "Color already exists for this product";
        exit;
    }

    // INSERT COLOR
    $insert = "INSERT INTO `product_color_details`(`ProductId`, `ColorCode`, `ColorName`,`Status`) 
               VALUES ($pid,'$code','$color',$status)";
    $insert_statemnt = mysqli_query($conn, $insert);

    if(!$insert_statemnt)
    {
        echo "Error inserting into product_color_details";
        exit;
    }
    else
    {
        header("location:color.php?productId=$pid");
    }
}
}

elseif(isset($_POST['delete']))
{
    $colorid = $_POST['colorId'];
    $productid = $_POST['proId'];

     $dupdate = "UPDATE product_color_details SET IsDelete = 1 WHERE Id = $colorid";
     $statement_delete = mysqli_query($conn,$dupdate);

     if(!$statement_delete)
     {
        echo "Error1";
     }
     else
     {
        header("location:color.php?productId=$productid");
     }
}
?>