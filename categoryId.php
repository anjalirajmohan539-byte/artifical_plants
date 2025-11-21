<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $material = $_POST['productMaterial'];  

    $select = "SELECT `Id`, `Name`, `Type` FROM material_category WHERE Type = '$material' AND IsDelete = 0";

    $statement = mysqli_query($conn, $select);

    if ($statement && mysqli_num_rows($statement) > 0) {

        echo "<option value='0'>Choose Category</option>";

        while ($row = mysqli_fetch_assoc($statement)) {
            echo "<option value='" . $row['Id'] . "'>" . $row['Name'] . "</option>";
        }

    } else {
        echo "<option value=''>No categories found</option>";
    }
}
?>
