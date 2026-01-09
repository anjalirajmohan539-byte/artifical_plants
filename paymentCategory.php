<?php

include('database.php');

$categoryId = 0;
$category = "";
$button = "Save";

if(isset($_POST['edit']))
{
    $categoryId = $_POST['categoryId'];
    $category = $_POST['categoryName'];
    $button = "Update";
}

?>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Artifical_plant_registration</title>
<link href="css/paymentCategory.css" rel="stylesheet">
<link href="bootstrap/bootstrap.min(css).css" rel="stylesheet"  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
        <!-- SIDEBAR -->
<div class="sidebar">
    <h2>Dashboard</h2>

    <a href="admin_page.php"><img src="images/dashboard_icon.jpg" alt=""><y>Home</y></a>
    <a href="add_product.php"><img src="images/add-product.png" alt=""><y>Add Products</y></a>
    <a href="product_material.php"><img src="images/product_list.jpg" alt=""><y>Product Materials</y></a>
    <a href="#"><img src="images/product_list.jpg" alt=""><y>Product List</y></a>
    <a href="#"><img src="images/product_icon.jpg" alt=""><y>Orders</y></a>
    <a href="users_list.php"><img src="images/users_icon.jpg" alt=""><y>Customers</y></a>
    <a href="#"><img src="images/report_icon.jpg" alt=""><y>Report</y></a>
    <a href="index.php"><img src="images/logout_icon.jpg" alt=""><y>Logout</y></a>
</div>

