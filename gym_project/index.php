<!DOCTYPE html>
<html>
<head>
<title>MyGym</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

body{
    margin:0;
    font-family: Arial, Helvetica, sans-serif;
}

/* HERO IMAGE BACKGROUND */

.hero{
    height:100vh;
    background-image:url('https://images.unsplash.com/photo-1554284126-aa88f22d8b74');
    background-size:cover;
    background-position:center;
    position:relative;
}

.overlay{
    position:absolute;
    height:100%;
    width:100%;
    background:rgba(0,0,0,0.7);
    display:flex;
    justify-content:center;
    align-items:center;
}

/* CONTENT BOX */

.box{
    background:rgba(255,255,255,0.95);
    padding:40px;
    border-radius:15px;
    text-align:center;
    width:350px;
    box-shadow:0px 10px 30px rgba(0,0,0,0.5);
}

.box h1{
    margin-bottom:30px;
}

/* BUTTON DESIGN */

.btn{
    display:block;
    background:linear-gradient(45deg,#ff512f,#dd2476);
    color:white;
    padding:15px;
    margin:15px 0;
    text-decoration:none;
    border-radius:8px;
    font-weight:bold;
    transition:0.3s;
}

.btn:hover{
    transform:scale(1.08);
    background:linear-gradient(45deg,#24c6dc,#514a9d);
}

</style>
</head>

<body>

<div class="hero">
    <div class="overlay">

        <div class="box">
            <h1>💪 Gym Management</h1>

            <a class="btn" href="admin_login.php">Admin Login</a>
            <a class="btn" href="user_login.php">User Login</a>
            <a class="btn" href="register.php">New User Register</a>
        </div>

    </div>
</div>

</body>
</html>