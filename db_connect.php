<?php
// Database Configuration
$servername = "127.0.0.1"; // Using IP instead of 'localhost' can sometimes fix Access Denied issues
$username = "root";
$password = ""; // If you set a password for your XAMPP MySQL, enter it here
$dbname = "city_care_db";
$port = 3307;

// Enable error reporting for mysqli to catch exceptions
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create connection to the server first
    // If you get "Access denied", it means your 'root' user has a password.
    // Please update the $password variable above.
    $conn = new mysqli($servername, $username, $password, null, $port);
} catch (mysqli_sql_exception $e) {
    die("<div style='padding: 20px; background: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; border-radius: 12px; font-family: sans-serif; margin: 20px;'>
        <h2 style='margin-top: 0;'>Database Connection Error</h2>
        <p><b>Message:</b> " . $e->getMessage() . "</p>
        <p><b>Tip:</b> In XAMPP, the default password is usually empty (<code>\"\"</code>). If you have set a password for the 'root' user in phpMyAdmin, you must update the <code>\$password</code> variable in <code>db_connect.php</code>.</p>
    </div>");
}

// Select the database
if (!$conn->select_db($dbname)) {
    // If database doesn't exist, try to create it
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        $conn->select_db($dbname);
    } else {
        die("Error creating database: " . $conn->error);
    }
}

// Check if tables exist, if not, create them
$tableExists = $conn->query("SHOW TABLES LIKE 'users'");
if ($tableExists->num_rows == 0) {
    // Users Table
    $conn->query("CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NULL,
        oauth_provider VARCHAR(50) NULL,
        oauth_uid VARCHAR(255) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // Doctors Table
    $conn->query("CREATE TABLE doctors (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        specialty VARCHAR(255) NOT NULL,
        image_url VARCHAR(255),
        experience VARCHAR(50),
        rating DECIMAL(2,1)
    )");

    // Services Table
    $conn->query("CREATE TABLE services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        icon VARCHAR(50)
    )");

    // Insert Sample Data if empty
    $conn->query("INSERT INTO doctors (name, specialty, image_url, experience, rating) VALUES
    ('Dr. Sarah Johnson', 'Cardiologist', 'https://images.pexels.com/photos/5215024/pexels-photo-5215024.jpeg?auto=compress&cs=tinysrgb&w=400', '15 Years', 4.9),
    ('Dr. Michael Chen', 'Neurologist', 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&q=80&w=400', '12 Years', 4.8),
    ('Dr. Emily Rodriguez', 'Pediatrician', 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?auto=format&fit=crop&q=80&w=400', '10 Years', 4.9),
    ('Dr. David Kim', 'Orthopedic Surgeon', 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&q=80&w=400', '18 Years', 4.7),
    ('Dr. Lisa Thompson', 'Oncologist', 'https://images.unsplash.com/photo-1527613426441-4da17471b66d?auto=format&fit=crop&q=80&w=400', '14 Years', 4.9),
    ('Dr. James Wilson', 'Dermatologist', 'https://images.pexels.com/photos/4173239/pexels-photo-4173239.jpeg?auto=compress&cs=tinysrgb&w=400', '9 Years', 4.6)");

    $conn->query("INSERT INTO services (title, description, icon) VALUES
    ('Emergency Care', '24/7 rapid response medical assistance for critical conditions.', 'ambulance'),
    ('Cardiology', 'Comprehensive heart health diagnostics and advanced treatments.', 'heart'),
    ('Neurology', 'Expert care for brain, spine, and nervous system disorders.', 'brain'),
    ('Pediatrics', 'Specialized medical care for infants, children, and adolescents.', 'baby'),
    ('Orthopedics', 'Advanced treatment for bone, joint, and muscle conditions.', 'bone'),
    ('Oncology', 'Personalized cancer treatment plans and compassionate care.', 'microscope')");
} else {
    // If the table exists, make sure the OAuth columns are added
    $checkOAuth = $conn->query("SHOW COLUMNS FROM users LIKE 'oauth_provider'");
    if($checkOAuth->num_rows == 0) {
        $conn->query("ALTER TABLE users 
            MODIFY password VARCHAR(255) NULL,
            ADD oauth_provider VARCHAR(50) NULL AFTER password,
            ADD oauth_uid VARCHAR(255) NULL AFTER oauth_provider");
    }
}

// Add role column and master admin if not exists
$checkRole = $conn->query("SHOW COLUMNS FROM users LIKE 'role'");
if ($checkRole->num_rows == 0) {
    $conn->query("ALTER TABLE users ADD role VARCHAR(20) DEFAULT 'patient' AFTER email");
    
    // Create master admin account
    $admin_password = password_hash("admin123", PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (full_name, email, password, role) 
                  VALUES ('System Admin', 'admin@citycarehospital.com', '$admin_password', 'admin') 
                  ON DUPLICATE KEY UPDATE role='admin'");
}

// Check if appointments table exists
$checkAppointments = $conn->query("SHOW TABLES LIKE 'appointments'");
if($checkAppointments->num_rows == 0) {
    $conn->query("CREATE TABLE appointments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        doctor_id INT NOT NULL,
        appointment_date DATE NOT NULL,
        appointment_time TIME NOT NULL,
        status VARCHAR(50) DEFAULT 'Pending',
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE
    )");
}
?>
