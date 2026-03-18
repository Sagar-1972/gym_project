<?php
session_start();
include("db.php");

$email = $_SESSION['user'];

$q = "SELECT * FROM members WHERE email='$email'";
$result = mysqli_query($conn,$q);
$row = mysqli_fetch_assoc($result);

$plan_months = $_POST['plan_months'];
$join = new DateTime($row['Join_date']);

$plan = $row['PLAN'];

if($plan == "MONTHLY"){
    $months = 1;
}
else if($plan == "QUARTERLY"){
    $months = 3;
}
else if($plan == "HALF YEAR"){
    $months = 6;
}
else if($plan == "ANNUALLY"){
    $months = 12;
}
else{
    $months = 0;
}

$expiry_date = clone $join;
$expiry_date->modify("+".$months." months");

$expiry = $expiry_date->format('Y-m-d');

$today = new DateTime();

if($today > $expiry_date)
{
    $status = "Expired";
    $remaining = 0;
}
else{
    $status = "Active";
    $remaining = $today->diff($expiry_date)->days;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<style>
body{
margin:0;
font-family:'Poppins',sans-serif;
background:url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48') no-repeat center center/cover;
}
/* DARK OVERLAY */
.overlay{
min-height:100vh;
background:linear-gradient(120deg,rgba(0,0,0,0.95),rgba(0,0,0,0.85));
padding:40px;
}
/* TOP BAR */
.top{
display:flex;
justify-content:space-between;
align-items:center;
color:white;
margin-bottom:30px;
}
.logout{
background:white;
padding:10px 18px;
border-radius:12px;
text-decoration:none;
color:black;
font-weight:600;
}
.logout:hover{
background:#ff512f;
color:white;
}
/* GLASS TABLE BOX */
.table-box{
background:rgba(255,255,255,0.08);
backdrop-filter:blur(18px);
padding:25px;
border-radius:25px;
box-shadow:0 20px 60px rgba(0,0,0,0.8);
overflow:auto;
}
/* TABLE */
table{
width:100%;
border-collapse:collapse;
color:white;
}
th{
background:linear-gradient(45deg,#ff512f,#dd2476);
padding:14px;
}
td{
padding:12px;
text-align:center;
background:rgba(255,255,255,0.05);
}
tr:hover td{
background:rgba(255,255,255,0.12);
}
h1{
text-align:center;
color:white;
margin-bottom:25px;
}
</style>
</head>
<div style="width:500px;margin:80px auto;padding:30px;
background:#f2f2f2;border-radius:15px;
box-shadow:0px 0px 15px gray;text-align:center;">

<h1 style="color:#333;">🏋️ Gym Member Dashboard</h1>

<h2 style="color:green;">
Welcome <?php echo $row['NAME']; ?>
</h2>

<hr>
<p style="font-size:18px;">
💪 Your Gym Plan :
<br>
<b><?php echo $row['PLAN']; ?></b>
</p>
<p style="font-size:18px;">
📅 Your Membership Started On :
<br>
<b><?php echo $row['Join_date']; ?></b>
</p>
<p>📆 Expiry Date :<br>
<b><?php echo $expiry;?></b></p>

<p><b>⏳ Remaining Days :</b><br>
<?php echo ($status=="Expired") ? "0" : $remaining; ?> Days</p>

<p><b>Status :</b><br>

<span style="
color:<?php echo ($status=='Active') ? 'green' : 'red'; ?>;
font-size:20px;
font-weight:bold;
">
<?php echo $status; ?>
</span>

</p>
<p style="font-size:18px;">
💰 Fees Paid :
<br>
<b><?php echo $row['FEES']; ?></b>
</p>


<a href="logout.php">
<button style="padding:10px 20px;
background:red;color:white;border:none;
border-radius:8px;font-size:16px;">
Logout
</button>
</a>

</div>
</body>
</html>