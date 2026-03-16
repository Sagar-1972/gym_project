<?php
include "db.php";

$name   = $_POST['name'];
$age    = $_POST['age'];
$gender = $_POST['gender'];
$phone  = $_POST['phone'];
$batch  = $_POST['batch'];
$plan   = $_POST['plan'];
$fees   = $_POST['fees'];

$sql = "INSERT INTO members
(NAME,Age,Gender,`CONTACT NO`,BATCH,PLAN,FEES,Join_date)
VALUES
('$name','$age','$gender','$phone','$batch','$plan','$fees',NOW())";

if(mysqli_query($conn,$sql))
{
    echo "Member Added Successfully <br>";
    echo "<a href='view.php'>View Members</a>";
}
else
{
    echo mysqli_error($conn);
}
?>