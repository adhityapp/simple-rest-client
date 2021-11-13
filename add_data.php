<?php

require __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://127.0.0.1:8000',
    'timeout' => 5
]);

$response =  $client->request('POST','/api/futsal',[
    'json' => [
        'jersey' => $_POST['jersey'],
        'name' => $_POST['name'],
        'position' => $_POST['position']
    ]
]);

$body = $response->getBody();
header('location:index.php');
