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

// $writeApi->write($dataArray, WritePrecision::S, $bucket, $org);

$query = 'from(bucket: "test")
// |> range(start: 2022-10-08T07:30:00Z, stop: 2022-12-12T07:31:00Z)
|> range(start: 2022-12-12T12:00:00Z, stop: 2022-12-12T12:30:00Z)
|> filter(fn: (r) => r._measurement == "bdcom" and r.device == "ESP32")
|> filter(fn: (r) => r._field == "i1" or r._field == "i2")
|> map(fn: (r) => ({r with _value: (float(v: r._value))} ))
|> pivot(rowKey: ["_time"], columnKey: ["_field"], valueColumn: "_value")
// |> aggregateWindow(every: 10h, fn: mean)
// |> group()'
// |> group(columns: ["_field"])'
;
$results = $client->createQueryApi()->query($query, $org); 

// echo "<pre>";
//    print_r($results);

$client->close();
$time_stamp = '';
$x_labels = '';
$y_values = '';
$y_values_i2 = '';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Bucket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="container">

  <?php require './navbar.php'; ?> 

  <button onclick="removeData()">Remove</button>

  <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

  <table class="table table-dark table-hover"><?php
    foreach($results as $result){ 
      $key_index = array()?>
      <thead>
        <tr><?php
          foreach($result->columns as $key => $column){ 
            if(($column->label != 'result') && ($column->label != 'table') && ($column->label != '_start') && ($column->label != '_stop') ){?>
              <th><?php echo $column->label; ?></th><?php
            }
            array_push($key_index, $column->label);
          }?>
        </tr>
      </thead>

      <tbody><?php
        foreach ($result->records as $key => $record) { ?>
          <tr><?php
          foreach ($key_index as $iteration => $val) {
            if(($val != 'result') && ($val != 'table') && ($val != '_start') && ($val != '_stop') ){?>
              <td><?php echo $record->values[$val] ?></td><?php
            }
            if($val == '_time'){
              $time_stamp .= ($key == 0 ? '' : ',').date('m-d H:i:s',strtotime($record->values[$val]));
            }
            if($val == 'i1'){
              $y_values .= ($key == 0 ? '' : ',').$record->values[$val];
            }
            if($val == 'i2'){
              $y_values_i2 .= ($key == 0 ? '' : ',').$record->values[$val];
            }
          }?>
          </tr><?php
        }?>
      </tbody><?php
    }?>
  </table>

</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="./node_modules/chart.js/dist/chart.umd.js"></script>
<script src="./node_modules/chartjs-plugin-annotation/dist/chartjs-plugin-annotation.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
<!-- <script src="path/to/chartjs-plugin-zoom/dist/chartjs-plugin-zoom.min.js"></script> -->
<script src="./node_modules/chartjs-plugin-zoom/dist/chartjs-plugin-zoom.min.js"></script>
<script>
    var chartEl = document.getElementById("myChart");
    chartEl.height = 150;
    var php_var = "<?php echo $time_stamp; ?>";
    var php_var_y = "<?php echo $y_values; ?>";
    var php_var_i2 = "<?php echo $y_values_i2; ?>";
    var x_labels = "<?php echo $x_labels; ?>";
    var xValues = php_var.split(',');
    var yValues = php_var_y.split(',');
    var yValues_i2 = php_var_i2.split(',');
    var x_labels_split = x_labels.split(',');

    var arr = yValues;
    var arr_i2 = yValues_i2;
    var sum = parseFloat('0.00');
    var sum_i2 = parseFloat('0.00');
    for (var number of arr) {
      if(number != '' && number != 'NaN' && !isNaN(number)){
        sum = sum + parseFloat(number);
      }else{
        continue;
      }
    }

    for (var number of arr_i2) {
      if(number != '' && number != 'NaN' && !isNaN(number)){
        sum_i2 = sum_i2 + parseFloat(number);
      }else{
        continue;
      }
    }
    var average = (sum / arr.length).toFixed(4);
    var average_i2 = (sum_i2 / arr_i2.length).toFixed(4);
    const options = {
      plugins: {
        autocolors: false,
        annotation: {
          annotations: {
            line1: {
              type: 'line',
              yMin: average,
              yMax: average,
              borderColor: 'rgb(255, 99, 132)',
              borderWidth: 2,
            },
            line2: {
              type: 'line',
              yMin: average_i2,
              yMax: average_i2,
              borderColor: 'red',
              borderWidth: 2,
            }
          }
        },
        zoom: {
          zoom: {
            wheel: {
              enabled: true,
            },
            pinch: {
              enabled: true
            },
            mode: 'xy',
          }
        }
      },
      legend: {display: false},
      scales: {
        // xAxes: [{ticks: {min: 0, max:10}}, {type: 'realtime'}]
        // xAxes: {type: 'realtime'}
      },
    };

    const config = {
      type: 'line',
      data: {
        labels: xValues,
        datasets: [{
          label: 'My First Dataset',
          // tension: 0.1,
          fill: false,
          lineTension: 0,
          backgroundColor: "rgba(0,0,255,1.0)",
          borderColor: "rgba(0,0,255,0.1)",
          data: yValues
        },
        {
          label: 'My Second Dataset',
          // tension: 0.1,
          fill: false,
          lineTension: 0,
          backgroundColor: "rgba(186, 106, 127)",
          borderColor: "rgba(52, 235, 64)",
          data: yValues_i2
        }
      ]
      },
      options
    };

    var myChart = new Chart("myChart", config);

    // this post id drives the example data
    var postId = 1;

    // logic to get new data
    var getData = function() {
      myChart.data.labels.push("Post " + postId++);
      myChart.data.datasets[0].data.push((.092));

      myChart.data.labels.shift();
      myChart.data.datasets[0].data.shift();
      
      myChart.config.options.plugins.annotation.annotations.line2.yMin = .092;
      myChart.config.options.plugins.annotation.annotations.line2.yMax = .092;
      myChart.update();
      // console.log(myChart.config.options.plugins.annotation.annotations.line2);
      
      
      // re-render the chart
      // myChart.update();
      // $.ajax({
      //   url: 'https://jsonplaceholder.typicode.com/posts/' + postId + '/comments',
      //   success: function(data) {
      //     // process your data to pull out what you plan to use to update the chart
      //     // e.g. new label and a new data point
          
      //     // add new label and data point to chart's underlying data structures
      //   }
      // });
    };

    // get new data every 3 seconds
    setInterval(getData, 3000);

    

    // function removeData(chart) {
    //     chart.data.labels.pop();
    //     chart.data.datasets.forEach((dataset) => {
    //         dataset.data.pop();
    //     });
    //     chart.update();
    // }
</script>

</body>
</html>
</script>
</body>
</html>

