<?php

include('database.php');

$id=$_GET['userId'];


?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/users_details.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    
  <div class="header">
    <h2>USER PROFILE</h2>
  </div>

  <div class="profile-container">
    <?php
    
    $select="SELECT cd.`id`,`UserImage`, `FullName`, l.Lpassword AS Password,`PhoneNo`, `WhatsappNo`, `Email`, `DOB`,
             CASE WHEN Gender=0 THEN 'Male'
                  WHEN Gender=1 THEN 'Female'
                  END AS Gender,
            `Address`, `City`, st.Name AS State, `PinCode`, ct.Name AS Country, cd.Status AS StatusId,
             CASE WHEN Status=1 THEN 'Active'
                  WHEN Status=2 THEN 'Inactive'
                  WHEN Status=3 THEN 'Banned'
                  END AS Status, DATE_FORMAT(cd.`CreateDate`,  '%d-%m-%Y') AS CreateDate
             FROM `customer_details` cd
            INNER JOIN state st ON st.Id = cd.State 
            INNER JOIN country ct ON ct.Id = cd.Country
            INNER JOIN login l ON l.Id = cd.CustomerId WHERE CustomerId=$id";
    $statenmt=mysqli_query($conn,$select);

    if(mysqli_num_rows($statenmt)>0)
    {
        $details=mysqli_fetch_assoc($statenmt);
      
    
    ?>
    <div class="sidebar">
      <div class="profile-card">
        <img src="images/img/<?php echo $details['UserImage'];?>" alt="">
        <h3><?php echo $details['FullName'];?></h3>
        <p class="gender"><?php echo $details['Gender'];?></p>
        <p class="num"><?php echo $details['PhoneNo'];?></p>
        <div class="status">
          <span>Status</span>
          <?php
          ?>
          <span class="<?php if($details['StatusId']==1){echo "active";}elseif($details['StatusId']==2){echo "inactive";}else{echo "banned";}?>"><?php echo $details['Status'];?></span>
        </div>
        <p class="member-since">Member since :<strong><?php echo $details['CreateDate'];?></strong></p>
      </div>


    </div>

    <div class="main-content">
      <section class="about">
        <h3>About</h3>
        <div class="info-grid">
          <div><strong>Full Name</strong><p><?php echo $details['FullName'];?></p></div>
          <div><strong>Gender</strong><p><?php echo $details['Gender'];?></p></div>
          <div><strong>Phone No</strong><p><?php echo $details['PhoneNo'];?></p></div>
          <div><strong>Whatsapp No.</strong><p><?php echo $details['WhatsappNo'];?></p></div>
          <div><strong>Email</strong><p><?php echo $details['Email'];?></p></div>
          <div><strong>Password</strong><p><?php echo $details['Password'];?></p></div>
          <div><strong>Birthday</strong><p><?php echo $details['DOB'];?></p></div>
          <div><strong>Address</strong><p><?php echo $details['Address'];?></p></div>
          <div><strong>Pincode</strong><p><?php echo $details['PinCode'];?></p></div>
          <div><strong>City</strong><p><?php echo $details['City'];?></p></div>
          <div><strong>State</strong><p><?php echo $details['State'];?></p></div>
          <div><strong>Country</strong><p><?php echo $details['Country'];?></p></div>
        </div>
      </section>

      <?php
      }
      ?>

      <div class="grid-section">
        <section class="experience">
          <h3>Customer Ordered Products</h3>
          <ul>
            <li><span></span></li>
            <li><span></span></li>
            <li><span></span></li>
            <li><span></span></li>
          </ul>
        </section>

        <section class="education">
          <h3>Wishlist</h3>
          <ul>
            <li><span></span></li>
            <li><span></span></li>
          </ul>
        </section>
      </div>
    </div>
  </div>
</body>
</html>