<?php
include('database.php');

$search = $_GET['search'];
$categoryId = $_GET['category'];
$categoryTypeId = $_GET['categoryTypeId'];

$query = "SELECT ap.Id, ap.ProductImage,ap.ProductName ,DeliveryDays, ap.Price, off.DiscountType, off.DiscountValue FROM add_product ap
              left JOIN shipping_details sd ON sd.ProductId = ap.Id
              LEFT JOIN product_offers pf ON pf.ProductId = ap.Id
              LEFT JOIN offers off ON off.Id = pf.Id
              WHERE ap.IsDeleted = 0 AND CategoryId = $categoryId";
              if($categoryTypeId !=0)
                {
                  $query .= " AND CategoryTypeId =".$categoryTypeId;
                }

$result = mysqli_query($conn, $query);

$books_html = '';
while ($row = mysqli_fetch_assoc($result)) {

$days = $row['DeliveryDays'] ?? 4;

        $date = new DateTime();
        $date->modify("+$days days");

             $price = $row['Price']; // default price
             $discountType = $row['DiscountType'] ?? null;
             $discountValue = $row['DiscountValue'] ?? 0;
        
              if ($discountType == "Percentage") {
                  $discountAmount = ($price * $discountValue) / 100;
                  } else { 
                    $discountAmount = $discountValue;
                    }
                    $finalPrice = $price - $discountAmount;
                    if ($finalPrice < 0) {
                      $finalPrice = 0;
                      }


    $books_html .= '<div class="col-3 product-card">';
    $books_html .= '<a href="product_details.php?productId='. $row['Id'] .'"><img src="images/product/'. $row['ProductImage'] .'" alt="'. $row['ProductName'] .'">';
    $books_html .= '<input type="hidden" class="pid" value="'.$row['Id'].'">';
    $books_html .= '<h3>'. $row['ProductName'] .'</h3>';
    $books_html .= '<p>
          <span>₹'.$finalPrice.'</span> ';

       $books_html .='   <span style="font-size:12px;text-decoration: line-through;color:red"> '.$discountValue != 0 ? $row['Price'] : "" .'</span>
        </p>';
    $books_html .= '<p>
          Delivery by  '.$date->format("d M, D").'
        </p>';
    $books_html .= '</a>';
    $books_html .= '</div>';
}

echo json_encode([
    'books_html' => $query
]);
?>