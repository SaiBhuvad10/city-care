<?php
session_start();
include "db.php";

$error = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 1) {

        $row = mysqli_fetch_assoc($res);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];

        if ($row['role'] == "patient") {
            header("Location: patient-dashboard.php");
            exit();
        }

        if ($row['role'] == "doctor") {
            header("Location: doctor-dashboard.php");
            exit();
        }

    } else {
        $error = "Invalid email or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body{
            background:#f4f6fb;
            font-family:Arial;
        }
        .box{
            width:350px;
            margin:100px auto;
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0 10px 20px rgba(0,0,0,0.1);
        }
        input{
            width:100%;
            padding:10px;
            margin-bottom:15px;
        }
        button{
            width:100%;
            padding:10px;
            background:#2563eb;
            border:none;
            color:white;
            cursor:pointer;
        }
        .err{
            color:red;
            text-align:center;
            margin-bottom:10px;
        }
    </style>
    <link rel="stylesheet" href="assets/css/main.css">
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
    <a href="treatments.php">Treatments</a>
  </nav>
  <a href="#" class="nav-btn">Book Appointment</a>
</header>

<div class="box">
    <h2>Login</h2>

    <?php if($error!=""){ ?>
        <div class="err"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>
