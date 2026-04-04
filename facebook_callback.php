<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'db_connect.php';

// IMPORTANT: Replace these with your actual Facebook API credentials
$app_id = 'YOUR_FACEBOOK_APP_ID';
$app_secret = 'YOUR_FACEBOOK_APP_SECRET';
$redirect_uri = 'http://localhost/city-care/facebook_callback.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];
    
    // Exchange code for token
    $token_url = "https://graph.facebook.com/v16.0/oauth/access_token?client_id={$app_id}&redirect_uri=" . urlencode($redirect_uri) . "&client_secret={$app_secret}&code={$code}";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $token_data = json_decode($response, true);
    
    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];
        
        // Get user profile info
        $profile_url = "https://graph.facebook.com/me?fields=id,name,email&access_token={$access_token}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $profile_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $profile_response = curl_exec($ch);
        curl_close($ch);
        
        $user_info = json_decode($profile_response, true);
        
        if (isset($user_info['id'])) {
            $oauth_uid = $user_info['id'];
            // Facebook accounts sometimes don't have emails attached, fallback if missing
            $email = $user_info['email'] ?? "fb_{$oauth_uid}@facebook.local"; 
            $full_name = $user_info['name'] ?? 'Facebook User';
            $oauth_provider = 'facebook';
            
            // Check if user exists
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
                // Try checking email (skip if using fallback email)
                if(strpos($email, '@facebook.local') === false) {
                    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $email_check = $stmt->get_result();
                    
                    if ($email_check->num_rows > 0) {
                         die("<div style='padding:20px; font-family:sans-serif;'>This email is already registered using a standard password. Please log in normally.</div>");
                    }
                }
                
                // Register new user
                $stmt = $conn->prepare("INSERT INTO users (full_name, email, oauth_provider, oauth_uid) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $full_name, $email, $oauth_provider, $oauth_uid);
                $stmt->execute();
                
                $_SESSION['user_id'] = $conn->insert_id;
                $_SESSION['user_name'] = $full_name;
            }
            header("Location: my_appointments.php");
            exit();
        }
    }
}

// Fallback message if something failed
die("<div style='padding:20px; font-family:sans-serif;'>Facebook Authentication Failed. Ensure API keys are correct. <a href='login.php'>Return to login</a></div>");
?>
