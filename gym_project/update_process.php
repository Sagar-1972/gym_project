<?php
include "db.php";

$id = $_POST['id'];
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$batch = $_POST['batch'];
$plan = $_POST['plan'];
$fees = $_POST['fees'];

$sql = "UPDATE members SET
NAME='$name',
Age='$age',
Gender='$gender',
`CONTACT NO`='$phone',
BATCH='$batch',
PLAN='$plan',
FEES='$fees'
WHERE ID=$id";

if(mysqli_query($conn,$sql))
{
    echo "Member Updated Successfully <br>";
    echo "<a href='view.php'>View Members</a>";
}
else
{
    echo mysqli_error($conn);
}
?>