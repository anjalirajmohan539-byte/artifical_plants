<?php
include('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $country = intval($_POST['country']);

    $select = "SELECT `Id`, `Name` FROM `state` 
               WHERE `CountryId` = $country AND `IsDeleted` = 0";

    $statement = mysqli_query($conn, $select);

    if ($statement && mysqli_num_rows($statement) > 0) {

        echo "<option value='0'>Choose states</option>";

        while ($row = mysqli_fetch_assoc($statement)) {
            echo "<option value='{$row['Id']}'>{$row['Name']}</option>";
        }

    } else {
        echo "<option value='0'>No states found</option>";
    }
}
?>