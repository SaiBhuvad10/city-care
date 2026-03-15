<?php
session_start();
include "db.php";

/* check login */
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$patient_id = $_SESSION['user_id'];
$patient_name = $_SESSION['username'];

/* get patient appointments */
$sql = "SELECT * FROM appointments WHERE patient_id='$patient_id' ORDER BY appointment_date DESC";
$result = mysqli_query($conn,$sql) or die(mysqli_error($conn));
?>

<!DOCTYPE html>
<html>
<head>
<title>Patient Dashboard</title>
<link rel="stylesheet" href="assets/css/main.css">

<style>

body{
font-family: Arial;
background:#f4f6fb;
margin:0;
}

.container{
width:90%;
margin:auto;
padding-top:40px;
}

h2{
margin-bottom:20px;
}

/* dashboard cards */

.cards{
display:flex;
gap:20px;
margin-bottom:30px;
}

.card{
flex:1;
padding:20px;
border-radius:10px;
color:white;
text-align:center;
box-shadow:0 10px 20px rgba(0,0,0,0.1);
}

.total{background:#2563eb;}
.pending{background:#f59e0b;}
.accepted{background:#22c55e;}
.rejected{background:#ef4444;}

.card h3{
margin:10px 0;
font-size:28px;
}

/* table */

table{
width:100%;
border-collapse:collapse;
background:white;
border-radius:10px;
overflow:hidden;
}

th,td{
padding:12px;
text-align:center;
}

th{
background:#2563eb;
color:white;
}

tr:nth-child(even){
background:#f9fafb;
}

.status{
padding:4px 10px;
border-radius:6px;
color:white;
font-size:13px;
}

.pending-status{background:#f59e0b;}
.accepted-status{background:#22c55e;}
.rejected-status{background:#ef4444;}

</style>

</head>

<body>

<div class="container">

<h2>Welcome <?php echo $patient_name; ?> 👋</h2>

<h3>My Appointments</h3>

<table>

<tr>
<th>Doctor</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<tr>

<td><?php echo $row['doctor_name']; ?></td>
<td><?php echo $row['date']; ?></td>
<td><?php echo $row['time']; ?></td>

<td>
<?php
$status = $row['status'];

if($status == "Pending"){
echo "<span class='status pending-status'>Pending</span>";
}
elseif($status == "Accepted"){
echo "<span class='status accepted-status'>Accepted</span>";
}
else{
echo "<span class='status rejected-status'>Rejected</span>";
}
?>
</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>