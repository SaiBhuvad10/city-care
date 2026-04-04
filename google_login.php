<?php
// Replace with your actual Google Client ID
include 'secrets.php';
$client_id = $google_client_id;
$redirect_uri = 'http://localhost/city-care/google_callback.php';
$scope = 'email profile';

$login_url = 'https://accounts.google.com/o/oauth2/v2/auth?response_type=code&client_id=' . urlencode($client_id) . '&redirect_uri=' . urlencode($redirect_uri) . '&scope=' . urlencode($scope);
header('Location: ' . $login_url);
exit();
?>
