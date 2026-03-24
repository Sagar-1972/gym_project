<?php
session_start();
include("db.php");

/* PAGINATION */
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1){ $page = 1; }

$start = ($page - 1) * $limit;

/* MAIN QUERY */
$q = "
SELECT payments.*,
COALESCE(members.NAME, deleted_members.NAME) AS NAME
FROM payments
LEFT JOIN members ON payments.member_id = members.ID
LEFT JOIN deleted_members ON payments.member_id = deleted_members.ID
ORDER BY payment_date DESC
LIMIT $start,$limit
";

$result = mysqli_query($conn,$q);

/* COUNT */
$count_q = mysqli_query($conn,"SELECT COUNT(*) as total FROM payments");
$total = mysqli_fetch_assoc($count_q)['total'];
$total_pages = ceil($total/$limit);
?>

<!DOCTYPE html>
<html>
<head>
<title>Payments</title>

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

.table-box{
background:rgba(255,255,255,0.08);
backdrop-filter:blur(12px);
padding:25px;
border-radius:20px;
box-shadow:0 20px 40px rgba(0,0,0,0.7);
}

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

<h1>💰 Payment History</h1>

<div class="table-box">

<table>
<tr>
<th>SL</th>
<th>Member Name</th>
<th>Amount</th>
<th>Payment Date</th>
</tr>

<?php
$sn = $start + 1;
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $sn++; ?></td>
<td><?php echo $row['NAME']; ?></td>
<td><?php echo $row['amount']; ?></td>
<td><?php echo $row['payment_date']; ?></td>
</tr>

<?php } ?>

</table>

<br>

<?php
if($page > 1){
echo "<a class='back' href='?page=".($page-1)."'>Previous</a>";
}

for($i=1;$i<=$total_pages;$i++){
echo "<a class='back' href='?page=$i'>$i</a>";
}

if($page < $total_pages){
echo "<a class='back' href='?page=".($page+1)."'>Next</a>";
}
?>

</div>
</div>
</body>
</html>