<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'db_connect.php';

// IMPORTANT: Replace these with your actual Google API credentials
// Do not hardcode these values in a public repository!
$client_id = 'YOUR_GOOGLE_CLIENT_ID';
$client_secret = 'YOUR_GOOGLE_CLIENT_SECRET';
$redirect_uri = 'http://localhost/city-care/google_callback.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    
    // Exchange code for token
    $token_url = 'https://oauth2.googleapis.com/token';
    $data = [
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code'
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $token_data = json_decode($response, true);
    
    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];
        
        // Get user profile info
        $profile_url = 'https://www.googleapis.com/oauth2/v2/userinfo';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $profile_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $access_token]);
        $profile_response = curl_exec($ch);
        curl_close($ch);
        
        $user_info = json_decode($profile_response, true);
        
        if (isset($user_info['id']) && isset($user_info['email'])) {
            $oauth_uid = $user_info['id'];
            $email = $user_info['email'];
            $full_name = $user_info['name'] ?? 'Google User';
            $oauth_provider = 'google';
            
            // Try to find an existing user using Google OAuth
            $stmt = $conn->prepare("SELECT id, full_name FROM users WHERE oauth_uid = ? AND oauth_provider = ?");
            $stmt->bind_param("ss", $oauth_uid, $oauth_provider);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Login existing user
                $row = $result->fetch_assoc();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['full_name'];
            } else {
                // If OAuth user doesn't exist, check standard email just in case
                $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $email_check = $stmt->get_result();
                
                if ($email_check->num_rows > 0) {
                    die("<div style='padding:20px; font-family:sans-serif;'>This email is already registered using a standard password. Please log in normally.</div>");
                } else {
                    // Register new user seamlessly
                    $stmt = $conn->prepare("INSERT INTO users (full_name, email, oauth_provider, oauth_uid) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $full_name, $email, $oauth_provider, $oauth_uid);
                    $stmt->execute();
                    
                    $_SESSION['user_id'] = $conn->insert_id;
                    $_SESSION['user_name'] = $full_name;
                }
            }
            header("Location: my_appointments.php");
            exit();
        }
    }
}

// Fallback message if something failed
die("<div style='padding:20px; font-family:sans-serif;'>Google Authentication Failed. Ensure API keys are correct. <a href='login.php'>Return to login</a></div>");
?>
