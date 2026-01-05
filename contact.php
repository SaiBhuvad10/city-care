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

    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Sidebar -->
<?php include 'includes/header.php'; ?>

    <!-- Main Content -->
    <div class="main-content">

        <h1>Contact Us</h1>

        <section class="contact-section">
            <div class="contact-container">

                <!-- Contact Info -->
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 123 City Care Street, YourCity, Country</p>
                    <p><i class="fas fa-phone-alt"></i> +91 98765 43210</p>
                    <p><i class="fas fa-envelope"></i> info@citycarehospital.com</p>
                    <p><i class="fas fa-clock"></i> Mon - Sat: 8:00 AM - 8:00 PM</p>

                    <!-- Contact Form -->
                    <form action="contact_submit.php" method="POST" class="contact-form">
                        <input type="text" name="name" placeholder="Your Name" required>
                        <input type="email" name="email" placeholder="Your Email" required>
                        <input type="text" name="phone" placeholder="Phone Number" required>
                        <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                        <button type="submit" class="btn">Send Message</button>
                    </form>
                </div>

                <!-- Google Map -->
                <div class="contact-map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.900264612285!2d90.39185741536376!3d23.750903184590146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bf3b6f7e2b1d%3A0x4e41ab7ebf0f4c53!2sHospital!5e0!3m2!1sen!2sin!4v1577839999999!5m2!1sen!2sin" 
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>

            </div>
        </section>

    </div> <!-- main-content -->

</body>
</html>
