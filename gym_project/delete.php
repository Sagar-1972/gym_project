<?php
include "db.php";

$id = $_GET['id'];
$email = $_GET['email'];

// delete member
mysqli_query($conn,"DELETE FROM members WHERE ID='$id'");

// delete login user
mysqli_query($conn,"DELETE FROM users WHERE email='$email'");

// redirect
header("Location:view.php");
?>