<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Section | City Care Hospital</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/medicines.css">
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


    <section class="medical-section">
        <div class="medical-wrapper">
            
            <div class="category-block">
                <h2 class="category-title">Tablets</h2>
                <div class="product-grid">
                    
                    <div class="product-card">
                        <img src="https://via.placeholder.com/80" alt="Paracetamol">
                        <h3>Paracetamol</h3>
                        <p>Fever & pain relief</p>
                        <span class="price-tag">₹20</span>
                    </div>

                    <div class="product-card">
                        <img src="https://via.placeholder.com/80" alt="Ibuprofen">
                        <h3>Ibuprofen</h3>
                        <p>Pain & inflammation</p>
                        <span class="price-tag">₹45</span>
                    </div>

                    <div class="product-card">
                        <img src="https://via.placeholder.com/80" alt="Aspirin">
                        <h3>Aspirin</h3>
                        <p>Pain relief & blood thinner</p>
                        <span class="price-tag">₹30</span>
                    </div>

                    <div class="product-card">
                        <img src="https://via.placeholder.com/80" alt="Metformin">
                        <h3>Metformin</h3>
                        <p>Diabetes control</p>
                        <span class="price-tag">₹60</span>
                    </div>

                    <div class="product-card">
                        <img src="https://via.placeholder.com/80" alt="Amlodipine">
                        <h3>Amlodipine</h3>
                        <p>Blood pressure control</p>
                        <span class="price-tag">₹55</span>
                    </div>

                </div>
            </div>

            <div class="category-block">
                <h2 class="category-title">Syrups</h2>
                <div class="product-grid">
                    <div class="product-card">
                        <img src="https://via.placeholder.com/80" alt="Cough Syrup">
                        <h3>Cough Syrup</h3>
                        <p>Relief from dry cough</p>
                        <span class="price-tag">₹120</span>
                    </div>
                    </div>
            </div>

        </div>
    </section>

</body>
</html>