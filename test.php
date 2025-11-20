<select id="cat" onchange="goNext(this.value)">
    <option value="">Select Category</option>
    <option value="1">Plants</option>
    <option value="2">Vase</option>
</select>

<script>
function goNext(value) {
    window.location.href = "test2.php?catId=" + value;
}
</script>

<form action="test2.php" method="POST">
    <select name="category">
        <option value="1">Plants</option>
        <option value="2">Vase</option>
    </select>

    <button type="submit">Next</button>
</form>

<?php session_start(); ?>

<form action="test2.php" method="POST">
    <select name="category">
        <option value="1">Plant</option>
        <option value="2">Vase</option>
    </select>

    <button type="submit">Next</button>
</form>

<select onchange="goNext(this.value)">
    <option value="">Select Type</option>
    <?php
    include('database.php');
    $q = mysqli_query($conn, "SELECT * FROM material_type WHERE IsDelete=0");
    while ($t = mysqli_fetch_assoc($q)) {
        echo "<option value='".$t['Id']."'>".$t['Name']."</option>";
    }
    ?>
</select>

<script>
function goNext(typeId) {
    window.location.href = "select_category.php?typeId=" + typeId;
}
</script>










