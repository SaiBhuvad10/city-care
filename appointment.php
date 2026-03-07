<?php
include 'db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = $_POST['patient_name'];
    $doctor_name  = $_POST['doctor_name'];
    $date         = $_POST['date'];
    $time         = $_POST['time'];

    $query = "INSERT INTO appointments 
              (patient_name, doctor_name, date, time, status)
              VALUES (?, ?, ?, ?, 'Pending')";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $patient_name, $doctor_name, $date, $time);
    $stmt->execute();

    $success = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body{
            margin:0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg,#1e90ff,#6dd5fa);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .card{
            background:whitesmoke;
            width:950px;
            padding:30px;
            border-radius:25px;
            box-shadow:0 15px 40px rgba(0,0,0,0.2);
            animation:fadeIn 0.8s ease;
        }
        @keyframes fadeIn{
            from{opacity:0; transform:translateY(30px);}
            to{opacity:1; transform:translateY(0);}
        }
        .card h2{
            text-align:center;
            color:#1e90ff;
            margin-bottom:25px;
        }
        .input-group{
            margin-bottom:15px;
        }
        .input-group label{
            font-size:14px;
            color:#555;
        }
        .input-group i{
            color:#1e90ff;
            margin-right:8px;
        }
        .input-group input{
            width:100%;
            padding:10px;
            border:1px solid #ccc;
            border-radius:8px;
            outline:none;
            margin-top:5px;
        }
        .input-group input:focus{
            border-color:#1e90ff;
        }
        button{
            width:100%;
            padding:12px;
            border:none;
            border-radius:10px;
            background:#1e90ff;
            color:#fff;
            font-size:16px;
            cursor:pointer;
            transition:0.3s;
        }
        button:hover{
            background:#0b6fd6;
            transform:translateY(-2px);
        }
        .success{
            background:#e8fff1;
            color:#0a7d3b;
            padding:10px;
            border-radius:8px;
            text-align:center;
            margin-bottom:15px;
        }
    </style>
    <link rel="stylesheet" href="/hospital.mng/assets/css/main.css">
</head>
<body>

    <!-- NAVBAR -->
<header class="navbar">
  <div class="nav-logo">City Care Hospital</div>
  <nav>
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="doctor.php">Doctors</a>
    <a href="contact.php">Contact</a>
    <a href="medicines.php">Medical</a>
    <a href="treatments.php">Treatments</a>
  </nav>
  <a href="#" class="nav-btn">Book Appointment</a>
</header>

    <div class="main-wrapper">
<div class="card">
    <h2><i class="fa-solid fa-calendar-check"></i> Book Appointment</h2>

    <?php if(!empty($success)): ?>
        <div class="success">
            <i class="fa-solid fa-circle-check"></i> Appointment Booked Successfully
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="input-group">
            <label><i class="fa-solid fa-user"></i> Patient Name</label>
            <input type="text" name="patient_name" required>
        </div>

        <div class="input-group">
            <label><i class="fa-solid fa-user-doctor"></i> Doctor Username</label>
            <input type="text" name="doctor_name" placeholder="doctor1" required>
        </div>

        <div class="input-group">
            <label><i class="fa-solid fa-calendar"></i> Date</label>
            <input type="date" name="date" required>
        </div>

        <div class="input-group">
            <label><i class="fa-solid fa-clock"></i> Time</label>
            <input type="time" name="time" required>
        </div>

        <button type="submit">
            <i class="fa-solid fa-paper-plane"></i> Confirm Appointment
        </button>
    </form>
</div>

</body>
</html>
