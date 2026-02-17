<?php
include('database.php');

$id = $_GET['id'];
$q = mysqli_query($conn,"SELECT of.`Id`, `OfferName`,ot.Name AS `OfferType`, `OfferCode`, dt.Name AS `DiscountType`, `DiscountValue`, `StartingDate`, `EndingDate`,
CASE WHEN Status = 0 THEN 'Active'
WHEN Status = 1 THEN 'InActive'
WHEN Status = 2 THEN 'Expired'
WHEN Status = 3 THEN 'Schedule'
END AS status
FROM `offers` of
INNER JOIN offer_type ot ON ot.Id = of.OfferType
INNER JOIN discount_type dt ON dt.Id = of.DiscountType
WHERE of.Id = $id");
$data = mysqli_fetch_assoc($q);
?>

<div class="info"><div class="label">Offer Type</div><div class="value"><?= $data['OfferType']; ?></div></div>
<div class="info"><div class="label">Offer Code</div><div class="value"><?= $data['OfferCode']; ?></div></div>
<div class="info"><div class="label">Discount Type</div><div class="value"><?= $data['DiscountType']; ?></div></div>
<div class="info"><div class="label">Discount Value</div><div class="value"><?= $data['DiscountValue']; ?></div></div>
<div class="info"><div class="label">Status</div><div class="value"><?= $data['status']; ?></div></div>
<div class="info"><div class="label">Starting Date</div><div class="value"><?= $data['StartingDate']; ?></div></div>
<div class="info"><div class="label">Ending Date</div><div class="value"><?= $data['EndingDate']; ?></div></div>

