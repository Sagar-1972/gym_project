<!DOCTYPE html>
<html>
<head>
<title>Gym Management</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<style>


html,body{
height:100%;
margin:0;
font-family:'Poppins',sans-serif;
background:#0f172a;
}

.wrapper{
min-height:100vh;
display:flex;
flex-direction:column;
}

.top-header{
background:#111;
color:white;
padding:10px 20px;
display:flex;
justify-content:space-between;
align-items:center;
}

.main{
flex:1;
display:flex;
}

.sidebar{
width:220px;
background:black;
color:white;
padding-top:20px;
}

.sidebar a{
display:block;
color:white;
padding:12px;
text-decoration:none;
}

.sidebar a:hover{
background:#ff4d4d;
}

.content{
flex:1;
padding:30px;
background:#1e293b;
}

</style>

</head>
<body>

<div class="wrapper">

<div class="top-header">
<div>🏋 Gym Management System</div>

<a href="logout.php" style="background:#ff4d4d;color:white;padding:6px 14px;border-radius:6px;text-decoration:none;">
Logout
</a>
</div>

<div class="main">

<div class="sidebar">
<h3 style="text-align:center;">💪 Admin</h3>


<a href="add_member.php">Add Member</a>
<a href="view.php">View Members</a>


</div>

<div class="content">