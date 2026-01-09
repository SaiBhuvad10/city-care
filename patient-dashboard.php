<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "patient") {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$patient = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Roboto', sans-serif;
            background: #f4f6fb;
            margin:0;
        }
        .header{
            background:#2563eb;
            color:white;
            padding:20px;
            text-align:center;
            font-size:22px;
            font-weight:bold;
            box-shadow:0 4px 6px rgba(0,0,0,0.1);
        }
        .container{
            max-width:1200px;
            margin:30px auto;
            padding:0 20px;
        }
        .welcome{
            margin-bottom:30px;
        }
        .cards{
            display:grid;
            grid-template-columns: repeat(auto-fit,minmax(250px,1fr));
            gap:20px;
        }
        .card{
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 6px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover{
            transform: translateY(-5px);
            box-shadow:0 10px 20px rgba(0,0,0,0.15);
        }
        .card h3{
            margin-top:0;
            color:#2563eb;
        }
        .card p{
            font-size:16px;
            margin:8px 0;
        }
        .logout{
            display:inline-block;
            padding:10px 20px;
            background:#ef4444;
            color:white;
            border-radius:5px;
            text-decoration:none;
            margin-top:20px;
        }
        /* Animations for stats numbers */
        .stat-number{
            font-size:28px;
            font-weight:bold;
            color:#2563eb;
            animation: fadeIn 1s ease forwards;
        }
        @keyframes fadeIn{
            from{opacity:0; transform:translateY(10px);}
            to{opacity:1; transform:translateY(0);}
        }
    </style>
</head>
<body>

<div class="header">
    Nanavati Patient Dashboard
</div>

<div class="container">
    <div class="welcome">
        <h2>Welcome, <?php echo $patient['username']; ?>!</h2>
        <p>Email: <?php echo $patient['email']; ?></p>
        <p>Phone: <?php echo $patient['phone']; ?></p>
        <a class="logout" href="logout.php">Logout</a>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Appointments</h3>
            <p class="stat-number">3</p>
            <p>Upcoming Appointments</p>
        </div>
        <div class="card">
            <h3>Medical Records</h3>
            <p class="stat-number">12</p>
            <p>Previous Visits</p>
        </div>
        <div class="card">
            <h3>Prescriptions</h3>
            <p class="stat-number">5</p>
            <p>Active Prescriptions</p>
        </div>
        <div class="card">
            <h3>Notifications</h3>
            <p class="stat-number">2</p>
            <p>New Alerts</p>
        </div>
    </div>
</div>

</body>
</html>
