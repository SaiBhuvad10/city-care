<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Doctor Dashboard</title>

    <!-- GLOBAL CSS -->
    <link rel="stylesheet" href="/hospital.mng/assets/css/home.css">
    <link rel="stylesheet" href="/hospital.mng/assets/css/doctor.css">
</head>
<body>

<?php include 'includes/sidebar.php'; ?>

<div class="main-wrapper">

    <div class="doctor-dashboard">

        <!-- DOCTOR PROFILE -->
        <div class="doctor-profile">
            <img src="images/doctor.png" alt="Doctor">
            <div>
                <h2>Welcome, Dr. <?php echo $_SESSION['name'] ?? 'Doctor'; ?></h2>
                <p>Specialization: Cardiologist</p>
                <span class="status online">Online</span>
            </div>
        </div>

        <!-- STATS -->
        <div class="doctor-stats">
            <div class="stat-card">
                <h3>Today</h3>
                <p>5 Appointments</p>
            </div>
            <div class="stat-card">
                <h3>Pending</h3>
                <p>3</p>
            </div>
            <div class="stat-card">
                <h3>Completed</h3>
                <p>12</p>
            </div>
        </div>

        <!-- APPOINTMENTS TABLE -->
        <div class="appointments">
            <h3>Today's Appointments</h3>

            <table>
                <tr>
                    <th>Patient</th>
                    <th>Age</th>
                    <th>Time</th>
                    <th>Problem</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <tr>
                    <td>Rahul Sharma</td>
                    <td>34</td>
                    <td>10:30 AM</td>
                    <td>Chest Pain</td>
                    <td><span class="pending">Pending</span></td>
                    <td>
                        <button class="btn-view">View</button>
                        <button class="btn-done">Done</button>
                    </td>
                </tr>

            </table>
        </div>

    </div>

</div>

</body>
</html>
