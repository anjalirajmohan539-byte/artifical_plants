<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $type = intval($_POST['productType']);

    $select = "SELECT Id, Name 
               FROM category_type 
               WHERE CategoryId = $type AND IsDeleted = 0";


    $statement = mysqli_query($conn, $select);

    if ($statement && mysqli_num_rows($statement) > 0) {

        echo "<option value='0'>Choose type Category</option>";

        while ($row = mysqli_fetch_assoc($statement)) {
            echo "<option value='{$row['Id']}'>{$row['Name']}</option>";
        }

    } else {
        echo "<option value='0'>No type categories found</option>";
    }
}

?>