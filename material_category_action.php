<?php
include('database.php');

if(isset($_POST['btn']))
{
    $tid = $_POST['typeid']; 
    $cid = $_POST['categoryid'];            
    $name = $_POST['productType'];   


    if ($cid != 0) {

        $update = "UPDATE `material_category` SET `Name`='$name',`LastDate`=CURRENT_TIMESTAMP WHERE Id=$cid";
        $ustatemnt=mysqli_query($conn,$update);
         if (!$ustatemnt) {
                echo "error2";
            } else {
                header("Location: material_category.php?matId=$tid");
            }
    } 
    else 
        {
    
   
     if(empty($name) || empty($tid)){
        echo "Missing fields!";
        exit;
    }
       
    $check = "SELECT * FROM material_category WHERE Name = '$name' AND Type = '$tid'";
    $checkResult = mysqli_query($conn, $check);
    // var_dump($check);

    if(mysqli_num_rows($checkResult) > 0){
        echo "Category already exists!";
        exit;
    }

    
    $insert = "INSERT INTO material_category (Name, Type) VALUES ('$name', $tid)";
    $result = mysqli_query($conn, $insert);

    if($result){
        header("Location: material_category.php?matId=$tid");
        exit;
    } else {
        echo "Insert Error!";
    }
}
}

elseif (isset($_POST['delete'])) 
{
    $typeid = $_POST['tid'];
    $id = $_POST['cid'];

    
    $dupdate = "UPDATE material_category SET IsDelete = 1 WHERE Id = $id";
    // var_dump($dupdate);

    $dstatement = mysqli_query($conn, $dupdate);

    if (!$dstatement) 
        {
        echo "Error updating";
    } 
    else 
    {
        header("Location: material_category.php?matId=$typeid");
        exit();
    }
}
?>