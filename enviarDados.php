<?php
require_once('index.php');

use Dotenv\Dotenv;
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/src/conf');
$dotenv->load();
$device_token = $_ENV['DEVICE_TOKEN'];

$lcd_value = '';

if (isset($_POST['lcd'])) {
    $lcd_value = $_POST['lcd'];
} else {
    echo "Nenhum valor enviado.";
}

$data = array(
    array(
        "variable" => "lcd",
        "value" => $lcd_value
    )
);

$json_data = json_encode($data);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n" .
                     "device-token: $device_token\r\n",
        'method'  => 'POST',
        'content' => $json_data,
        'timeout' => 30,
    ),
);

$context  = stream_context_create($options);

$result = file_get_contents('https://api.tago.io/data', false, $context);

/*
if ($result === FALSE) {
    echo "Erro ao enviar a solicitação.";
} else {
    echo "Enviado!";
}
*/
?>
