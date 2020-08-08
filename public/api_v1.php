<?php

require __DIR__ . '/../bootstrap/api.php';

$request = new ApiRequest();
print_r($request->getParameters());

header('Content-Type: application/json');
$response = new Response();
