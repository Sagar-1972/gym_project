<?php
session_start();
include("db.php");
$status = "";
if(isset($_GET['status'])){
    $status = $_GET['status'];
}
$total_q = mysqli_query($conn,"SELECT COUNT(*) as total FROM members");
$total = mysqli_fetch_assoc($total_q)['total'];

$active_q = mysqli_query($conn,"
SELECT COUNT(*) as active FROM members
WHERE DATE_ADD(Join_date, INTERVAL 
CASE 
WHEN PLAN='MONTHLY' THEN 1
WHEN PLAN='QUARTERLY' THEN 3
WHEN PLAN='HALFYEARLY' THEN 6
WHEN PLAN='ANNUALLY' THEN 12
END MONTH) >= CURDATE()
");
$active = mysqli_fetch_assoc($active_q)['active'];

$expired = $total - $active;
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1){ $page = 1; }

$start = ($page - 1) * $limit;
$slno = $start +1;


$q = "SELECT * FROM members WHERE 1=1";

/* STATUS FILTER */

if($status == "active"){
$q .= " AND DATE_ADD(Join_date, INTERVAL 
CASE 
WHEN PLAN='MONTHLY' THEN 1
WHEN PLAN='QUARTERLY' THEN 3
WHEN PLAN='HALFYEARLY' THEN 6
WHEN PLAN='ANNUALLY' THEN 12
END MONTH) >= CURDATE()";
}

if($status == "expired"){
$q .= " AND DATE_ADD(Join_date, INTERVAL 
CASE 
WHEN PLAN='MONTHLY' THEN 1
WHEN PLAN='QUARTERLY' THEN 3
WHEN PLAN='HALFYEARLY' THEN 6
WHEN PLAN='ANNUALLY' THEN 12
END MONTH) < CURDATE()";
}

/* SEARCH FILTER */

if(isset($_GET['search']) && $_GET['search'] != ""){
$search = mysqli_real_escape_string($conn,$_GET['search']);
$q .= " AND NAME LIKE '%$search%'";
}

$q .= " ORDER BY ID ASC LIMIT ".$start.",".$limit;
$result = mysqli_query($conn,$q);

if(!$result){
    die(mysqli_error($conn));
}

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
<?php
$count_query = "SELECT COUNT(*) as total FROM members";
$where = "";

if(isset($_GET['search']) && $_GET['search'] != ""){
    $search = mysqli_real_escape_string($conn,$_GET['search']);
    $where = " WHERE NAME LIKE '%$search%'";
}

$count_query .= $where;
$countq = mysqli_query($conn,$count_query);
$countdata = mysqli_fetch_assoc($countq);
?>

<div style="background:linear-gradient(45deg,#ff512f,#dd2476);
padding:12px;border-radius:10px;color:white;
width:220px;margin-bottom:15px;font-size:22px;">
Total Members : <?php echo $countdata['total']; ?>
</div>

<form method="GET" style="margin-bottom:15px;">
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
<th>ID</th>
<th>Name</th>
<th>Age</th>
<th>Gender</th>
<th>Contact</th>
<th>Email-id</th>
<th>Batch</th>
<th>Plan</th>
<th>Fees</th>
<th>Join Date</th>
<th>Action</th>
</tr>

<?php


$sn = $start + 1;
while($row=mysqli_fetch_assoc($result))
{
?>
<tr>
<td><?php echo $sn++; ?></td>
<td><?php echo $row['NAME']; ?></td>
<td><?php echo $row['Age']; ?></td>
<td><?php echo $row['Gender']; ?></td>
<td><?php echo $row['CONTACT NO']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['BATCH']; ?></td>
<td><?php echo $row['PLAN']; ?></td>
<td><?php echo $row['FEES']; ?></td>
<td><?php echo $row['Join_date']; ?></td>

<td>
<a class="update" href="update.php?id=<?php echo $row['ID']; ?>">Update</a> |
<a class="delete" href="delete.php?id=<?php echo $row['ID']; ?>&email=<?php echo $row['email']; ?>">Delete</a>
</td>
</tr>

<?php
}
?>

</table>
<?php
$total_query = "SELECT COUNT(*) as total FROM members WHERE 1=1";

if($status == "active"){
$total_query .= " AND DATE_ADD(Join_date, INTERVAL 
CASE 
WHEN PLAN='MONTHLY' THEN 1
WHEN PLAN='QUARTERLY' THEN 3
WHEN PLAN='HALFYEARLY' THEN 6
WHEN PLAN='ANNUALLY' THEN 12
END MONTH) >= CURDATE()";
}

if($status == "expired"){
$total_query .= " AND DATE_ADD(Join_date, INTERVAL 
CASE 
WHEN PLAN='MONTHLY' THEN 1
WHEN PLAN='QUARTERLY' THEN 3
WHEN PLAN='HALFYEARLY' THEN 6
WHEN PLAN='ANNUALLY' THEN 12
END MONTH) < CURDATE()";
}

if(isset($_GET['search']) && $_GET['search'] != ""){
$search = mysqli_real_escape_string($conn,$_GET['search']);
$total_query .= " AND NAME LIKE '%$search%'";
}

$totalq = mysqli_query($conn,$total_query);
$totaldata = mysqli_fetch_assoc($totalq);
$total_pages = ceil($totaldata['total']/$limit);
echo "<div style='margin-top:15px;'>";

$search_param = "";
$status_param = "";

if(isset($_GET['search']) && $_GET['search'] != ""){
$search_param = "&search=".$_GET['search'];
}

if(isset($_GET['status'])){
$status_param = "&status=".$_GET['status'];
}
    
if($page > 1){
echo "<a href='?page=".($page-1).
$search_param."'
style='padding:8px 12px;background:black;color:white;margin:5px;text-decoration:none;border-radius:6px;'>Previous</a>";
}

for($i=1;$i<=$total_pages;$i++){
echo "<a href='?page=".$i.$search_param.$status_param."' 
style='padding:8px 12px;background:#ff512f;color:white;margin:5px;text-decoration:none;border-radius:6px;'>$i</a>";
}

if($page < $total_pages){
echo "<a href='?page=".($page+1). 
$search_param."'
style='padding:8px 12px;background:black;color:white;margin:5px;text-decoration:none;border-radius:6px;'>Next</a>";
}

echo "</div>";
?>

</div>
</div>

</body>
</html>