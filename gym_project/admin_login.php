<?php
session_start();
include("db.php");
if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // DEFAULT ADMIN LOGIN (Hardcoded)
    if($username=="admin" && $password=="admin123"){
        $_SESSION['admin']="admin";
        header("Location: admin_dashboard.php");
        exit();
    }

    // DATABASE ADMIN LOGIN
    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result)>0){
        $_SESSION['admin']=$username;
        header("Location: admin_dashboard.php");
        exit();
    }else{
        echo "<script>alert('Invalid Login');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

body{
    margin:0;
    font-family: Arial, Helvetica, sans-serif;
    background-image:url('https://images.unsplash.com/photo-1571902943202-507ec2618e8f');
    background-size:cover;
    background-position:center;
}

/* Dark Overlay */

.overlay{
    height:100vh;
    width:100%;
    background:rgba(0,0,0,0.75);
    display:flex;
    justify-content:center;
    align-items:center;
}

/* Login Card */

.login-box{
    background:rgba(255,255,255,0.95);
    padding:40px;
    border-radius:15px;
    width:350px;
    text-align:center;
    box-shadow:0px 10px 30px rgba(0,0,0,0.6);
}

.login-box h2{
    margin-bottom:25px;
}

/* Input */

input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:8px;
    border:1px solid #ccc;
}

/* Button */

button{
    width:100%;
    padding:12px;
    background:linear-gradient(45deg,#ff512f,#dd2476);
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    transform:scale(1.05);
    background:linear-gradient(45deg,#24c6dc,#514a9d);
}

</style>
</head>

<body>

<div class="overlay">

<div class="login-box">
    <h2>💪 Admin Login</h2>

    <form method="post">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button name="login">Login</button>
    </form>

</div>

</div>

</body>
</html>