<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'doctor') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$status = $_GET['status'];

$stmt = $conn->prepare("UPDATE appointments SET status=? WHERE id=?");
$stmt->bind_param("si", $status, $id);
$stmt->execute();

header("Location: dr.php");
exit();
