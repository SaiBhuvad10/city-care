<?php
include "db.php";

if(isset($_POST['signup'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$contact = $_POST['contact'];
$role = $_POST['role'];

/* PATIENT SIGNUP */

if($role == "patient"){

$age = $_POST['age'];
$gender = $_POST['gender'];

$sql = "INSERT INTO patients (name,age,gender,contact,email,password)
VALUES ('$name','$age','$gender','$contact','$email','$password')";

mysqli_query($conn,$sql);

header("Location: login.php");
exit();

}

/* DOCTOR SIGNUP */

if($role == "doctor"){

$department = $_POST['department'];

$sql = "INSERT INTO doctors (name,department,contact,email,password)
VALUES ('$name','$department','$contact','$email','$password')";

mysqli_query($conn,$sql);

header("Location: login.php");
exit();

}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Signup</title>
<link rel="stylesheet" href="assets/css/signup.css">
   <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>

<header class="navbar">
  <div class="nav-logo">City Care Hospital</div>
  <nav>
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="doctor.php">Doctors</a>
    <a href="contact.php">Contact</a>
    <a href="medicines.php">Medical</a>
  </nav>
  <a href="#" class="nav-btn">Book Appointment</a>
</header>

<body>
<div class="signup-container">

<h2>Signup Form</h2>

<form method="POST" class="form-grid">

<div>
<label>Username</label>
<input type="text" name="username" required>
</div>

<div>
<label>Email</label>
<input type="email" name="email" required>
</div>

<div>
<label>Password</label>
<input type="password" name="password" required>
</div>

<div>
<label>Age</label>
<input type="number" name="age">
</div>

<div>
<label>Address</label>
<input type="text" name="address">
</div>

<div>
<label>Phone</label>
<input type="text" name="phone">
</div>

<div>
<label>Role</label>
<select name="role" id="role" onchange="checkRole()">
<option value="patient">Patient</option>
<option value="doctor">Doctor</option>
</select>

<div id="doctorCodeBox" style="display:none;">

<label>Doctor Secret Code</label>
<input type="password" name="doctor_code" placeholder="Enter Doctor Code">

</div>


<button type="submit" name="signup">Sign Up</button>

</form>

</div>
<script>

function checkRole(){

var role = document.getElementById("role").value;
var codeBox = document.getElementById("doctorCodeBox");

if(role === "doctor"){
    codeBox.style.display = "block";
}else{
    codeBox.style.display = "none";
}

}

</script>
</body>
</html>