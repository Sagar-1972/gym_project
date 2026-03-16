<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include("db.php");

if(isset($_POST['login']))
{
$email=$_POST['email'];
$pass=$_POST['password'];

$q="SELECT * FROM users WHERE email='$email' AND password='$pass'";
$r=mysqli_query($conn,$q);

if(mysqli_num_rows($r)>0)
{
$_SESSION['user']=$email;
header("location:user_dashboard.php");
}
else
{
echo "<script>alert('❌ Invalid Login');</script>";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>

body{
margin:0;
font-family:'Poppins',sans-serif;
background:url('https://images.unsplash.com/photo-1571902943202-507ec2618e8f') no-repeat center center/cover;
}

/* DARK HERO */

.overlay{
height:100vh;
background:linear-gradient(120deg,rgba(0,0,0,0.95),rgba(0,0,0,0.85));
display:flex;
justify-content:center;
align-items:center;
}

/* GLASS CARD */

.card{
width:380px;
padding:40px;
border-radius:25px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(18px);
box-shadow:0 20px 60px rgba(0,0,0,0.8);
text-align:center;
color:white;
}

/* TITLE */

.card h2{
margin-bottom:25px;
}

/* INPUT */

.form-group{
margin-bottom:18px;
}

input{
width:100%;
padding:15px;
border-radius:30px;
border:none;
outline:none;
font-size:15px;
background:rgba(255,255,255,0.92);
}

/* BUTTON */

button{
width:100%;
padding:15px;
border:none;
border-radius:20px;
background:linear-gradient(45deg,#ff512f,#dd2476);
color:white;
font-size:17px;
font-weight:600;
cursor:pointer;
transition:0.3s;
}

button:hover{
transform:translateY(-3px);
box-shadow:0 10px 20px rgba(255,81,47,0.6);
}

/* REGISTER LINK */

.register{
margin-top:15px;
font-size:14px;
}

.register a{
color:#ff512f;
text-decoration:none;
font-weight:600;
}

.register a:hover{
text-decoration:underline;
}

</style>
</head>

<body>

<div class="overlay">

<div class="card">

<h2>👤 User Login</h2>

<form method="post">

<div class="form-group">
<input type="email" name="email" placeholder="Enter Email" required>
</div>

<div class="form-group">
<input type="password" name="password" placeholder="Enter Password" required>
</div>

<button name="login">Login</button>

</form>

<div class="register">
New User ? <a href="register.php">Register Here</a>
</div>

</div>

</div>

</body>
</html>