<?php

require('vendor/autoload.php');

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
  ->setLastWillTopic('SonicMaster/test')
  ->setLastWillMessage('client disconnect')
  ->setLastWillQualityOfService(1);


$mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);

$mqtt->connect($connectionSettings, $clean_session);
printf("client connected\n");

$mqtt->subscribe('SonicMaster/test', function ($topic, $message) {
    printf("Received message on topic [%s]: %s\n", $topic, $message);
    // $url = "http://localhost/php-mqtt-fluxDB/store.php";   
    // $ch = curl_init();   
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
    // curl_setopt($ch, CURLOPT_URL, $url);   
    // $res = curl_exec($ch);   
    // printf($res);  
}, 0);



$mqtt->loop(true);
