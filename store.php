<?php

require __DIR__ . '/vendor/autoload.php';
use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;

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


$dataArray = ['name' => 'home',
  'tags' => ['room' => 'Kitchen '],
  'fields' => ['temp' => 11, 'hum' => 33, "co" => 2],
  'time' => time()];

// $dataArray = "home,room=Living\ Room temp=11.9,hum=33.9,co=0i ".time();

$eee = $writeApi->write($dataArray, WritePrecision::S, $bucket, $org);

$client->close();
