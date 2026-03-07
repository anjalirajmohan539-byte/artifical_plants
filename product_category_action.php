<?php
include('database.php');

if(isset($_POST['btn']))
    {
        echo $categoryId = $_POST['mid'];
        $category = $_POST['Catgeory'];
        $description = $_POST['Description'];

        if ($categoryId != 0) {
        $update = $conn->prepare("UPDATE `product_category` SET `Categorys`= ?,`Description` = ? WHERE Id=?");
        $update->bind_param("ssi",$category,$description,$categoryId);
         if (!$update->execute()) {
                echo "error2";
            } else {
                header('location:product_category.php');
            }
    }
    else
        {

        $stmt = $conn->prepare("INSERT INTO `product_category`(`Categorys`, `Description`) VALUES (?,?)");


            $stmt->bind_param("ss", $category,$description);
            if($stmt->execute())
            {
                header("location:product_category.php");
            }
            else
            {
                echo "Error";
            }
    }
      }
?>