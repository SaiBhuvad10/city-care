<?php
session_start();
include 'db.php';

/* Doctor-only access */
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'doctor') {
    header("Location: login.php");
    exit();
}

/* Doctor name from session */
$doctor_name = $_SESSION['user'] ?? 'Doctor';
$query = "SELECT * FROM appointments WHERE doctor_name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $doctor_name);
$stmt->execute();
$result = $stmt->get_result();

?>
<?php include 'includes/header.php'; ?>
<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Doctors | CityCare</title>
    <link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/doctor.css">

</head>
<body>

<h2 class="page-title">Our Doctors</h2>

<div class="doctors-container">

    <!-- Doctor Card -->
    <div class="doctor-card">
        <img src="images/doctor1.jpg" alt="Dr Alan Almeida">
        <div class="doctor-info">
            <h3>Dr. Alan Almeida</h3>
            <span>Section Head – Nephrology</span>
            <p>
                Consultant Nephrologist<br>
                MBBS, MD, MNAMS<br>
                Fellow – Indian Society of Nephrology
            </p>
            <a href="appointment.php" class="btn">Book Appointment</a>
        </div>
    </div>

    <!-- Doctor Card -->
    <div class="doctor-card">
        <img src="images/doctor2.jpg" alt="Dr Amitav Shukla">
        <div class="doctor-info">
            <h3>Dr. Elly </h3>
            <span>Head – ENT Department</span>
            <p>
                ENT Surgeon<br>
                MS, DLO, FRCS (ENT)<br>
                Royal College of Surgeons (UK)
            </p>
            <a href="appointment.php" class="btn">Book Appointment</a>
        </div>
    </div>

    <!-- Doctor Card -->
    <div class="doctor-card">
        <img src="images/doctor3.jpg" alt="Dr Anita Bhaduri">
        <div class="doctor-info">
            <h3>Dr. Rohan Shukla</h3>
             <span>Orthopedics</span>
            <p>MS, DNB - Joint & Bone Specialist</p>
            <a href="appointment.php" class="btn">Book Appointment</a>
        </div>
    </div>

    <!-- Doctor Card -->
    <div class="doctor-card">
        <img src="images/doctor5.jpg" alt="Dr Rakesh Jain">
        <div class="doctor-info">
            <h3>Dr. Rakesh Jain</h3>
            <span>Cardiology</span>
            <p>MBBS, MD, DM - Senior Cardiologist, Heart Specialist</p>
            <a href="appointment.php" class="btn">Book Appointment</a>
        </div>
    </div>

    <!-- Doctor Card -->
    <div class="doctor-card">
        <img src="images/doctor4.jpg" alt="Dr Shewta Shinde">
        <div class="doctor-info">
            <h3>Dr. Shewta Shinde</h3>
            <span>Dermatology</span>
            <p>MBBS, MD - Skin & Cosmetic Specialist</p>
            <a href="appointment.php" class="btn">Book Appointment</a>
        </div>
    </div>

     <!-- Doctor 7 -->
    <div class="doctor-card">
        <img src="images/doctor6.jpg" alt="Dr Sneha Reddy">
        <div class="doctor-info">
            <h3>Dr. Sneha Reddy</h3>
            <span>Pediatrics</span>
            <p>MBBS, MD - Child Health Specialist</p>
            <a href="#" class="btn">Book Appointment</a>
        </div>
    </div>

</div>

</body>
</html>
