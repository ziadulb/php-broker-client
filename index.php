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
|> range(start: 2022-12-10T08:34:00Z, stop: 2022-12-14T08:36:00Z)
|> filter(fn: (r) => r._measurement == "bdcom")
|> filter(fn: (r) => r._field == "temp")
|> map(fn: (r) => ({r with _value: (float(v: r._value))} ))
// |> aggregateWindow(every: 1d, fn: mean)
// |> group()'
;
$results = $client->createQueryApi()->query($query, $org); 

// echo "<pre>";
//    print_r($results);

$client->close();
$time_stamp = '';
$x_labels = '';
$y_values = '';
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



  <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

  <table class="table table-dark table-hover">
      <thead>
          <tr>
              <td>#</td>
              <td>Device</td>
              <td>Tag1</td>
              <td>Tag2</td>
              <td>Col</td>
              <td>Value</td>
              <td>TimeStamp</td>
          </tr>
      </thead>
      <tbody><?php
      foreach($results as $result){
          foreach($result->records as $key => $record){
              $time_stamp .= ','.strtotime($record->values['_time']);
              $y_values .= ','.$record->values['_value'];
              $x_labels .= ','.date('m/d/Y H:i:s', strtotime($record->values['_time']));;
          ?>
              <tr>
                  <td><?php echo $key+1; ?></td>
                  <td><?php echo $record->values['_measurement']; ?></td>
                  <td><?php echo $record->values['department'] ?? null; ?></td>
                  <td><?php echo $record->values['category'] ?? null; ?></td>
                  <td><?php echo $record->values['_field']; ?></td>
                  <td><?php echo $record->values['_value']; ?></td>
                  <td><?php echo $record->values['_time']; ?></td>
              </tr><?php
          }
      }?>
          
      </tbody>
  </table>

</div>



    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="./node_modules/chart.js/dist/chart.umd.js"></script>
<script src="./node_modules/chartjs-plugin-annotation/dist/chartjs-plugin-annotation.min.js"></script>
<script>
    var chartEl = document.getElementById("myChart");
    chartEl.height = 150;
    var php_var = "<?php echo $time_stamp; ?>";
    var php_var_y = "<?php echo $y_values; ?>";
    var x_labels = "<?php echo $x_labels; ?>";
    var xValues = php_var.split(',');
    var yValues = php_var_y.split(',');
    var x_labels_split = x_labels.split(',');

    var arr = yValues;
    var sum = parseInt(0);
    for (var number of arr) {
      if(number != '' && number != 'NaN' && !isNaN(number)){
        sum = sum + parseInt(number);
      }else{
        continue;
      }
    }
    var average = (sum / arr.length).toFixed(2);
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
            }
          }
        }
      },
      legend: {display: false},
      // scales: {
      //   yAxes: [{ticks: {min: 0, max:10}}]
      // }
    };

    const config = {
      type: 'line',
      data: {
        labels: x_labels_split,
        datasets: [{
          label: 'My First Dataset',
          // tension: 0.1,
          fill: false,
          lineTension: 0,
          backgroundColor: "rgba(0,0,255,1.0)",
          borderColor: "rgba(0,0,255,0.1)",
          data: yValues
        }]
      },
      options
    };

    new Chart("myChart", config);
</script>

</body>
</html>
</script>
</body>
</html>

