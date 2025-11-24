$colorid = "";
$cname = "";
$ccode = "";
$button = "Save";

if(isset($_POST['edit']))
{
    $colorid = $_POST['colorId'];
    $cname = $_POST['color'];
    $ccode = $_POST['colorCode'];
    $button = "Update";
}







            <input type="hidden" name="coid" value="<?php echo $colorid?>">



                                <td>
                        <form action="#" method="post">
                            <input type="hidden" name="colorId" value="<?php echo $colors['Id'];?>">
                            <input type="hidden" name="color" value="<?php echo $colors['ColorName'];?>">
                            <input type="hidden" name="colorCode" value="<?php echo $colors['ColorCode'];?>">
                            <input type="hidden" name="colorStatus" value="<?php echo $colors['Status'];?>">
                            <input type="submit" name="edit" value="Edit" class="btn-sm" style="background-color: #3333f3 !important;">
                        <!-- <a href="category_edit.php"><button class="btn-sm" type="button" style="background-color: #3333f3 !important;">Edit</button></a> -->
                        </form>
                    </td>
                    <td>
                        <form action="#" method="post">
                            <input type="hidden" name="colorId" value="<?php echo $colors['Id'];?>">
                            <input type="hidden" name="proId" value="<?php echo $proId;?>">
                            <input type="submit" name="delete" class="btn-sm btn-delete" value="Delete">
                        </form>
                        <!-- <button type="button" name="delete" class="btn-sm btn-delete">Delete</button> -->
                    </td>