<!-- MAIN CONTENT -->
<div class="wrapper">
    <div class="title">Payment Details</div>

    <div class="grid-container">

        <!-- Left Card (Form) -->
        <div class="card">
            <h3 style="margin-bottom: 15px;">Add New Payment Category</h3>
            <form action="paymentCategory_action.php" method="post" id="productForm" autocomplete="off">
            <label>Payment Category <s>*</s></label>
            <input type="text" id="Payment" name="Payment" placeholder="Enter Payment Category" value="<?php echo $category;?>" oninput="clearError()">
            <div class="error" id="PaymentErr"></div>
            <input type="hidden" name="catid" value="<?php echo $categoryId;?>">

            <button class="btn btn-save" name="btn" id="btn" onclick="return validateForm()"><?php echo $button;?></button>
            <button class="btn btn-reset" type="button" style="background-color: #626d76 !important;" onclick="resetForm()">Reset</button>
        </div>

        </form>
        <!-- Right Table (Material List) -->
        <div class="table-card">
            <table>
                <tbody style="text-align: center;">
                <tr>
                    <th>Sl no</th>
                    <th>Payment Category</th>
                    <th>Payment Method</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                                   <?php
                   $select = "SELECT `Id`, `Name` FROM `payment_category` WHERE `IsDeleted` = 0";
                   $check = mysqli_query($conn,$select);

                   $sl = 1;
                   if(mysqli_num_rows($check)>0)
                   {
                    while($rows=mysqli_fetch_assoc($check))
                    {

                   ?>
                <tr>
                    <td><?php echo $sl++;?></td>
                    <td><?php echo $rows['Name'];?></td>
                    <td><a href="paymentMethod.php?methodId=<?php echo $rows['Id'];?>" title="Payment Method"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 64 64" id="wallet">
  <path fill="#4d4d4d" d="M50.33875,17.25574l-1.861.57049-10.82007-8.88v-3.82C38.49646-.65509,15.229,3.15686,12.65784,2.12494,7.0647,1.68109,10.5957,17.452,9.65771,20.12622a5.61929,5.61929,0,0,0-6,5C4.88416,27.5437.542,63.54657,6.656,62.12646l40.0017-.00024c5.36365.3349,2.19043-12.6969,3-15.37,2.36915-1.34943,12.51221-1.77826,10.87-6.46C58.72583,37.97314,55.67188,14.898,50.33875,17.25574Zm-4.161,1.28045-10.35009,3.17c-5.04993-4.17-13.67993-2.29-14.82984,4.54-1.54394.56219-4.67834.90582-5.13012,2.88H14.69775C35.76746,6.67859,26.27551,1.62585,46.17773,18.53619Zm-19.41357,5.684c.7395-.82428,1.85742-1.593,2.09827-2.71258a7.89139,7.89139,0,0,1,1.64123.03113c-.43384.55542-1.41723,1.742-1.80359,2.34607l-2.30676.70715C26.51538,24.46619,26.64087,24.34375,26.76416,24.22015Zm-1.9585.16755c-.25341.2962-.45678.61041-.713.90954l-.84485.259a5.97638,5.97638,0,0,1,3.88123-3.689C26.30273,22.653,25.58105,23.55017,24.80566,24.3877Zm5.82251-1.50586c.32325-.36646.65137-.73194.93653-1.12879a7.42053,7.42053,0,0,1,1.76294.71314l-3.19812.9804Q30.37891,23.16425,30.62817,22.88184ZM16.55164,18.92627c.00378,1.12707.0802,2.24383.18127,3.366a.44276.44276,0,0,0,.7085.33929l-1.37378,1.67468A6.16722,6.16722,0,0,1,16.55164,18.92627ZM17.75952,17.416a7.8335,7.8335,0,0,1,1.34351-1.0362,11.56373,11.56373,0,0,0,.0664,4.145L17.577,22.46606A25.4593,25.4593,0,0,0,17.75952,17.416Zm3.76514-.12885a.4525.4525,0,0,0,.126.21277l-1.447,1.764c.00769-1.18836.31238-2.35578.23194-3.5398a8.74542,8.74542,0,0,1,1.29345-.38354A2.65983,2.65983,0,0,0,21.52466,17.28717Zm.97143-2.0788a9.09008,9.09008,0,0,1,1.10157-.08215l-.99121,1.20831A1.60153,1.60153,0,0,0,22.49609,15.20837ZM12.65771,4.12628l22-.00006c1.47962-.03967.88819,2.32806,1,3.18-3.96142-5.054-8.12158,3.67285-10.50048,5.93036-7.44947-1.21039-14.14954,6.14966-10.48951,12.77967-.25976.18383-2.5559,3.53137-3.01,3.11,0,0,.01758-21.994,0-22C11.77563,6.27863,11.20361,4.09442,12.65771,4.12628Zm-3.5,17.99994h.5v.71533a10.747,10.747,0,0,0-3.92651,2.223A3.37653,3.37653,0,0,1,9.15771,22.12622ZM6.17847,27.412a3.6471,3.6471,0,0,1-.42188-1.17572c.0044-.00586.00989-.00867.062-.00367a29.537,29.537,0,0,1,3.83911-2.3023v1.50293A10.53181,10.53181,0,0,0,6.17847,27.412Zm3.47924-.58338v2.29761a3.66457,3.66457,0,0,1-2.828-.87939C7.745,27.72039,8.70917,27.28611,9.65771,26.82861Zm38,32.29761c.1803,2.24091-34.97045.45776-36,1-.43481-.684,1.0813-16.72943-.99938-16.00018-2.07374-.78583-.57056,15.38989-1.00062,16.00018-.88842-.2074-4.05908.65247-3.99987-.99994-.00013-.00006-.00013-27.23083-.00013-29.14563.62354,2.19159,39.69324.77411,40.99939,1.14588C48.83057,30.01154,47.16309,58.70715,47.65771,59.12622Zm-13.92993-30a5.98419,5.98419,0,0,1,3.23108-1.35315c-.48653.422-.93213.88546-1.37378,1.35315Zm4.17041,0a13.29251,13.29251,0,0,0,1.34388-1.19495,6.78646,6.78646,0,0,1,.933.30152,2.68606,2.68606,0,0,0-1.34827.89343Zm2.68738,0c.11646-.17963.31629-.3327.31922-.5611a6.92415,6.92415,0,0,1,.87292.5611Zm17.96216,12.51c.132.55988-8.55481,2.80853-8.89,3.03-.85351-3.93848,3.02833-17.42627-4.9895-15.53955-3.59057-4.45044-10.41052-4.59046-13.69043-.00043h-12.55c4.06421-1.23474,29.08716-8.92975,32.49-9.95a.9856.9856,0,0,1,1.25.66C52.12744,20.69623,59.15344,40.76013,58.54773,41.63623Z"/>
  <path fill="#4d4d4d" d="M40.9458 41.96741c-6.29468.92291-4.26123 10.122 1.728 8.61493 3.45837-1.27619 4.20849-4.86206 2.062-7.70673C43.82715 42.08 42.02075 40.93921 40.9458 41.96741zm3.172 5.06756c-3.43238 4.75721-8.25537-1.89319-3.10242-3.89825.74609.59857 1.8855.40381 2.6084 1.096C44.16113 44.991 44.80981 46.18524 44.1178 47.035zM10.40576 39.8125a1.03187 1.03187 0 000 2.0625A1.03187 1.03187 0 0010.40576 39.8125zM44.90112 52.76642c-.9644 1.36371-1.82227 3.21236-3.50618 3.7356a1.16212 1.16212 0 00-1.04875.5761 1.10766 1.10766 0 001.26734 1.5799 6.5223 6.5223 0 003.89086-3.9 4.83512 4.83512 0 00.292-1.74909A.48415.48415 0 0044.90112 52.76642z"/>
  <path fill="#4d4d4d" d="M41.73608 56.40192c-.03845.00073-.0747.02154-.06884.02588A.37069.37069 0 0041.73608 56.40192zM37.50439 58.09259a.95151.95151 0 001.15015-1.49091A.95151.95151 0 1037.50439 58.09259zM13.49512 10.92242a.58135.58135 0 00-.41968.64295c.15515.81128 1.61951.52917 2.24658.58411.72119.01776 1.53882-.66181.78235-1.2486A4.39755 4.39755 0 0013.49512 10.92242z"/>
  <path fill="#4d4d4d" d="M13.14478 6.538a8.29528 8.29528 0 001.37231.81958c-.635-.24951-1.51807.23175-.85107.84955.44311.33362 1.09436.25141 1.46923.70368.18689.18127.2771.47644.02832.6455-.48962.39924-1.38989.0954-1.4552-.43182a.88331.88331 0 01.08655-.45947c.11719-.18939-.10913-.37891-.28857-.28858a.99841.99841 0 00-.3147 1.392A1.6363 1.6363 0 0015.969 9.63245 1.62734 1.62734 0 0014.79321 7.4444c2.04322.43652 2.17847-2.53607.1045-2.583-.54957-.15277-2.51.74048-1.72706 1.36536A.17517.17517 0 0013.14478 6.538zm.82592-.31219c.47425-.15827 1.13086-.35028 1.439.17981.04614.06586-.015.1477-.06592.19226-.36768.23785-1.009-.22467-1.4939-.35577C13.87231 6.23694 13.96167 6.22772 13.9707 6.22577zM28.31335 14.766c.21766.72821.9784 1.08783 1.51941 1.55609.69043.4267 1.67688.21961 1.10059-.73749C30.68335 15.12177 28.27954 13.50909 28.31335 14.766zM32.52954 11.121l-.1571-.06628a1.43064 1.43064 0 01.86462.71661c-.01416-.02576.09033.17261.00232.261-.64368.323-.87439-.70844-1.12476-1.11188a.376.376 0 00-.42346-.17242c-.53467.22351-.21948 1.12616-.01574 1.50915-.40223-.4093-1.83069-.55579-1.74524.1947-.822.82276.35839 2.116 1.16113 2.44928 1.18225.37574 1.75525-1.10052 1.17651-1.97064a1.39849 1.39849 0 002.19556-.87738A2.00816 2.00816 0 0032.1731 9.8446C31.23145 10.05835 31.94263 10.92413 32.52954 11.121zm-1.03223 2.92688c-.21057.10828-.44519-.10156-.50793-.14313a2.51862 2.51862 0 01-.76209-1.02142c.03492.062-.053-.09131-.00292-.14758.45361.21948 1.0249.35644 1.2622.85351C31.52673 13.69446 31.61975 13.95691 31.49731 14.04785zM44.86475 22.73108a2.35294 2.35294 0 00.18945 1.39715c.227.50306.28271 1.18567.82507 1.45618a.53965.53965 0 00.77466-.31524c.1991-.57972-.24829-1.10657-.43994-1.62989C46.02905 23.19977 45.351 21.961 44.86475 22.73108zM50.07947 21.45331c.23181.1297 1.00232 1.622.04065 1.75543-.75147-.09137-.36377-1.00214-.22315-1.4541a.36493.36493 0 00-.66406-.28c-.09033.17157-.17065.34552-.24268.5213-.2445-.42792-1.02392-.8797-1.33667-.30249-.59851-.35211-.99975.81867-.96936 1.29114-.13049 1.64453 2.30213 3.39868 2.8252 1.1582 1.94385.8664 2.96789-1.69836 1.90857-3.12817C50.8728 19.79193 49.13232 20.09119 50.07947 21.45331zM48.11084 23.833a1.79792 1.79792 0 01-.49243-1.61707c.1969.61981.70068 1.06745.67785 1.73255A1.7614 1.7614 0 0148.11084 23.833z"/>
</svg></a></td>
                    <form action="#" method="post">
                    <td> 
                        <input type="hidden" name="categoryId" id="categoryId" value="<?php echo $rows['Id'];?>">
                        <input type="hidden" name="categoryName" id="categoryName" value="<?php echo $rows['Name'];?>">
                        <!-- <input type="submit" name="edit" class="btn-sm" style="background-color: #3333f3;" value="Edit"> -->
                        <a href="#"><button type="submit" name="edit" style="border: none;" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16" style="color: blue;">
  <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
</svg></button></a>
                    </td>
                    </form>
                    <form action="paymentCategory_action.php" method="post">
                    <td>
                        <input type="hidden" name="cateId" id="cateId" value="<?php echo $rows['Id'];?>">
                        <!-- <input type="submit" name="delete" class="btn-sm btn-delete" value="Delete"> -->
                        <button type="submit" name="delete" style="border: none;" title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16" style="color: red;">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg></button>
                    </td>
                    </form>
                    </tr>
                    <?php }
                   }?>
                
</tbody>
            </table>
        </div>

    </div>
</div>
</body>
<script>
function validateForm() {
    let payment = document.getElementById("Payment");
    let error = document.getElementById("PaymentErr");

    let value = payment.value.trim();

    if (value === "") {
        error.innerHTML = "Payment category is required";
        payment.style.border = "1px solid red";
        payment.classList.add("input-error");
        payment.focus();
        return false;
    }

    if (value.length < 3) {
        error.innerHTML = "Enter at least 3 characters";
        payment.classList.add("input-error");
        payment.focus();
        return false;
    }

    error.innerHTML = "";
    payment.classList.remove("input-error");
    return true;
}


function clearError() {
    document.getElementById("PaymentErr").innerHTML = "";
    document.getElementById("Payment").style.border = "";
    document.getElementById("Payment").classList.remove("input-error");
}


function resetForm() {
    document.getElementById("productForm").reset();
    document.getElementById("PaymentErr").innerHTML = "";
    document.getElementById("Payment").style.border = "";
    document.getElementById("Payment").classList.remove("input-error");
    document.getElementById("Payment").value = "";
    document.getElementById("btn").innerText = "Save";
    clearError();
}

</script>

</html>