<?php
header('Content-Type: application/json');

$secretKey = 'sk_test_Z1uRQ7sjBBdW7q2auivmS1PL';

if (!isset($_GET['payment_id'])) {
    echo json_encode(['error' => 'Payment ID not provided']);
    exit;
}

$paymentId = $_GET['payment_id'];

// Initialize cURL
$ch = curl_init("https://api.paymongo.com/v1/links/{$paymentId}");

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Authorization: Basic ' . base64_encode($secretKey . ':')
]);

// Execute the request
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(['error' => curl_error($ch)]);
    exit;
}

curl_close($ch);

// Parse the response
$responseData = json_decode($response, true);

if (isset($responseData['data']['attributes']['status'])) {
    $status = $responseData['data']['attributes']['status'];
    
    // Check if the payment is paid
    if ($status === 'paid') {
        echo json_encode(['status' => 'paid']);
    } else {
        echo json_encode(['status' => 'unpaid']);
    }
} else {
    echo json_encode(['error' => 'Unable to determine payment status']);
}
?>
