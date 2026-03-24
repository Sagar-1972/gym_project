<?php
session_start();
include("db.php");
$plans = mysqli_query($conn,"SELECT * FROM plans");
$id=$_GET['id'];
$q="SELECT * FROM members WHERE ID='$id'";
$result=mysqli_query($conn,$q);
$row=mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $old = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT plan_id FROM members WHERE ID='$id'"));

$old_plan = $old['plan_id'];
$name=$_POST['name'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$phone=$_POST['phone'];
$batch=$_POST['batch'];
$plan_id = $_POST['plan_id'];

$get_plan = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM plans WHERE plan_id='$plan_id'"));

$duration = $get_plan['duration'];
$fees = $get_plan['amount'];

$join_date = date('Y-m-d');
$expiry_date = date('Y-m-d', strtotime("+$duration months"));

$u="UPDATE members SET
NAME='$name',
Age='$age',
Gender='$gender',
`CONTACT NO`='$phone',
BATCH='$batch',
plan_id='$plan_id',
FEES='$fees',
expiry_date='$expiry_date'
WHERE ID='$id'";

mysqli_query($conn,$u);

echo "<script>
alert('✅ Member Updated Successfully');
window.location='view.php';
</script>";
    if($old_plan != $plan_id)
{
mysqli_query($conn,"INSERT INTO payments(member_id,amount,payment_date)
VALUES('$id','$fees',CURDATE())");
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Update Member</title>

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
height:100vh;
background:linear-gradient(120deg,rgba(0,0,0,0.95),rgba(0,0,0,0.85));
display:flex;
justify-content:center;
align-items:center;
}

/* GLASS CARD */

.card{
width:500px;
padding:40px;
border-radius:25px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(18px);
box-shadow:0 20px 60px rgba(0,0,0,0.8);
text-align:center;
color:white;
}

/* TITLE */

h2{
margin-bottom:25px;
}

/* INPUT */

.form-group{
margin-bottom:18px;
}

input,select{
width:100%;
padding:15px;
border-radius:30px;
border:none;
outline:none;
font-size:15px;
background:rgba(255,255,255,0.9);
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

/* BACK */

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
    *{
        box-sizing: border-box;
    }

</style>
</head>

<body>

<a class="back" href="view.php">← Back</a>

<div class="overlay">

<div class="card">

<h2>✏️ Update Gym Member</h2>

<form method="post">

<div class="form-group">
<input type="text" name="name" value="<?php echo $row['NAME']; ?>" required>
</div>

<div class="form-group">
<input type="number" name="age" value="<?php echo $row['Age']; ?>" required>
</div>

<div class="form-group">
<select name="gender">
<option <?php if($row['Gender']=="Male") echo "selected"; ?>>Male</option>
<option <?php if($row['Gender']=="Female") echo "selected"; ?>>Female</option>
</select>
</div>

<div class="form-group">
<input type="text" name="phone" value="<?php echo $row['CONTACT NO']; ?>" required>
</div>

<div class="form-group">
<select name="batch">
<option <?php if($row['BATCH']=="MORNING") echo "selected"; ?>>MORNING</option>
<option <?php if($row['BATCH']=="EVENING") echo "selected"; ?>>EVENING</option>
</select>
</div>

<div class="form-group">
<select name="plan_id" required>

<option value="">Select Plan</option>

<?php while($p = mysqli_fetch_assoc($plans)){ ?>

<option value="<?php echo $p['plan_id']; ?>"
<?php if($row['plan_id'] == $p['plan_id']){ echo "selected"; } ?>>

<?php echo $p['plan_name']; ?>

</option>

<?php } ?>

</select>
    </div>
<button name="update">Update Member</button>

</form>

</div>
</div>

</body>
</html>