<?php
include('database.php');

$product_id = $_GET['productId'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/offer.css">
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <div class="header">
    <p>OFFER DETAILS</p>
    <p style="margin-right: 90%;margin-top: -40px;font-size: 30px;"><a href="add_product.php">⟵</a></p>

</div>
<div class="container">

    <!---------------------------------------------------- LEFT: SIDE ---------------------------------------------------->
<div class="left">
    <!---------------------------------------------------- IMAGE ---------------------------------------------------->

   <div class="card">
      <!------- form ------->  
           <form action="offers_action.php" method="post">

        <fieldset>

<!------- Delivery Type ------->

<?php

$select = "SELECT `Id`, `OfferName` FROM `offers` WHERE `IsDelete` = 0";
$check = mysqli_query($conn,$select);

if(mysqli_num_rows($check)>0)
    {
?>
            <label for="">Offers</label>
            <select name="type" id="offer">
    <option value="0">Choose Offer</option>
    <?php
     while($offer = mysqli_fetch_assoc($check)) 
     {
         ?>
        <option value="<?php echo $offer['Id'];?>">
            <?php echo $offer['OfferName'];?>
        </option>
    <?php } ?>
</select>
            <?php }?>
        </fieldset>
        <input type="hidden" name="proId" value="<?php echo $product_id;?>">

        <div class="card-details" id="details">
            <div class="card-title">Offer Information</div>
            <div class="grid" id="deta">
                <div class="info"><div class="label">Offer Type</div><div class="value"></div></div>
                <div class="info"><div class="label">Offer Code</div><div class="value"></div></div>
                <div class="info"><div class="label">Discount Type</div><div class="value"></div></div>
                <div class="info"><div class="label">Discount Value</div><div class="value"></div></div>
                <div class="info"><div class="label">Status</div><div class="value"></div></div>
                <div class="info"><div class="label">Starting Date</div><div class="value"></div></div>
                <div class="info"><div class="label">Ending Date</div><div class="value"></div></div>
            </div>
        </div>
<button class="btn1" name="btn">Add</button>
      </form>
        </div>

</div>


    <!---------------------------------------------------- RIGHT: SIDE ---------------------------------------------------->
    <div class="right">

    <!---------------------------------------------------- Shipping Details ---------------------------------------------------->

        <div class="card">
          
             <div class="table-card">
            <table>
                <tr>
                    <th>Sl no</th>
                    <th>Products</th>
                    <th>Offers</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            <tr>
                <?php
                $selectDet = "SELECT po.`Id`, ap.ProductName AS`ProductId`,of.OfferName AS `OfferId`, po.`Status` FROM `product_offers` po
                              INNER JOIN add_product ap ON ap.Id = po.ProductId
                              INNER JOIN offers of ON of.Id = po.OfferId
                              WHERE po.`IsDeleted` = 0";

                $checkDet = mysqli_query($conn,$selectDet);

                $sl=1;
                if(mysqli_num_rows($checkDet)>0)
                    {
                        while($data=mysqli_fetch_assoc($checkDet))
                            {
                
                ?>
                    <td><?php echo $sl++;?></td>
                    <td><?php echo $data['ProductId'];?></td>
                    <td><?php echo $data['OfferId'];?></td>
                    <td>
                        <form action="#" method="post">
                        <button type="submit" name="edit" style="border:none;background:transparent;" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16" style="color: blue;">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
</svg></button>
</form>
                    </td>
                    <td>
                            <button type="submit" name="delete" style="border:none;background:transparent;" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: red;">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg></button>
                    </td>
                    <?php
                           }
                    }
                    ?>
                    </tr>
            </table>
        </div>
        </div>

      </div>
</div>
</body>

<script>
$("#offer").change(function(){

    var id = $(this).val();

    if(id == 0){
        $("#details").hide();
        return;
    }

    $("#deta").load("fetch_offer.php?id=" + id);
    $("#details").show();

});
</script>

</html>