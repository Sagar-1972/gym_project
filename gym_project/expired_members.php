<?php
session_start();
include("db.php");

$status = "";
if(isset($_GET['status'])){
    $status = $_GET['status'];
}

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1){ $page = 1; }

$start = ($page - 1) * $limit;

/* MAIN QUERY */
$q = "
SELECT members.*, plans.plan_name
FROM members
LEFT JOIN plans
ON members.plan_id = plans.plan_id
WHERE members.status='expired'
AND members.expiry_date >= CURDATE()
";

if(isset($_GET['search']) && $_GET['search'] != ""){
    $search = mysqli_real_escape_string($conn,$_GET['search']);
    $q .= " AND NAME LIKE '%$search%'";
}

/* FINAL ORDER + LIMIT */
$q .= " ORDER BY members.ID ASC LIMIT $start,$limit";
$result = mysqli_query($conn,$q);

/* COUNT */
$count_query = "
SELECT COUNT(*) as total 
FROM members 
WHERE status='active'
AND expiry_date < CURDATE()
";

if(isset($_GET['search']) && $_GET['search'] != ""){
    $search = mysqli_real_escape_string($conn,$_GET['search']);
    $count_query .= " AND NAME LIKE '%$search%'";
}

$countq = mysqli_query($conn,$count_query);
$totaldata = mysqli_fetch_assoc($countq);
$total_pages = ceil($totaldata['total']/$limit);
?>

<!DOCTYPE html>
<html>
<head>
<title>Expired Gym Members</title>

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

.update{color:#00ffea;text-decoration:none;font-weight:600;}
.delete{color:#ff4d4d;text-decoration:none;font-weight:600;}

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

<h1>Expired  Gym Members List</h1>

<form method="GET" style="margin-bottom:15px;">
<input type="hidden" name="status" value="<?php echo $status; ?>">
<input type="text" name="search"
value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>"
placeholder="Search Name..."
style="padding:10px;border-radius:8px;width:250px;">
<button style="padding:10px;background:#ff512f;color:white;border:none;border-radius:8px;">
Search
</button>
</form>

<div class="table-box">

<table>
<tr>
<th>SL</th>
<th>Name</th>
<th>Age</th>
<th>Gender</th>
<th>Contact</th>
<th>Email</th>
<th>Batch</th>
<th>Plan</th>
<th>Fees</th>
<th>Join Date</th>
<th>Expiry</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
$SL_no = 1;

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $SL_no++; ?></td>
<td><?php echo $row['NAME']; ?></td>
<td><?php echo $row['Age']; ?></td>
<td><?php echo $row['Gender']; ?></td>
<td><?php echo $row['CONTACT NO']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['BATCH']; ?></td>
<td><?php echo $row['plan_name']; ?></td>
<td><?php echo $row['FEES']; ?></td>
<td><?php echo $row['Join_date']; ?></td>
<td><?php echo $row['expiry_date']; ?></td>

</tr>

<?php 
    }

}else{
    echo "<tr><td colspan='13' style='color:#ff4d4d;text-align:center;'>No expired members found</td></tr>";
}
?>
</table>

<br>

<?php
$search_param = isset($_GET['search']) ? "&search=".$_GET['search'] : "";
$status_param = isset($_GET['status']) ? "&status=".$_GET['status'] : "";

if($page > 1){
echo "<a href='?page=".($page-1).$search_param.$status_param."' class='back'>Previous</a>";
}

for($i=1;$i<=$total_pages;$i++){
echo "<a href='?page=$i$search_param$status_param' class='back'>$i</a>";
}

if($page < $total_pages){
echo "<a href='?page=".($page+1).$search_param.$status_param."' class='back'>Next</a>";
}
?>

</div>
</div>
</body>
</html>