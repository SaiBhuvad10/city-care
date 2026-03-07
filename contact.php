<?php
// contact.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - City Care Hospital</title>
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/contact.css">
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
  <a href="appointment.php" class="nav-btn">Book Appointment</a>
</header>

    <section class="contact-page-wrapper">
        <div class="container">
            <div class="contact-box-container">
                <div class="contact-flex">
                    
                    <div class="contact-info-side">
                        <h2 class="section-title">Get in Touch</h2>
                        
                        <div class="details-list">
                            <div class="detail-item">
                                <strong>Address:</strong>
                                <p>123 City Care Street, Mumbai, India</p>
                            </div>
                            <div class="detail-item">
                                <strong>Phone:</strong>
                                <p>+91 98765 43210</p>
                            </div>
                            <div class="detail-item">
                                <strong>Email:</strong>
                                <p>info@citycarehospital.com</p>
                            </div>
                            <div class="detail-item">
                                <strong>Working Hours:</strong>
                                <p>Mon – Sat: 8:00 AM – 8:00 PM</p>
                            </div>
                        </div>

                        <form action="#" class="contact-form">
                            <input type="text" placeholder="Full Name" required>
                            <input type="email" placeholder="Email Address" required>
                            <input type="tel" placeholder="Phone Number">
                            <textarea placeholder="Your Message" rows="4"></textarea>
                            <button type="submit" class="btn-submit">Send Message</button>
                        </form>
                    </div>

                    <div class="map-side">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d120610.96342898956!2d72.825764!3d19.14194!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b802611e9f19%3A0x633d3d65b7f7397b!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>

                </div>
            </div>
        </div>
    </section>

</body>
</html>