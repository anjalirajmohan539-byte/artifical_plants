<?php
session_start();
include('database.php');

$search = $_GET['search'];
$categoryId = $_GET['category'];
$categoryTypeId = $_GET['categoryTypeId'];
if(isset($_SESSION['Id']) != "")
  {
    $Id = $_SESSION['Id'];
  }


// $query = "SELECT ap.Id, ap.ProductImage,ap.ProductName ,DeliveryDays, ap.Price, off.DiscountType, off.DiscountValue FROM add_product ap
//               left JOIN shipping_details sd ON sd.ProductId = ap.Id
//               LEFT JOIN product_offers pf ON pf.ProductId = ap.Id
//               LEFT JOIN offers off ON off.Id = pf.Id
//               WHERE ap.IsDeleted = 0 AND CategoryId = $categoryId";
//               if($categoryTypeId !=0)
//                 {
//                   $query .= " AND CategoryTypeId =".$categoryTypeId;
//                 }


$query = "SELECT ap.Id, ap.ProductImage,ap.ProductName ,DeliveryDays, ap.Price, ca.ProductId, off.DiscountType, off.DiscountValue FROM add_product ap
              left JOIN shipping_details sd ON sd.ProductId = ap.Id
              LEFT JOIN product_offers pf ON pf.ProductId = ap.Id
              LEFT JOIN offers off ON off.Id = pf.Id
              LEFT JOIN cart ca ON ca.ProductId = ap.Id And ca.customerId = $Id 
              WHERE ap.IsDeleted = 0";
              if($categoryId !=0)
                {
                  $query .= " AND CategoryId =".$categoryId;
                }

                              if($categoryTypeId !=0)
                {
                  $query .= " AND CategoryTypeId =".$categoryTypeId;
                }

                
                              if($search !="")
                {
                  $query .= " AND ap.ProductName LIKE '%$search%' ";
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
     $books_html .= '</a>';
    $books_html .= '<input type="hidden" class="pid" value="'.$row['Id'].'">';
    $books_html .= '<h3>'. $row['ProductName'] .'</h3>';
    $books_html .= '<p>
          <span>₹'.$finalPrice.'</span> ';

       $books_html .='<span style="font-size:12px;text-decoration: line-through;color:red">'. (($discountValue != 0) ? $row['Price'] : "") .'</span>';
         $books_html .='</p>';
         $books_html .= '<p>
          Delivery by  '.$date->format("d M, D").'
        </p>';
         $books_html .='    <button class="wooden-cart-button" name="btn">';
         $books_html .='    <svg viewBox="0 0 24 24">';
         $books_html .='    <path ';
         $books_html .='    d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49A.996.996 0 0 0 21.42 4H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"
    >';
    $books_html .='   </path>';
  $books_html .='    </svg>';
  $books_html .='    <a href=';
  $books_html .=($row['ProductId'] != "") ?  "customer_cart.php" : "vase_action.php?cartId=".($row['Id'])."&categoryId=".$categoryId;
  $books_html .=' style="user-select: none;"><span class="button-text">';
  $books_html .= ($row['ProductId'] != "") ? "Go To Cart" : "Add To Cart";
  $books_html .= '</span>';
  $books_html .= '</a>';
  $books_html .='   </button>';
    
    $books_html .= '</div>';
}

echo json_encode([
    'books_html' => $books_html
]);
?>