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
  ->setLastWillTopic('SonicMaster/test')
  ->setLastWillMessage('client disconnect')
  ->setLastWillQualityOfService(1);


$mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);

$mqtt->connect($connectionSettings, $clean_session);
printf("publisher connected\n");
// function _getServerLoadLinuxData()
// {
//     if (is_readable("/proc/stat"))
//     {
//         $stats = @file_get_contents("/proc/stat");

//         if ($stats !== false)
//         {
//             // Remove double spaces to make it easier to extract values with explode()
//             $stats = preg_replace("/[[:blank:]]+/", " ", $stats);

//             // Separate lines
//             $stats = str_replace(array("\r\n", "\n\r", "\r"), "\n", $stats);
//             $stats = explode("\n", $stats);

//             // Separate values and find line for main CPU load
//             foreach ($stats as $statLine)
//             {
//                 $statLineData = explode(" ", trim($statLine));

//                 // Found!
//                 if
//                 (
//                     (count($statLineData) >= 5) &&
//                     ($statLineData[0] == "cpu")
//                 )
//                 {
//                     return array(
//                         $statLineData[1],
//                         $statLineData[2],
//                         $statLineData[3],
//                         $statLineData[4],
//                     );
//                 }
//             }
//         }
//     }

//     return null;
// }

// print_r(_getServerLoadLinuxData());

// exit;

ob_start();
system("cmd /c .\python\CPUInfo.bat");
$content = ob_get_clean();
$content = str_replace("\n",'',$content);
$contentJson=json_decode($content, true);

for ($i = 0; $i< 2; $i++) {
  $payload = array(
    'device' => 'pc',
    'department' => 'software',
    'category' => 'desktop',
    'cpu_percent' => $contentJson['cpu_percent'],
    'virtual_memory' => $contentJson['virtual_memory'],
    'virtual_memory_precent' => $contentJson['virtual_memory_precent'],
    'date' => date('Y-m-d H:i:s'),
  );

  $mqtt->publish(
    // topic
    'Device/performance/info',
    // payload
    json_encode($payload),
    // qos
    0,
    // retain
    true
  );
  printf("msg $i send\n");
  sleep(1);
}

$mqtt->loop(true);
