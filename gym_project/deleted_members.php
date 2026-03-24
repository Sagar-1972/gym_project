<?php
session_start();
include("db.php");

$result = mysqli_query($conn,"
SELECT deleted_members.*, plans.plan_name
FROM deleted_members
LEFT JOIN plans
ON deleted_members.plan_id = plans.plan_id
ORDER BY deleted_members.ID DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Deleted Members</title>

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
background:linear-gradient(rgba(0,0,0,0.9),rgba(0,0,0,0.85));
padding:40px;
}

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

<h1>🗑 Deleted Members</h1>

<div class="table-box">

<table>

<tr>
<th>SL NO</th>
<th>Name</th>
<th>Age</th>
<th>Contact</th>
<th>Plan</th>
<th>Batch</th> 
<th>Join date</th>
<th>Expiry Date</th>
</tr>

<?php
$SL_no= $start+1;
while($row=mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $SL_no++; ?></td>
<td><?php echo $row['NAME']; ?></td>
<td><?php echo $row['Age']; ?></td>
<td><?php echo $row['CONTACT NO']; ?></td>
<td><?php echo $row['plan_name']; ?></td>
<td><?php echo $row['BATCH']; ?></td>
<td><?php echo $row['Join_date']; ?></td>
<td><?php echo $row['expiry_date']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>