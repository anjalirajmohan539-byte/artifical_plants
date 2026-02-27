<?php
include('database.php'); 

if(isset($_POST['btn']))
{
    $offerType = $_POST['OffersTypes'];
    $typeId = $_POST['typeId'];

    if($typeId !=0)
        {
            $update = "UPDATE `offer_type` SET `Name`='$offerType' WHERE `Id` = $typeId";
            $check = mysqli_query($conn,$update);

            if (!$check) 
        {
            echo "error2";
        } 
        else {
                header("location:offers_type.php");
            }
        }
        else
            {

    if(!empty($offerType))
    {
        $stmt = $conn->prepare("INSERT INTO offer_type (Name) VALUES (?)");


            $stmt->bind_param("s", $offerType);
            if($stmt->execute())
            {
                header("location:offers_type.php");
            }
            else
            {
                echo "Error";
            }
    }
    else
    {
        echo "<script>alert('Offer Type is required');</script>";
    }
     }
}
?>
