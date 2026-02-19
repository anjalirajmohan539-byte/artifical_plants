<?php
include('database.php');

$id = $_POST['id'];

$query = "SELECT of.`Id`, `OfferName`,ot.Name AS `OfferType`, `OfferCode`, dt.Name AS `DiscountType`, `DiscountValue`, `StartingDate`, `EndingDate`,
 CASE WHEN Status = 0 THEN 'Active'
 WHEN Status = 1 THEN 'InActive'
 WHEN Status = 2 THEN 'Expired'
 WHEN Status = 3 THEN 'Schedule'
 END AS status
 FROM `offers` of
 INNER JOIN offer_type ot ON ot.Id = of.OfferType
 INNER JOIN discount_type dt ON dt.Id = of.DiscountType
 WHERE of.Id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
?>

<h3><?php echo $data['OfferName']; ?></h3>
<p><b>Offer Type:</b> <?php echo $data['OfferType']; ?></p>
<p><b>Offer Code:</b> <?php echo $data['OfferCode']; ?></p>
<p><b>Discount Type:</b> <?php echo $data['DiscountType']; ?></p>
<p><b>Discount Value:</b> <?php echo $data['DiscountValue']; ?></p>
<p><b>Status:</b> <?php echo $data['status']; ?></p>
<p><b>Start Date:</b> <?php echo $data['StartingDate']; ?></p>
<p><b>End Date:</b> <?php echo $data['EndingDate']; ?></p>
