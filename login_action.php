<?php
session_start();
include("database.php");

if(isset($_POST["button"]))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $select = "SELECT `Id`, `UserEmail`, `UserType`, `Lpassword` 
               FROM `login` 
               WHERE UserEmail='$email'";

    $result = mysqli_query($conn, $select);

    if(!$result)
    {
        echo "Query Error";
    }
    else
    {
        if(mysqli_num_rows($result) < 1)
        {
            $_SESSION['error'] = "Incorrect email or password";
            header('location:login_action.php');
        }
        else
        {
            $row = mysqli_fetch_assoc($result);

            if($row['Lpassword'] != $password)
            {
                $_SESSION['error'] = "Incorrect email or password";
                header('location:login_action.php');
            }

            $_SESSION['Id'] = $row['Id'];
            $_SESSION['UserType'] = $row['UserType'];

            $usertype = $row['UserType'];

            if($usertype == 1)
            {
                header('location:admin_page.php');
            }
            else if($usertype == 2)
            {
                header('location:customer_front_page.php');
            }
        }
    }
}
?>