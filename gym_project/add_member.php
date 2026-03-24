<?php
session_start();
include("db.php");
$msg="";
$plans = mysqli_query($conn,"SELECT * FROM plans");
if(isset($_POST['add']))
{
$name=$_POST['name'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$batch=$_POST['batch'];
$plan_id=$_POST['plan_id'];

/* GET PLAN DETAILS */
$get_plan = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM plans WHERE plan_id='$plan_id'"));

$duration = $get_plan['duration'];
$fees = $get_plan['amount'];

$join_date = date('Y-m-d');
$expiry_date = date('Y-m-d', strtotime("+$duration months"));

$q="INSERT INTO members(NAME,Age,Gender,`CONTACT NO`,email,BATCH,plan_id,FEES,Join_date,expiry_date)
VALUES('$name','$age','$gender','$phone','$email','$batch','$plan_id','$fees','$join_date','$expiry_date')";

if(mysqli_query($conn,$q))
{
$member_id = mysqli_insert_id($conn);

/* INSERT PAYMENT ONLY HERE */
mysqli_query($conn,"INSERT INTO payments(member_id,amount,payment_date)
VALUES('$member_id','$fees',CURDATE())");

/* USER LOGIN */
mysqli_query($conn,"INSERT INTO users(email,password)
VALUES('$email','$phone')");

$msg="Member Added Successfully";
}
else
{
$msg="Error Adding Member";
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Member</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

<style>

body{
margin:0;
font-family:'Poppins',sans-serif;
background:url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48') no-repeat center center/cover;
}

/* DARK HERO OVERLAY */

.overlay{
height:100vh;
background:linear-gradient(120deg,rgba(0,0,0,0.92),rgba(0,0,0,0.85));
display:flex;
justify-content:center;
align-items:center;
}

/* BIG GLASS CARD */

.card{
width:480px;
padding:45px;
border-radius:25px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(18px);
box-shadow:0 20px 60px rgba(0,0,0,0.8);
text-align:center;
color:white;
}

/* TITLE */

.card h2{
font-weight:700;
letter-spacing:1px;
margin-bottom:25px;
}

/* INPUT GROUP */

.form-group{
margin-bottom:18px;
}

input,select{
width:100%;
padding:16px 18px;
border-radius:30px;   /* ⭐ pill shape */
border:2px solid transparent;
outline:none;
font-size:15px;
background:rgba(255,255,255,0.92);
transition:0.3s;
box-sizing:border-box;
}

/* Focus Glow */

input:focus,select:focus{
border:2px solid #ff512f;
box-shadow:0 0 15px rgba(255,81,47,0.6);
background:white;
}

/* FOCUS EFFECT */

input:focus,select:focus{
box-shadow:0 0 12px #ff512f;
}

/* BUTTON */

button{
width:100%;
padding:16px;
border:none;
border-radius:16px;
background:linear-gradient(45deg,#ff512f,#dd2476);
color:white;
font-size:17px;
font-weight:600;
cursor:pointer;
transition:0.4s;
margin-top:10px;
}

button:hover{
transform:translateY(-3px);
box-shadow:0 10px 20px rgba(255,81,47,0.6);
}

/* DASHBOARD BUTTON */

.back{
position:absolute;
top:25px;
left:25px;
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
.card{
width:480px;
padding:45px;
border-radius:25px;
background:rgba(255,255,255,0.08);
}

/* ⭐ ADD POPUP CSS HERE ⭐ */

.success{
background:linear-gradient(45deg,#00b09b,#96c93d);
padding:18px;
border-radius:18px;
margin-bottom:20px;
color:white;
font-weight:600;
text-align:center;
animation:pop 0.4s ease;
}

@keyframes pop{
from{transform:scale(0.7);opacity:0;}
to{transform:scale(1);opacity:1;}
}

</style>
</style>
</head>

<body>

<a class="back" href="admin_dashboard.php">← Dashboard</a>

<div class="overlay">

<div class="card">

<h2>💪 Add Gym Member</h2>
<?php if($msg!=""){ ?>
<div class="success">
<?php echo $msg; ?>
<br><br>
<a href="view.php">View Members →</a>
</div>
<?php } ?>

<form method="post">

<div class="form-group">
<input type="text" name="name" placeholder="Member Name" required>
</div>

<div class="form-group">
<input type="number" name="age" placeholder="Age" required>
</div>

<div class="form-group">
<select name="gender" required>
<option value="">Select Gender</option>
<option>Male</option>
<option>Female</option>
</select>
</div>

<div class="form-group">
<input type="text" name="phone" placeholder="Contact Number" required>
</div>
<div class="form-group">
<input type="email" name="email" placeholder="Enter Email" required>
</div>
    

<div class="form-group">
<select name="batch" required>
<option value="">Select Batch</option>
<option>MORNING</option>
<option>EVENING</option>
</select>
</div>

<div class="form-group">
<select name="plan_id" required>
<option value="">Select Plan</option>
<?php while($p=mysqli_fetch_assoc($plans)){ ?>
<option value="<?php echo $p['plan_id']; ?>">
<?php echo $p['plan_name']; ?>
</option>
<?php } ?>
</select>
</div>

<button type="submit" name="add">Add Member</button>

</form>

</div>

</div>

</body>
</html>
