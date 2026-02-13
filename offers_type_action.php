<?php
include('database.php'); 

if(isset($_POST['btn']))
{
    $offerType = $_POST['OffersTypes'];

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
?>
