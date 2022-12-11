<?php

// require __DIR__ . '/vendor/autoload.php';
require('vendor/autoload.php');
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;


use \PhpMqtt\Client\MqttClient;
use \PhpMqtt\Client\ConnectionSettings;

$server   = '119.40.81.36';
$port     = 1883;
$clientId = rand(5, 15);
$username = 'abc';
$password = '1234';
$clean_session = false;
$mqtt_version = MqttClient::MQTT_3_1_1;

$connectionSettings = (new ConnectionSettings)
  ->setUsername($username)
  ->setPassword($password)
  ->setKeepAliveInterval(60)
  // ->setLastWillTopic('emqx/test/last-will')
  ->setLastWillTopic('Device/performance/info')
  ->setLastWillMessage('client disconnect')
  ->setLastWillQualityOfService(1);


  # You can generate an API token from the "API Tokens Tab" in the UI
// $token = getenv('INFLUX_TOKEN');
$token = "-DkujWtj70w8nb0QC3L_9ZSqsEbQdF5TvajyZlFFdJs6v6XAc802itdZ0HKOc02EHOH66mmqVoE2HR2fqCojhw==";
$org = 'BDCOM';
$bucket = 'test';

$client = new Client([
    "url" => "http://localhost:8086",
    "token" => $token,
]);

$writeApi = $client->createWriteApi();

$mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);

$mqtt->connect($connectionSettings, $clean_session);
printf("client connected\n");

$mqtt->subscribe('Device/performance/info', function ($topic, $message) use ($writeApi, $bucket, $org){

    $msg = json_decode($message);
    $dataArray = [
        'name' => $msg->device,
        'tags' => ['department' => $msg->department, 'category' => $msg->category],
        'fields' => ['cpu_percent' => $msg->cpu_percent, 'virtual_memory, ' => $msg->virtual_memory, 'virtual_memory_precent, ' => $msg->virtual_memory_precent],
        'time' => strtotime($msg->date)
    ];
    
    $writeApi->write($dataArray, WritePrecision::S, $bucket, $org);
    // printf("%d, Data Stored Successfully \n", $msg->count);
    print_r($dataArray);
}, 0);



$mqtt->loop(true);
