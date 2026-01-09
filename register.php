<?php
include 'db.php';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // show SQL errors

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // hash password
    $age      = $_POST['age'];
    $address  = $_POST['address'];
    $phone    = $_POST['phone'];
    $role = $_POST['role']; // doctor or patient

    // Default doctor_id to NULL
    $doctor_id = NULL;

    // If user selected Doctor, verify doctor key
    if($role === 'doctor') {
        $doctor_key_input = $_POST['doctor_key'] ?? '';
        $SECRET_KEY = "MYSECRET123"; // only real doctors know this

        if($doctor_key_input !== $SECRET_KEY){
            $error = "Invalid Doctor Key! Only real doctors can register as doctor.";
        } else {
            // Generate unique doctor ID
            $doctor_id = 'DR' . rand(1000, 9999);
        }
    } else {
        // Role = patient, generate patient ID if needed (optional)
        $patient_id = 'PT' . rand(1000,9999); 
        // You can store patient_id in another column if needed
    }

    // If no error, insert user
    if($error === "") {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();

        if($res->num_rows > 0){
            $error = "Email already registered!";
        } else {
            // Insert into database
           $stmt = $conn->prepare("INSERT INTO users (username, email, password, age, address, phone, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $username, $email, $password, $age, $address, $phone, $role);
            if($stmt->execute()){
                // Redirect to login after successful registration
                header("Location: login.php");
                exit();
            } else {
                $error = "Failed to register user: " . $stmt->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { font-family: Arial; background:linear-gradient(200deg, royalblue);; display:flex; justify-content:center; align-items:center; height:100vh; margin:5; }
        .container { background:whitesmoke; padding:20px 90px; border-radius:10px; width:1000px; text-align:center; box-shadow:0 8px 20px rgba(0,0,0,0.2); }
        h2 { margin-bottom: 30px; color: #333; }
        input { width:100%; padding:12px; margin:10px 0; border:1px solid #ccc; border-radius:5px; font-size:16px; }
        button { width:100%; padding:12px; background:#4682B4; border:none; color:#fff; font-size:16px; border-radius:5px; cursor:pointer; margin-top:15px; }
        button:hover { background:#315f8a; }
        p { margin-top:20px; font-size:14px; }
        p a { color:#4682B4; font-weight:bold; text-decoration:none; }
        p a:hover { text-decoration:underline; }
        .error { color:red; margin-bottom:15px; }
    </style>
     <link rel="stylesheet" href="/hospital.mng/assets/css/main.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    <div class="main-wrapper">

<div class="container">
    <h2>Register</h2>
    <?php if($error != "") echo "<div class='error'>$error</div>"; ?>
    
<form method="post" action="register.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="number" name="age" placeholder="Age" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="tel" name="phone" placeholder="Phone Number" required>
     <button type="submit">Register</button>
</form>


    <!-- Step 2: Role Selection -->
    <select name="role" id="role" onchange="toggleDoctorKey()">
        <option value="patient">Patient</option>
        <option value="doctor">Doctor</option>
    </select>

    <!-- Step 3: Doctor Key Input (hidden by default) -->
    <div id="doctorKeyDiv" style="display:none;">
        <input type="text" name="doctor_key" placeholder="Enter Doctor Key">
    </div>

    
</form>

<script>
function toggleDoctorKey(){
    var role = document.getElementById('role').value;
    document.getElementById('doctorKeyDiv').style.display = (role === 'doctor') ? 'block' : 'none';
}
</script>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
