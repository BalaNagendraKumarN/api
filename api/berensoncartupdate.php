<?php

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

// echo"<pre>";print_r($array);echo"</pre>";exit;

$cart_id = $array['cart_id'];
$item_id = $array['item_id'];
$quatity = $array['quatity'];
$prod_id = $array['product_id'];
$price = $array['price'];

$curl = curl_init();

$post_data=array();
$post_data["line_item"]['quantity'] = $quatity;
$post_data["line_item"]['product_id'] = $prod_id;
$post_data["line_item"]['list_price'] = $price;

$post_data=json_encode($post_data);


curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.bigcommerce.com/stores/vwzwxvrrjw/v3/carts/".$cart_id."/items/".$item_id."",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_POSTFIELDS => $post_data,
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json",
    "X-Auth-Token: d08sxq6x3ztlbg1lgycy7addiecb93d"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}


echo json_encode($response);
?>