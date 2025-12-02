<?php
include "database.php";

$edit = false;
$prow = [];

// If Edit button clicked
if (isset($_GET['edit_id'])) {
    $edit = true;
    $id = $_GET['edit_id'];

    $q = mysqli_query($conn, "SELECT * FROM products WHERE Id='$id'");
    $prow = mysqli_fetch_assoc($q);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add / Edit Product</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .container {
            width: 60%;
            margin: auto;
            margin-top: 25px;
            padding: 20px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 0 10px #ccc;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #aaa;
            border-radius: 6px;
            font-size: 16px;
        }
        .preview-box {
            width: 150px;
            height: 150px;
            background: #eee;
            border-radius: 6px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
            overflow: hidden;
        }
        button {
            background: #1a73e8;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 17px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><?php echo $edit ? "Edit Product" : "Add Product"; ?></h2>

    <form method="POST" action="product_action.php" enctype="multipart/form-data">

        <!-- If editing, send the ID -->
        <?php if ($edit) { ?>
            <input type="hidden" name="edit_id" value="<?php echo $prow['Id']; ?>">
        <?php } ?>

        <!-- MATERIAL -->
        <label>Material</label>
        <select id="materialSelect" name="material" onchange="loadCategory()">
            <option value="">Choose Material</option>

            <?php
            $m = mysqli_query($conn, "SELECT * FROM material_type WHERE IsDeleted=0");
            while ($row = mysqli_fetch_assoc($m)) {

                $sel = ($edit && $prow['MaterialId'] == $row['Id']) ? "selected" : "";

                echo "<option value='{$row['Id']}' $sel>{$row['Name']}</option>";
            }
            ?>
        </select>

        <!-- CATEGORY -->
        <label>Category</label>
        <select id="categorySelect" name="category">
            <option value="">Choose Category</option>
        </select>

        <!-- PRICE -->
        <label>Price</label>
        <input type="number" name="price"
               value="<?php echo $edit ? $prow['Price'] : ""; ?>" required>

        <!-- DESCRIPTION -->
        <label>Description</label>
        <textarea name="description" rows="4"><?php
            echo $edit ? $prow['Description'] : "";
        ?></textarea>

        <!-- IMAGE -->
        <label>Product Image</label>
        <div class="preview-box" id="imgPreview">

            <?php if ($edit && $prow['ProductImage'] != "") { ?>
                <img src="images/<?php echo $prow['ProductImage']; ?>"
                     style="width:100%;height:100%;object-fit:cover;">
            <?php } else { ?>
                No Image
            <?php } ?>

        </div>

        <input type="file" name="productImage" id="productImage">
        <input type="hidden" name="oldImage" value="<?php echo $edit ? $prow['ProductImage'] : ""; ?>">

        <button type="submit">
            <?php echo $edit ? "Update Product" : "Add Product"; ?>
        </button>
    </form>
</div>

<script>
    // Image Preview
    $("#productImage").change(function () {
        let file = this.files[0];
        let box = $("#imgPreview");

        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                box.html(`<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`);
            };
            reader.readAsDataURL(file);
        }
    });

    // Load Category via AJAX
    function loadCategory(selectedCategory = null) {

        let materialId = $("#materialSelect").val();

        $.ajax({
            url: "fetch_category.php",
            type: "POST",
            data: { material_id: materialId },
            success: function (response) {
                $("#categorySelect").html(response);

                if (selectedCategory) {
                    $("#categorySelect").val(selectedCategory);
                }
            }
        });
    }

    // Auto-load category in EDIT mode
    <?php if ($edit) { ?>
        $(document).ready(function () {
            loadCategory(<?php echo $prow['CategoryId']; ?>);
        });
    <?php } ?>
</script>

</body>
</html>










