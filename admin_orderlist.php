<?php
include('database.php');
$status = 0;
?>

<script src="js/jquery.min.js"></script>
<link href="css/admin_orderlist.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

<div class="main">
<?php include('sidebar.php'); ?>

<div class="container-fluid content">
<div class="container details">

<h1>Order List</h1>

<nav class="navbar navbar-light">
    <form class="form-inline" onsubmit="return false;">
        <input class="form-control mr-sm-2"
               type="search"
               id="search"
               name="search"
               placeholder="Search"
               onkeyup="loaddata()">
    </form>
</nav>

<div class="container">

    <div id="table-data">
        <!-- AJAX DATA LOAD HERE -->
    </div>
</div>
</div>
</div>

<script>
$(document).ready(function(){
    loaddata();
});

function loaddata()
{
    var search = $('#search').val();

    $.ajax({
        url: "filter_orderlist.php",
        type: "POST",
        data: {search:search},

        success:function(data)
        {
            $('#table-data').html(data);
            // alert(data);
        }
    });
}
</script>

<script>
    function status(orderId,status)
    {
        

        $.ajax({
            url:"filter_orderlist.php",
            type:"POST",
            data:{
            orderId : orderId,
            status : status
        },

        success:function(response)
        {
            alert(response);
        }
        });
    }
</script>

</body>
</html>