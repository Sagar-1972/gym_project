<?php
include "db.php";

// TOTAL MEMBERS
$total_q = mysqli_query($conn,"SELECT COUNT(*) AS total FROM members");
$total = mysqli_fetch_assoc($total_q)['total'];

// ACTIVE MEMBERS
$active_q = mysqli_query($conn,"
SELECT COUNT(*) AS active FROM members
WHERE DATE_ADD(Join_date, INTERVAL 
CASE 
WHEN PLAN='MONTHLY' THEN 1
WHEN PLAN='QUARTERLY' THEN 3
WHEN PLAN='HALF YEAR' THEN 6
WHEN PLAN='ANNUALLY' THEN 12
END MONTH) >= CURDATE()
");
$active = mysqli_fetch_assoc($active_q)['active'];

// EXPIRED MEMBERS
$expired = $total - $active;
?>
<?php include 'header.php'; ?>
<div style="display:flex; gap:30px; margin-top:30px;">
<div style="
width:320px;
background:white;
padding:25px;
border-radius:12px;
box-shadow:0 5px 10px rgba(0,0,0,0.3);
">

<h2>Gym Management Panel</h2>
<p>Use the sidebar to manage gym members, plans and records.</p>

</div>
<div style="flex:1;">

<div style="
display:flex;
gap:30px;
margin-top:10px;
">
<div style="width:240px;height:150px;background:#3498db;
color:white;padding:20px;border-radius:12px;text-align:center;
display:flex;flex-direction:column;justify-content:center;">
<h3>Total Members</h3>
<h1><?php echo $total; ?></h1>
</div>
<a href="view.php?status=active" style="text-decoration:none;">
<div style="width:240px;height:150px;background:#2ecc71;
color:white;padding:20px;border-radius:12px;text-align:center;
display:flex;flex-direction:column;justify-content:center;">
<h3>Active Members</h3>
<h1><?php echo $active; ?></h1>
</div>
</a>
<a href="view.php?status=expired" style="text-decoration:none;">
<div style="width:240px;height:150px;background:#e74c3c;
color:white;padding:20px;border-radius:12px;text-align:center;
display:flex;flex-direction:column;justify-content:center;">
<h3>Expired Members</h3>
<h1><?php echo $expired; ?></h1>
</div>
</a>
</div>
</div>
</div>
<?php include 'footer.php'; ?>