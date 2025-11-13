<?php

include('database.php');

if(isset($_POST['btn']))
{
    $name=$_POST['productType'];


    $select="SELECT `Id`  FROM `material_type` WHERE Name='$name'";
    var_dump($select);

    if (!$statemnt=mysqli_query($conn,$select))
	{
		echo "error1";
	}
	else 
	{
            $insert="INSERT INTO `material_type`(`Name`) VALUES ('$name')";

            $statement=mysqli_query($conn,$insert);
	
			if(!$statement)
			{
				echo "error2";
			}
            else
            {
                header('location:product_material.php');
            }
        
    }
}
?>