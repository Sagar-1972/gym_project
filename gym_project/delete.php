<?php
session_start();
include("db.php");

$id = $_GET['id'];

/* SOFT DELETE */
mysqli_query($conn,"UPDATE members SET status='deleted' WHERE ID='$id'");

/* DELETE USER LOGIN (optional) */
mysqli_query($conn,"DELETE FROM users WHERE email=
(SELECT email FROM members WHERE ID='$id')");

echo "<script>
alert('Member Deleted Successfully');
window.location='view.php';
</script>";
?>