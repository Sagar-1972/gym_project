<?php
session_start();
include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Gym Members</title>

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
background:linear-gradient(rgba(0,0,0,0.9),rgba(0,0,0,0.85));
padding:40px;
}

/* TITLE */

h1{
text-align:center;
color:white;
margin-bottom:30px;
}

/* GLASS TABLE BOX */

.table-box{
background:rgba(255,255,255,0.08);
backdrop-filter:blur(12px);
padding:25px;
border-radius:20px;
box-shadow:0 20px 40px rgba(0,0,0,0.7);
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
font-size:15px;
}

td{
padding:12px;
text-align:center;
background:rgba(255,255,255,0.05);
}

tr:hover td{
background:rgba(255,255,255,0.12);
}

/* BUTTONS */

.update{
color:#00ffea;
text-decoration:none;
font-weight:600;
}

.delete{
color:#ff4d4d;
text-decoration:none;
font-weight:600;
}

/* DASHBOARD BUTTON */

.back{
display:inline-block;
margin-bottom:20px;
background:white;
padding:10px 18px;
border-radius:12px;
text-decoration:none;
color:black;
font-weight:600;
}

.back:hover{
background:#ff512f;
color:white;
}

</style>
</head>

<body>

<div class="overlay">

<a class="back" href="admin_dashboard.php">← Dashboard</a>

<h1>💪 Gym Members List</h1>

<div class="table-box">

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Age</th>
<th>Gender</th>
<th>Contact</th>
<th>Batch</th>
<th>Plan</th>
<th>Fees</th>
<th>Join Date</th>
<th>Action</th>
</tr>

<?php

$q="SELECT * FROM members";
$result=mysqli_query($conn,$q);

while($row=mysqli_fetch_assoc($result))
{
?>

<tr>
<td><?php echo $row['ID']; ?></td>
<td><?php echo $row['NAME']; ?></td>
<td><?php echo $row['Age']; ?></td>
<td><?php echo $row['Gender']; ?></td>
<td><?php echo $row['CONTACT NO']; ?></td>
<td><?php echo $row['BATCH']; ?></td>
<td><?php echo $row['PLAN']; ?></td>
<td><?php echo $row['FEES']; ?></td>
<td><?php echo $row['Join_date']; ?></td>

<td>
<a class="update" href="update.php?id=<?php echo $row['ID']; ?>">Update</a> |
<a class="delete" href="delete.php?id=<?php echo $row['ID']; ?>">Delete</a>
</td>
</tr>

<?php
}
?>

</table>

</div>
</div>

</body>
</html>