<?php

include('database.php');

if(isset($_POST['btn']))
{
	echo $id =$_POST['product'];
	
    
    $name=$_POST['productName'];
    $price=$_POST['productPrice'];
	$count=$_POST['productcount'];
	$material=$_POST['productMaterial'];
	$materialType = $_POST['materialCategory'];
    $type=$_POST['productType'];
	$colorname=$_POST['colorName'];
	$colorcode=$_POST['colorCode'];
    $description=$_POST['productDesc'];

//    var_dump($image);

if(!empty($_FILES['image']) && $_FILES['image']['name'] != "")
{
$image=$_FILES['image']['name'];
}
else
{
$image = $_POST['himage'];
}

    if ($id != 0) {

        $update = "UPDATE `add_product` SET `ProductImage`='$image',`ProductName`='$name',`Description`='$description',`Price`=$price,
		          `ColorName`='$colorname',`ColorCode`='$colorcode',`CategoryId`=$type,`MaterialId`=$material,`MaterialTypeId`=$materialType,`ProductCount`=$count,
		          `LastUpdated`=CURRENT_TIMESTAMP WHERE Id = $id AND `IsDeleted` = 0";
				  var_dump($update);
        $ustatemnt=mysqli_query($conn,$update);
         if (!$ustatemnt) {
                echo "error2";
            } else {
                header("location:add_product.php");
            }
    } 
    else
	{
		
	$select="SELECT `Id` FROM `add_product` WHERE ProductName='$name' AND CategoryId=$type"; 
	
    var_dump($select);
	if (!$statemnt=mysqli_query($conn,$select))
	{
		echo "error";
	}
	else 
	{
		if(mysqli_num_rows($statemnt)>0)
		{
			echo "exist";
		}
		else
		{
			
			$insert_product="INSERT INTO `add_product`( `ProductImage`, `ProductName`, `Description`, `Price`, `CategoryId`, `MaterialId`,`MaterialTypeId`,`ProductCount`, `ColorName`, `ColorCode`)  
            VALUES ('$image','$name','$description',$price,$type,$material,$materialType,$count,'$colorname', '$colorcode')";
			var_dump($insert_product);

            $statement=mysqli_query($conn,$insert_product);
	
			if(!$statement)
			{
				echo "error2";
			}


			  $product_id = mysqli_insert_id($conn);


             $insert_color = "INSERT INTO `product_color_details` (`ProductId`, `ColorCode`, `ColorName`)
			 VALUES ($product_id, '$colorname', '$colorcode')";

            $color_statement = mysqli_query($conn, $insert_color);

           if(!$color_statement){
                echo "Color insert error";
                exit;
           }

			else
			{
				$image_path="images/product/";
				$product_image=$image_path.basename($image);
				if(move_uploaded_file($_FILES['image']['tmp_name'],$product_image))
				{
					header('location:add_product.php');
				}
				else
				{
					echo "something is else";
				}
			}
		}
	}
	}
	}

	elseif (isset($_POST['delete'])) 
{
    $id = $_POST['productid'];

    
    $dupdate = "UPDATE add_product SET IsDeleted = 1 WHERE Id = $id";
    // var_dump($dupdate);

    $dstatement = mysqli_query($conn, $dupdate);

    if (!$dstatement) 
        {
        echo "Error updating";
    } 
    else 
    {
        header("Location: location:add_product.php");
        exit();
    }
}

?>