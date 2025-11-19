<?php

include('database.php');

if(isset($_POST['btn']))
{
    $image=$_FILES['image']['name'];
    $name=$_POST['productName'];
    $price=$_POST['productPrice'];
	$material=$_POST['productMaterial'];
    $type=$_POST['productType'];
	$colorname=$_POST['colorName'];
	$colorcode=$_POST['colorCode'];
    $description=$_POST['productDesc'];

   var_dump($image);

			
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
			
			$insert_product="INSERT INTO `add_product`( `ProductImage`, `ProductName`, `Description`, `Price`, `CategoryId`, `MaterialId`)  
            VALUES ('$image','$name','$description',$price,$type,$material)";
			var_dump($insert_product);

            $statement=mysqli_query($conn,$insert_product);
	
			if(!$statement)
			{
				echo "error";
			}

			else
			{
				$image_path="images/product";
				$product_image=$image_path.basename($image);
				if(move_uploaded_file($_FILES['image']['tmp_name'],$product_image))
				{
					echo "file uplode";
				}
				else
				{
					echo "something is else";
				}
			}
		}
	}
	}

?>