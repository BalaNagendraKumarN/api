<?php
//header("Access-Control-Allow-Origin: *");
// header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
// header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
// header('Access-Control-Max-Age: 1000');
// header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
// header("Content-Type: application/json; charset=UTF-8");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization, x-xsrf-token");
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method,Access-Control-Request-Headers, Authorization,x-xsrf-token");
header("HTTP/1.1 200 OK");
die();
}


// Only allow POST requests
if (strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') {
  throw new Exception('Only POST requests are allowed');
}

// Make sure Content-Type is application/json 
$content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
if (stripos($content_type, 'application/json') === false) {
  throw new Exception('Content-Type must be application/json');
}

// Read the input stream
$body = file_get_contents("php://input");

$array = json_decode($body,TRUE);

if($array['pincode'] == '600011'){
    $response['message'] = 'success';
    $response['price'] = '11';
}elseif($array['pincode'] == '600039'){
    $response['message'] = 'success';
    $response['price'] = '12';
}elseif($array['pincode'] == '600012'){
    $response['message'] = 'success';
    $response['price'] = '10';
}else{
    $response['price'] = '';
    $response['message'] = 'No Price Found';
}

echo json_encode($response);
?>