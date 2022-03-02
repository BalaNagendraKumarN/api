<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');


// Only allow POST requests
if (strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') {
  throw new Exception('Only POST requests are allowed');
}

// Make sure Content-Type is application/xml 
$content_type = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : '';
if (stripos($content_type, 'application/xml') === false) {
  throw new Exception('Content-Type must be application/xml');
}

// Read the input stream
$body = file_get_contents("php://input");

$xml = simplexml_load_string($body, "SimpleXMLElement", LIBXML_NOCDATA);
$json = json_encode($xml);
$array = json_decode($json,TRUE);

// print_r($body);
// print_r($json);
print_r($array['Credentials']['PartsList']['Part']['PartNumber']);
?>