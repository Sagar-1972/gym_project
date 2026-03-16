<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

body{
    margin:0;
    font-family: Arial, Helvetica, sans-serif;
    background:linear-gradient(135deg,#141e30,#243b55);
}

/* Sidebar */

.sidebar{
    width:220px;
    height:100vh;
    background:black;
    position:fixed;
    padding-top:30px;
}

.sidebar h2{
    color:#00ffcc;
    text-align:center;
    margin-bottom:40px;
}

.sidebar a{
    display:block;
    color:white;
    padding:15px;
    text-decoration:none;
    transition:0.3s;
}

.sidebar a:hover{
    background:#00ffcc;
    color:black;
}

/* Main Content */

.main{
    margin-left:220px;
    padding:40px;
    color:white;
}

.card{
    background:white;
    color:black;
    padding:30px;
    border-radius:12px;
    width:300px;
    box-shadow:0px 10px 25px rgba(0,0,0,0.5);
}

</style>
</head>

<body>

<div class="sidebar">
    <h2>💪 Admin</h2>
    <a href="add_member.php">➕ Add Member</a>
    <a href="view.php">👥 View Members</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<div class="main">
    <h1>Welcome Admin 👋</h1>

    <div class="card">
        <h3>Gym Management Panel</h3>
        <p>Use the sidebar to manage gym members, plans and records.</p>
    </div>

</div>

</body>
</html>