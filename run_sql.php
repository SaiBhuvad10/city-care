<?php
require 'db_connect.php';

// Create messages table
$sql1 = "CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_id INT NOT NULL,
    receiver_id INT DEFAULT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_read BOOLEAN DEFAULT FALSE
)";
if ($conn->query($sql1)) {
    echo "messages table created.\n";
} else {
    echo "Error creating messages: " . $conn->error . "\n";
}

// Alter appointments table
$sql2 = "ALTER TABLE appointments ADD meeting_type VARCHAR(50) DEFAULT 'In-Person'";
if ($conn->query($sql2)) {
    echo "meeting_type added.\n";
} else {
    echo "meeting_type error (or already exists): " . $conn->error . "\n";
}

$sql3 = "ALTER TABLE appointments ADD meeting_link VARCHAR(255) DEFAULT NULL";
if ($conn->query($sql3)) {
    echo "meeting_link added.\n";
} else {
    echo "meeting_link error (or already exists): " . $conn->error . "\n";
}
?>
