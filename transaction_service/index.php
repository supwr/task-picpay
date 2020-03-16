<?php
// i know this mock got shitty code. it's just a mock, don't judge
$data = json_decode(file_get_contents('php://input'));

if($data->value >= 100) {
    http_response_code(401);
    header('Content-Type: application/json');
    echo json_encode(["message" => "Transaction rejected"]);
    exit();
}

if($data->value < 100) {
    http_response_code(201);
    exit();
}