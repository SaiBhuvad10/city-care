<?php
$source = 'C:\Users\Sai Bhuvad\.gemini\antigravity\brain\4013660b-b762-4ae4-993a-eb7cbf1d4cff\dr_sarah_1775316070498.png';
$dest_dir = 'd:\xampp\htdocs\city-care\images';
$dest_file = $dest_dir . '\dr_sarah.png';

if (!file_exists($dest_dir)) {
    if(!mkdir($dest_dir, 0777, true)) {
        die("Failed to create directory.");
    }
}

if(copy($source, $dest_file)) {
    echo "Copied successfully! ";
    require 'db_connect.php';
    if ($conn->query("UPDATE doctors SET image_url = 'images/dr_sarah.png' WHERE name LIKE '%Sarah Johnson%'")) {
        echo "Database updated!";
    } else {
        echo "DB Error: " . $conn->error;
    }
} else {
    echo "Failed to copy image from source path.";
}
?>
