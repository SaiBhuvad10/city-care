<div class="navbar">
  <div class="nav-left">
    <h2>🏥 City Care</h2>
  </div>

  <div class="nav-center">
    <a href="index.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="doctor.php">Doctors</a>
    <a href="medicines.php">Medicines</a>
    <a href="appointment.php">Appointment</a>
    <a href="contact.php">Contact</a>
  </div>

  <div class="nav-right">
    <?php if(isset($_SESSION['user_name'])): ?>
      <span class="user-name">
        <i class="fa fa-user"></i> <?php echo $_SESSION['user_name']; ?>
      </span>
      <a href="logout.php" class="btn-nav">Logout</a>
    <?php else: ?>
      <a href="login.php" class="btn-nav">Login</a>
      <a href="register.php" class="btn-nav outline">Register</a>
    <?php endif; ?>
  </div>
</div>
