<?php
session_start();
include("db.php");

$id = $_GET['id'];

/* MOVE TO DELETED TABLE */
mysqli_query($conn,"
INSERT INTO deleted_members
SELECT * FROM members WHERE ID='$id'
");

/* DELETE FROM MAIN TABLE */
mysqli_query($conn,"DELETE FROM members WHERE ID='$id'");

/* DELETE USER LOGIN */
mysqli_query($conn,"DELETE FROM users WHERE email=
(SELECT email FROM deleted_members WHERE ID='$id')");

echo "<script>
alert('Member Moved to Deleted Members');
window.location='view.php';
</script>";
?>