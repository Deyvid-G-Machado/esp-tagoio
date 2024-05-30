<?php
use Dotenv\Dotenv;
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/src/conf');
$dotenv->load();
$device_token = $_ENV['DEVICE_TOKEN'];


function getTagoData($variable) {
    global $device_token;
    $url = "https://api.tago.io/data?query=last_item&variables=$variable&value";
    
    $options = array(
        'http' => array(
            'header' => "device-token: $device_token\r\n",
            'method' => 'GET'
        )
    );
    
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        return "Erro ao obter dados.";
    }

    $data = json_decode($result, true);
    if (isset($data['result'][0]['value'])) {
        return $data['result'][0]['value'];
    } else {
        return "Dados não disponíveis.";
    }
}

$umidadeData = number_format(getTagoData("umidade"), 1);
$temperaturaData = number_format(getTagoData("temperatura"), 1);

echo json_encode(array(
    "umidade" => $umidadeData,
    "temperatura" => $temperaturaData
));
?>
