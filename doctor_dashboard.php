<?php
session_start();
include "db.php";

/* Check login */
if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

$doctor_id = $_SESSION['user_id'];

/* Get doctor info */
$sql = "SELECT * FROM users WHERE id='$doctor_id'";
$result = mysqli_query($conn,$sql);
$doctor = mysqli_fetch_assoc($result);

/* Get doctor appointments */
$sql2 = "SELECT * FROM appointments WHERE doctor_id='$doctor_id'";
$result2 = mysqli_query($conn,$sql2);
?>

<!DOCTYPE html>
<html>
<head>

<title>Doctor Dashboard</title>

<style>

body{
font-family:Arial;
background:#f4f6fb;
margin:0;
}

.header{
background:#2563eb;
color:white;
padding:20px;
font-size:24px;
text-align:center;
}

.container{
width:90%;
margin:auto;
margin-top:30px;
}

.card{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 5px 10px rgba(0,0,0,0.1);
margin-bottom:25px;
}

table{
width:100%;
border-collapse:collapse;
}

table th, table td{
padding:12px;
border-bottom:1px solid #ddd;
}

table th{
background:#f0f2f5;
}

</style>

</head>

<body>

<div class="header">
Doctor Dashboard
</div>

<div class="container">

<!-- Doctor Info -->

<div class="card">

<h3>Doctor Profile</h3>

<p><b>Name:</b> <?php echo $doctor['username']; ?></p>

<p><b>Email:</b> <?php echo $doctor['email']; ?></p>

<p><b>Phone:</b> <?php echo $doctor['phone']; ?></p>

</div>

<!-- Appointment Table -->

<div class="card">

<h3>Your Appointments</h3>

<table>

<tr>
<th>Patient</th>
<th>Date</th>
<th>Time</th>
<th>Problem</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result2)){ ?>

<tr>
<td><?php echo $row['patient_name']; ?></td>
<td><?php echo $row['appointment_date']; ?></td>
<td><?php echo $row['appointment_time']; ?></td>
<td><?php echo $row['problem']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>