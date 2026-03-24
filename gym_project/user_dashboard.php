<?php
session_start();
include("db.php");

$email = $_SESSION['user'];

/* GET MEMBER + PLAN NAME */
$q = "
SELECT members.*, plans.plan_name
FROM members
LEFT JOIN plans ON members.plan_id = plans.plan_id
WHERE members.email='$email'
";

$result = mysqli_query($conn,$q);
$row = mysqli_fetch_assoc($result);

/* EXPIRY LOGIC */
$today = new DateTime();
$expiry_date = new DateTime($row['expiry_date']);

if($today > $expiry_date){
    $status = "Expired";
    $remaining = 0;
}else{
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

.overlay{
min-height:100vh;
background:linear-gradient(120deg,rgba(0,0,0,0.95),rgba(0,0,0,0.85));
padding:40px;
}

.card{
width:500px;
margin:80px auto;
padding:30px;
background:rgba(255,255,255,0.9);
border-radius:15px;
box-shadow:0px 0px 20px black;
text-align:center;
}

button{
padding:10px 20px;
background:red;
color:white;
border:none;
border-radius:8px;
font-size:16px;
cursor:pointer;
}
</style>
</head>

<body>

<div class="card">

<h1>🏋️ Gym Member Dashboard</h1>

<h2 style="color:green;">
Welcome <?php echo $row['NAME']; ?>
</h2>

<hr>

<p style="font-size:18px;">
💪 Your Gym Plan :
<br>
<b><?php echo $row['plan_name']; ?></b>
</p>

<p style="font-size:18px;">
📅 Membership Started On :
<br>
<b><?php echo $row['Join_date']; ?></b>
</p>

<p style="font-size:18px;">
📆 Expiry Date :
<br>
<b><?php echo $row['expiry_date']; ?></b>
</p>

<p style="font-size:18px;">
⏳ Remaining Days :
<br>
<b><?php echo $remaining; ?> Days</b>
</p>

<p style="font-size:18px;">
Status :
<br>
<span style="
color:<?php echo ($status=='Active')?'green':'red'; ?>;
font-size:20px;
font-weight:bold;">
<?php echo $status; ?>
</span>
</p>

<p style="font-size:18px;">
💰 Fees Paid :
<br>
<b><?php echo $row['FEES']; ?></b>
</p>

<a href="logout.php">
<button>Logout</button>
</a>

</div>

</body>
</html>