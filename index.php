<?php

$data = file_get_contents("php://input");

$file = '/ins-cat/insurance_catcher_log.txt';

$current = file_get_contents($file);
$current .= "---\n";

$time = date('Y.m.d H:i:s:ms', $_SERVER['REQUEST_TIME']);
$current .= "Time: $time\n";

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$current .= "Remote IP: $ip\n";

$method=$_SERVER['REQUEST_METHOD'];
$current .= "Request method: $method\n";

$uri=$_SERVER['REQUEST_URI'];
$current .= "Request uri: $uri\n";

$current .= "Headers:\n";

foreach (getallheaders() as $name => $value) {
    $current .=  "$name: $value\n";
}

$current .= "Data:\n";

$current .= "$data\n";

file_put_contents($file, $current);


print_r("Error. Please try again\n");
#print_r($current);

?>