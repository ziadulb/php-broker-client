<?php

//$content= exec('.\python\get_CPU_Data.bat');
ob_start();
system("cmd /c .\python\CPUInfo.bat");
$content = ob_get_clean();
$content = str_replace("\n",'',$content);

var_dump( $content);
// $updated = substr($content, 0, -1);
$contentJson=json_decode($content, true);
echo"<pre>";
print_r($contentJson);
// class SystemInfoWindows
// {
//     private function getFilePath ($fileName, $content)
//     {
//         $path = dirname(__FILE__). "\\ $fileName";
//         if (! file_exists ($path)) {
//         file_put_contents ($path, $content);
//         }
//         return $path;
//     }
//     private function getCupUsageVbsPath ()
//     {
//         return $this->getFilePath(
//         'cpu_usage.vbs',
//         "On Error Resume Next
//             Set objProc = GetObject (\"winmgmt:\\\\.\\root\\cimv2: win32_processor = 'cpu0' \")
//             WScript.Echo (objProc.LoadPercentage) "
//         );
//     }

//     private function getMemoryUsageVbsPath()
//     {
//         return $this->getFilePath(
//         'memory_usage.vbs',
//         "On Error Resume Next
//             Set objWMI = GetObject (\"winmgmts:\\\\.\\root\\cimv2 \")
//             Set colOS = objWMI.InstancesOf (\"Win32_OperatingSystem \")
//             For Each objOS in colOS
//             Wscript.Echo (\"{\" \"TotalVisibleMemorySize \" \": \" & objOS.TotalVisibleMemorySize & \", \" \"FreePhysicalMemory \" \": \" & objOS.FreePhysicalMemory & \"} \")
//             Next "
//         );
//     }

//     public function getCpuUsage()
//     {
//         $path = $this->getCupUsageVbsPath();
//         exec ("cscript-nologo $path", $usage);
//         print_r($usage);
//         return $usage [0];
//     }

//     public function getMemoryUsage()
//     {
//         $path = $this->getMemoryUsageVbsPath();
//         exec("cscript-nologo $path", $usage);
//         var_dump($path);
//         var_dump($usage);

//         $memory = json_decode ($usage [0], true);
//         var_dump($memory);
//         $memory['usage'] = Round ((($memory['TotalVisibleMemorySize']-$memory['FreePhysicalMemory']) / $memory['TotalVisibleMemorySize']) * 100);
//         return $memory;
//     }
// }

// $info = new SystemInfoWindows ();
// $cpu = $info->getCpuUsage ();
// $memory = $info->getMemoryUsage ();
// echo "Current system CPU usage: {$cpu}%, memory usage {$memory ['usage']}%"; 
