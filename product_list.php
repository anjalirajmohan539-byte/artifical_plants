<?php

include('database.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/product_list.css" rel="stylesheet">
</head>
<body>

<?php

include('sidebar.php');

?>
<div class="container">
<h1>PRODUCT LIST</h1>
<div class="list">
    <table>
        <thead>
            <tr>
                <th>sl.no</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Category</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $select = "SELECT ap.`Id`, ap.`ProductName`, ap.`Price`,pc.`Categorys` AS `CategoryId` FROM `add_product` ap
                       INNER JOIN product_category pc ON pc.Id = ap.CategoryId
                       WHERE ap.`IsDeleted` = 0";
            $check = mysqli_query($conn,$select);
            $sl=1;
            if(mysqli_num_rows($check)>0)
                {
                    while($products = mysqli_fetch_assoc($check))
                        {

            ?>
            <tr>
                <td><?php echo $sl++;?></td>
                <td><?php echo $products['ProductName'];?></td>
                <td><?php echo $products['Price'];?></td>
                <td><?php echo $products['CategoryId'];?></td>
                <td><a href="product_details.php?productId=<?php echo $products['Id'];?>"><button>View Details</button></a></td>
            </tr>
            <?php
                     }
                }
            ?>
        </tbody>
    </table>
</div>
</div>
</body>
</html>