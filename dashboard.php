<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
        }
        .container {
            padding: 30px;
        }
        .card {
            background: #0f4c81;
            color: white;
            padding: 20px;
            width: 250px;
            margin: 15px;
            display: inline-block;
            border-radius: 10px;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 10px 15px;
            background: #0f4c81;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background: #09375f;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Admin Dashboard</h2>

    <div class="card">
        <h3>Patients</h3>
        <p>Manage patient records</p>
    </div>

    <div class="card">
        <h3>Doctors</h3>
        <p>Manage doctors</p>
    </div>

    <div class="card">
        <h3>Appointments</h3>
        <p>Manage appointments</p>
    </div>

    <br><br>

    <a href="add_patient.php">Add Patient</a>
    <a href="view_patients.php">View Patients</a>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>
