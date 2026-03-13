<?php
include "db.php";

$doctor_id = 1;

$result = $conn->query("SELECT * FROM doctors WHERE id=$doctor_id");
$doctor = $result->fetch_assoc();

$appointments = $conn->query("SELECT * FROM appointments WHERE doctor_id=$doctor_id");
?>

<!DOCTYPE html>
<html>
<head>
<title>Doctor Dashboard</title>
<style>
body{
font-family: Arial;
background:#f4f6f9;
margin:0;
}

.header{
background:#2c7be5;
color:white;
padding:15px;
text-align:center;
}

.container{
padding:20px;
}

.card{
background:white;
padding:20px;
margin-bottom:20px;
border-radius:8px;
box-shadow:0 2px 5px rgba(0,0,0,0.1);
}

table{
width:100%;
border-collapse:collapse;
}

th,td{
padding:10px;
border-bottom:1px solid #ddd;
text-align:left;
}

th{
background:#f1f1f1;
}
</style>
</head>

<body>

<div class="header">
<h2>Doctor Dashboard</h2>
</div>

<div class="container">

<div class="card">
<h3>Doctor Profile</h3>
<p><b>Name:</b> <?php echo $doctor['name']; ?></p>
<p><b>Department:</b> <?php echo $doctor['department']; ?></p>
<p><b>Contact:</b> <?php echo $doctor['contact']; ?></p>
</div>

<div class="card">
<h3>My Appointments</h3>

<table>
<tr>
<th>Appointment ID</th>
<th>Patient ID</th>
<th>Date</th>
<th>Status</th>
</tr>

<?php
while($row = $appointments->fetch_assoc()){
?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['patient_id']; ?></td>
<td><?php echo $row['date']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>