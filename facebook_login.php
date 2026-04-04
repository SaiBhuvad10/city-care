<?php
// Replace with your actual Facebook App ID
$app_id = 'YOUR_FACEBOOK_APP_ID';
$redirect_uri = 'http://localhost/city-care/facebook_callback.php';
$scope = 'email,public_profile';

$login_url = 'https://www.facebook.com/v16.0/dialog/oauth?client_id=' . urlencode($app_id) . '&redirect_uri=' . urlencode($redirect_uri) . '&scope=' . urlencode($scope);
header('Location: ' . $login_url);
exit();
?>
