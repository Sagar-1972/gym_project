<?php
include("db.php");

$id = $_GET['id'];

/* OPTIONAL: Get member name for message */
$q = mysqli_query($conn, "SELECT NAME FROM members WHERE ID='$id'");
$row = mysqli_fetch_assoc($q);
$name = $row['NAME'];

/* Restore member */
mysqli_query($conn,"UPDATE members SET status='active' WHERE ID='$id'");

/* Popup + redirect */
echo "<script>
alert('$name restored successfully');
window.location='deleted_members.php';
</script>";
?>