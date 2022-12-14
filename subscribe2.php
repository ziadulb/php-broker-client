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
  ->setLastWillTopic('test')
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

$mqtt->subscribe('test', function ($topic, $message) use ($writeApi, $bucket, $org){

    $msg = json_decode($message);
    print_r($msg);
    $dataArray = [
        'name' => 'bdcom',
        'tags' => ['device' => $msg->did],
        'fields' => ['temp' => $msg->temp, 'him' => $msg->him, 'v1' => $msg->v1, 'v2' => $msg->v2, 'v3' => $msg->v3, 'i1' => $msg->i1, 'i2' => $msg->i2, 'v3' => $msg->i3, 'f1' => $msg->f1, 'f2' => $msg->f2, 'f3' => $msg->f3, 'smo' => $msg->smo, 'liq' => $msg->liq],
        'time' => strtotime(time())
    ];
    
    $writeApi->write($dataArray, WritePrecision::S, $bucket, $org);
    printf("Data Stored Successfully \n");
    
}, 0);



$mqtt->loop(true);
