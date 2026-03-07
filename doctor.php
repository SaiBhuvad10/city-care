<?php
session_start();
include 'db.php';



/* Doctor name from session */
$doctor_name = $_SESSION['user'] ?? 'Doctor';
$query = "SELECT * FROM appointments WHERE doctor_name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $doctor_name);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Doctors | City Care Hospital</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/doctor.css">
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

   

    <section class="doctors-section">
        <div class="doctors-container">
            <div class="doctors-grid">
                
                <div class="doctor-card">
                    <div class="dr-img-container">
                        <img src="images/doctor1.jpg" alt="Dr. Alan Almeida">
                    </div>
                    <h3>Dr. Alan Almeida</h3>
                    <p class="specialty">Section Head – Nephrology</p>
                    <p class="details">Consultant Nephrologist<br>MBBS, MD, MNAMS<br>Fellow – Indian Society of Nephrology</p>
                    <a href="appointment.php" class="btn-card-book">Book Appointment</a>
                </div>

                <div class="doctor-card">
                    <div class="dr-img-container">
                        <img src="images/doctor2.jpg" alt="Dr. Elly">
                    </div>
                    <h3>Dr. Elly</h3>
                    <p class="specialty">Head – ENT Department</p>
                    <p class="details">ENT Surgeon<br>MS, DLO, FRCS (ENT)<br>Royal College of Surgeons (UK)</p>
                    <a href="appointment.php" class="btn-card-book">Book Appointment</a>
                </div>

                <div class="doctor-card">
                    <div class="dr-img-container">
                        <img src="images/doctor3.jpg" alt="Dr. Rohan Shukla">
                    </div>
                    <h3>Dr. John Rizz</h3>
                    <p class="specialty">Orthopedics</p>
                    <p class="details">MS, DNB - Joint & Bone Specialist</p>
                    <a href="appointment.php" class="btn-card-book">Book Appointment</a>
                </div>

                <div class="doctor-card">
                    <div class="dr-img-container">
                        <img src="images/doctor4.jpg" alt="Dr. Sneha Shinde">
                    </div>
                    <h3>Dr. Sneha Shinde</h3>
                    <p class="specialty">Cardiology</p>
                    <p class="details">MBBS, MD, DM - Senior Cardiologist,<br>Heart Specialist</p>
                    <a href="appointment.php" class="btn-card-book">Book Appointment</a>
                </div>

                <div class="doctor-card">
                    <div class="dr-img-container">
                        <img src="images/doctor5.jpg" alt="Dr. Rakesh Jain">
                    </div>
                    <h3>Dr. Ramesh Jain</h3>
                    <p class="specialty">Dermatology</p>
                    <p class="details">MBBS, MD - Skin & Cosmetic<br>Specialist</p>
                    <a href="appointment.php" class="btn-card-book">Book Appointment</a>
                </div>

                <div class="doctor-card">
                    <div class="dr-img-container">
                        <img src="images/doctor6.jpg" alt="Dr. Sneha Reddy">
                    </div>
                    <h3>Dr. Riddhi Reddy</h3>
                    <p class="specialty">Pediatrics</p>
                    <p class="details">MBBS, MD - Child Health Specialist</p>
                    <a href="appointment.php" class="btn-card-book">Book Appointment</a>
                </div>

            </div>
        </div>
    </section>

</body>
</html>