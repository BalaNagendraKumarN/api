<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');


$input_xml = '<cXML>
    <Credentials>
        <Customerid>285</Customerid>
        <PartsList>
            <Part>
                <PartNumber>Test Server</PartNumber>
            </Part>
        </PartsList>
    </Credentials>
</cXML>';

$url = 'http://localhost/api/api.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
// Following line is compulsary to add as it is:
curl_setopt($ch, CURLOPT_POSTFIELDS,$input_xml);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));

$data = curl_exec($ch);
curl_close($ch);


print_r('<pre>');print_r($data);print_r('</pre>');
?>