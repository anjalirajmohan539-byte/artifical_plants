<?php

include("database.php");

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/delivery_details.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>

<div class="col-6">
  <div class="main">
    <img src="images/plant_2.jpg" alt="">
    <label for="">Plant</label>
  </div>
</div>

<div class="col-6">
    <div class="main">
      <form action="#" method="post">

        <fieldset>
            <legend>Shipping Details</legend>
            <?php
            $select = "SELECT `Id`, `Name` FROM `product_availability` WHERE `IsDeleted` = 0";
            $statemnt = mysqli_query($conn, $select);

            if(mysqli_num_rows($statemnt) > 0)
            {
            
            ?>
            <label for="">Availability</label>
            <select name="available" id="available">
              <?php
              while($row = mysqli_fetch_assoc($statemnt))
              {

              ?>
                <option value="<?php echo $row['Id'];?>"><?php echo $row['Name'];?></option>
                <?php }?>
            </select>
            <?php }?>

            <?php
            $date = "2024-12-11";
            ?>
            <label for="">Delivery Days</label>
            <input type="text" class="dday" name="dday" value="<?php echo date("d M, l", strtotime($date));?>">

            <label for="">Delivery Charge</label>
            <select name="charge" id="charge">
              <option value="">Free Delivery</option>
              <option value="">With Delivery fee</option>
            </select>
        </fieldset>
        <button class="btn1">Update</button>
        
      </form>
      </div>

<div class="main">
            <form action="#" method="post">

        <fieldset>
            <legend>Delivery Details</legend>
            
            <label for="">Return</label>
            <input type="text" name="return" id="return">

            <label for="">Cash on Delivery</label>
            <input type="text" name="amount" id="amount">

            <label for="">Customer Support</label>
        </fieldset>
        <button class="btn1">Update</button>
        
      </form>
    </div>
    </div>
</body>
</html>