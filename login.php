<?php
session_start();
include 'db.php';

$error = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, email, password, role FROM users WHERE email=? AND password=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("SQL PREPARE FAILED: " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        $_SESSION['user'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'doctor') {
            header("Location: doctor.php");
            exit();
        } else {
            header("Location: patient.php");
            exit();
        }
    } else {
        $error = "Invalid email or password";
    }
}
?>
<?php include 'includes/header.php'; ?>



<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
         body {
    font-family: Arial;
    background: #4682B4;
    margin: 0;
}

    </style>
</head>
<body>
<div class="page-container">    
<div class="container">
    <h2>Login</h2>
    <?php if($error != "") echo "<div class='error'>$error</div>"; ?>
    <form method="post" action="">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>

    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
