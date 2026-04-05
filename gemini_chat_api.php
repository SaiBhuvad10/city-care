<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);
$user_message = $input['message'] ?? '';

if (empty($user_message)) {
    http_response_code(400);
    echo json_encode(['error' => 'Message is required']);
    exit();
}

include 'secrets.php';

if (!isset($gemini_api_key) || empty($gemini_api_key)) {
    http_response_code(500);
    echo json_encode(['error' => 'API Key not configured']);
    exit();
}

// System instructions to guide Gemini's persona
$system_instruction = "You are the virtual assistant for City Care Hospital. You are polite, highly professional, and very concise. Your answers should be brief. Use basic HTML tags like <strong>, <br>, <ul>, <li> if needed for formatting, but do NOT use pure markdown (like **bold** or *italic*). Treat links literally with <a href='...'>.\n\nKey Information about the hospital:\n- Address: 123 Medical Plaza, Health City, HC 45678\n- Emergency: Open 24/7. Call 911 immediately for severe emergencies or contact +1 (555) 123-4567.\n- Regular Hours: Monday to Saturday, 9:00 AM to 5:00 PM.\n- Services: Cardiology, Neurology, Pediatrics, Orthopedics, Emergency Care.\n- Online bookings can be made from the <a href='doctors.php'>Doctors</a> page.\n- Admin/Patient secure interactions occur within the 'Patient Messages' dashboard for registered users.";

// Gemini API URL
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $gemini_api_key;

// Construct the JSON payload
$data = [
    "system_instruction" => [
        "parts" => [
            ["text" => $system_instruction]
        ]
    ],
    "contents" => [
        [
            "parts" => [
                ["text" => $user_message]
            ]
        ]
    ],
    "generationConfig" => [
        "temperature" => 0.2, // Low temperature for more factual, standardized responses
        "maxOutputTokens" => 250 // Keep responses brief exactly like a chat bot
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => 'cURL error: ' . curl_error($ch)]);
    curl_close($ch);
    exit();
}
curl_close($ch);

if ($http_code !== 200) {
    http_response_code(500);
    $err_details = json_decode($response, true);
    echo json_encode(['error' => 'API Error', 'details' => $err_details]);
    exit();
}

$decoded_response = json_decode($response, true);
$reply_text = "I'm sorry, I couldn't process that request at this time.";

// Extract the response text safely
if (isset($decoded_response['candidates'][0]['content']['parts'][0]['text'])) {
    $reply_text = $decoded_response['candidates'][0]['content']['parts'][0]['text'];
}

echo json_encode(['reply' => $reply_text]);
?>
