<?php
$servername="localhost";
$username="root";
$password="";
$database="milon_artifical_plants";

$conn=new mysqli($servername,$username,$password,$database);
if($conn -> connect_error) 
{
	die("connection error");
}
?>