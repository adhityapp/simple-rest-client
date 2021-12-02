<?php
require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://127.0.0.1:8000',
    'timeout' => 5
]);

$response =  $client->request('POST', '/api/login', [
    'json' => [
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ]
]);

$body = $response->getBody();
$data_body = json_decode($body, true);
// $token = $data_body_login['data']['token'];
//var_dump($response);

if ($data_body['success'] = true) {
    session_start();
    $_SESSION["user"] = $data_body['data']['name'];
    $_SESSION["token"] = $data_body['data']['token'];
    header('location:home.php'); //    // if they are not logged in 
}
