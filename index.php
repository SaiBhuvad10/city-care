<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Management System</title>
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<?php include 'includes/sidebar.php'; ?>

<div class="main-content">

    <!-- TOP CONTENT -->
    <section class="welcome-box">
        <h1>City Care Hospital</h1>
        <p>Advanced care with experienced doctors</p>
    </section>

    <!-- AUTO SLIDER -->
    <section class="slider">
        <div class="slides">
            <div class="slide">
                <img src="images/doctors.jpg">
                <h2>Best Doctors</h2>
            </div>
            <div class="slide">
                <img src="images/hospital.jpg">
                <h2>Why We Are Best</h2>
            </div>
            <div class="slide">
                <img src="assets/images/patient.jpg">
                <h2>10000+ Satisfied Patients</h2>
            </div>
        </div>
    </section>

    <!-- SERVICES -->
   <section class="services">
    <h2>Our Services</h2>
    <p class="service-sub">High quality medical services with modern technology</p>

    <div class="service-box">

        <div class="service-card">
            <i class="fa-solid fa-truck-medical"></i>
            <h3>24/7 Emergency</h3>
            <p>Immediate care with advanced emergency facilities and expert staff.</p>
        </div>

        <div class="service-card">
            <i class="fa-solid fa-user-doctor"></i>
            <h3>Qualified Doctors</h3>
            <p>Highly experienced doctors across all medical specializations.</p>
        </div>

        <div class="service-card">
            <i class="fa-solid fa-microscope"></i>
            <h3>Modern Equipment</h3>
            <p>Latest diagnostic and surgical equipment for accurate treatment.</p>
        </div>

        <div class="service-card">
            <i class="fa-solid fa-calendar-check"></i>
            <h3>Online Appointment</h3>
            <p>Book doctor appointments easily from anywhere anytime.</p>
        </div>

        <div class="service-card">
            <i class="fas fa-heartbeat"></i>
            <h3>Cardiology</h3>
            <p>Heart care and cardiac treatments</p>
        </div>
        <div class="service-card">
            <i class="fas fa-x-ray"></i>
            <h3>Radiology</h3>
            <p>Advanced imaging and diagnostics</p>
        </div>
        <div class="service-card">
            <i class="fas fa-stethoscope"></i>
            <h3>General Surgery</h3>
            <p>Expert surgical treatments</p>
        </div>
    </div>
</section>


</div>

<script>
let index = 0;
const slides = document.querySelector(".slides");

setInterval(() => {
    index = (index + 1) % 3;
    slides.style.transform = `translateX(-${index * 100}%)`;
}, 3000);
</script>

</body>
</html>
