<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Security Check: strictly admin only
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    die("Access Denied: You do not have permission to perform this action.");
}

include 'db_connect.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $appointment_id = (int)$_GET['id'];
    $action = $_GET['action'];
    
    if ($action === 'delete') {
        $stmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
        $stmt->bind_param("i", $appointment_id);
        
        if ($stmt->execute()) {
            header("Location: admin_dashboard.php?success=deleted");
            exit();
        } else {
            die("Database error. Failed to delete appointment.");
        }
    } else {
        $new_status = "";
        if ($action === 'confirm') {
            $new_status = "Confirmed";
        } elseif ($action === 'cancel') {
            $new_status = "Cancelled";
        } else {
            die("Invalid action.");
        }
        
        $stmt = $conn->prepare("UPDATE appointments SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $new_status, $appointment_id);
        
        if ($stmt->execute()) {
            header("Location: admin_dashboard.php?success=1");
            exit();
        } else {
            die("Database error. Failed to update status.");
        }
    }
} else {
    header("Location: admin_dashboard.php");
    exit();
}
?>
