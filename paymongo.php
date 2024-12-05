<?php

$secretKey = 'sk_test_Z1uRQ7sjBBdW7q2auivmS1PL';

$data = [
    'data' => [
        'attributes' => [
            'amount' => 30000,
            'currency' => 'PHP',
            'description' => 'Test Payment Link',
            'metadata' => [
                'order_id' => '123456',
            ],
        ],
    ],
];

$ch = curl_init('https://api.paymongo.com/v1/links');

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode($secretKey . ':'),
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(['error' => curl_error($ch)]);
} else {
    $responseData = json_decode($response, true);

    if (isset($responseData['data']['attributes']['checkout_url'])) {
        echo json_encode(['checkout_url' => $responseData['data']['attributes']['checkout_url']]);
    } else {
        echo json_encode(['error' => 'Error creating payment link: Unknown error occurred.']);
    }
}

curl_close($ch);

?>