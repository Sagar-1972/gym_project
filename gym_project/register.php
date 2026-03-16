<?php
session_start();
include("db.php");

if(isset($_POST['register']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['password'];

$q="INSERT INTO users(name,email,password) VALUES('$name','$email','$pass')";

if(mysqli_query($conn,$q))
{
echo "<script>
alert('✅ Registration Successful');
window.location='user_login.php';
</script>";
}
else
{
echo "<script>alert('❌ Registration Failed');</script>";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Register</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>

body{
margin:0;
font-family:'Poppins',sans-serif;
background:url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48') no-repeat center center/cover;
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
width:400px;
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

/* LOGIN LINK */

.login{
margin-top:15px;
font-size:14px;
}

.login a{
color:#ff512f;
text-decoration:none;
font-weight:600;
}

.login a:hover{
text-decoration:underline;
}

</style>
</head>

<body>

<div class="overlay">

<div class="card">

<h2>📝 User Registration</h2>

<form method="post">

<div class="form-group">
<input type="text" name="name" placeholder="Enter Name" required>
</div>

<div class="form-group">
<input type="email" name="email" placeholder="Enter Email" required>
</div>

<div class="form-group">
<input type="password" name="password" placeholder="Enter Password" required>
</div>

<button name="register">Register</button>

</form>

<div class="login">
Already have account ? <a href="user_login.php">Login</a>
</div>

</div>

</div>

</body>
</html>