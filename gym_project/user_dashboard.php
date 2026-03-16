<?php
session_start();
include("db.php");

if(!isset($_SESSION['user']))
{
header("location:index.php");
exit();
   
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

<body>

<div class="overlay">

<div class="top">
<h2>👋 Welcome User</h2>
<a class="logout" href="logout.php">Logout</a>
</div>

<h1>💪 Your Gym Membership</h1>

<div class="table-box">

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Age</th>
<th>Gender</th>
<th>Phone</th>
<th>Plan</th>
<th>Fees</th>
<th>Join Date</th>
</tr>

<?php

$q="SELECT * FROM members";
$res=mysqli_query($conn,$q);

while($row=mysqli_fetch_assoc($res))
{
echo "<tr>
<td>".$row['ID']."</td>
<td>".$row['NAME']."</td>
<td>".$row['Age']."</td>
<td>".$row['Gender']."</td>
<td>".$row['CONTACT NO']."</td>
<td>".$row['PLAN']."</td>
<td>".$row['FEES']."</td>
<td>".$row['Join_date']."</td>
</tr>";
}

?>

</table>

</div>

</div>

</body>
</html>