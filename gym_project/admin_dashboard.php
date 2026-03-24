<?php
session_start();
include("db.php");

/* COUNTS */
$total = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as t FROM members"))['t'];

$active = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as t FROM members WHERE expiry_date >= CURDATE()"))['t'];

$expired = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT COUNT(*) as t FROM members WHERE expiry_date < CURDATE()"))['t'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>
body{
margin:0;
font-family:'Poppins',sans-serif;
background:url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48') no-repeat center center/cover;
}

/* DARK OVERLAY */
.overlay{
height:100vh;
background:linear-gradient(rgba(0,0,0,0.92),rgba(0,0,0,0.85));
display:flex;
}

/* SIDEBAR */
.sidebar{
width:240px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(12px);
padding:25px;
box-shadow:5px 0 20px rgba(0,0,0,0.6);
}

.sidebar h2{
color:white;
text-align:center;
margin-bottom:30px;
}

.menu a{
display:block;
padding:14px;
margin-bottom:10px;
background:white;
color:black;
text-decoration:none;
border-radius:12px;
font-weight:600;
text-align:center;
transition:0.3s;
}

.menu a:hover{
background:#ff512f;
color:white;
}

/* MAIN AREA */
.main{
flex:1;
padding:40px;
text-align:center;
}

.main h1{
color:white;
margin-bottom:40px;
}

/* CARDS */
.cards{
display:flex;
justify-content:center;
gap:30px;
flex-wrap:wrap;
}

.card{
width:220px;
padding:25px;
border-radius:20px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(12px);
box-shadow:0 20px 40px rgba(0,0,0,0.7);
color:white;
}

.card h3{
margin-bottom:10px;
}

.card h2{
font-size:32px;
}
</style>
</head>

<body>

<div class="overlay">

<!-- SIDEBAR -->
<div class="sidebar">

<h2>💪 MyGym</h2>

<div class="menu">
<a href="add_member.php">➕ Add Member</a>
<a href="view.php">👥 View Members</a>
<a href="payments.php">💰 Payments</a>
<a href="deleted_members.php">🗑 Deleted Members</a>
<a href="logout.php">🚪 Logout</a>
</div>

</div>

<!-- MAIN DASHBOARD -->
<div class="main">

<h1>🏋️ Admin Dashboard</h1>

<div class="cards">

<div class="card">
<h3>Total Members</h3>
<h2><?php echo $total; ?></h2>
</div>

<div class="card">
<h3>Active Members</h3>
<h2><?php echo $active; ?></h2>
    <a href="view.php?status=active">✅ Active Members</a>
</div>

<div class="card">
<h3>Expired Members</h3>
<h2><?php echo $expired; ?></h2>
    <a href="view.php?status=expired">❌ Expired Members</a>
</div>

</div>

</div>

</div>

</body>
</html>