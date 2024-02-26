<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet"  href="../custom_design.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <title>Passes Per Station</title>
  </head>

  <body>
    <?php include '../header.php';?>

<h3 class = "d-flex justify-content-center m-3 p-5"><u>Passes Per Station</u></h3>
<p class = "d-flex justify-content-center">The currect service shows all pass records made during the selected time period for the chosen station</p>
<p class="w3-opacity w3-center"><i>Please select a station and a time period</i></p>
<div class = "container d-flex justify-content-center" >
  <form  action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = 'POST'>
    <div class = "form-inline" style = "width:100%;">
      <label class="label">Station</label>
      <input type="text" class = "form-control" name = "stationid">
    </div>
    <div class = "row row-cols-2" >
      <div class="form-group date" name = "datefrom" style = "padding-top:5px;">
        <label class="label">Period Start</label>
        <input type="date" class = "form-control" name = "datefrom" id="datepicker">
      </div>
      <div class="form-group date"name = "dateto" style = "padding-top:5px;">
        <label class="label">Period End</label>
        <input type="date" class = "form-control" name = "dateto" id="datepicker">
      </div>
  </div>
  <div class = "d-flex justify-content-center" style = "padding-top:20px;">
    <button type="submit">Send Request</button>
  </div>
</form>
</div>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../functions.php';
    $host_ip = setAPIName();
    $stationid = $_POST["stationid"];
    $datefromraw =  date_create($_POST["datefrom"]);
    $datetoraw =  date_create($_POST["dateto"]);
    $datefrom = date_format($datefromraw,"Ymd");
    $dateto = date_format($datetoraw,"Ymd");
    $api_url = 'http://'.$host_ip.':8000/interoperability/api/passesperstation/' . $stationid . '/' . $datefrom . '/' . $dateto . '/';
    $request_method = 'GET';
    $response = sendRequest($api_url, $request_method);
    $json_response = json_decode($response);
  }?>

  <br>
  <?php   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (($stationid == '') || ($datefrom == '') || ($dateto == '')){
      echo "<div class = 'container d-flex justify-content-center'>
              <div class = 'card'>
                <div class = 'card-body'>
                  <p> Please input data into every form!</p>";
                  echo" </div>";
                  echo" </div>";
                  echo" </div>";
    }
    else {
    echo "<div class = 'container d-flex justify-content-evenly'>
      <div class = 'card' >
        <div class = 'card-body'>";
        if ($json_response == null){
          echo "<p>No Result! Please try again with different inputs.</p>";
          echo" </div>";
          echo" </div>";
          echo" </div>";
          }
          else {
          echo "
          <h3> The results are presented in the table below!!</h3>
          <p> The pie chart on the right shows the relation between home users and visitor users</p>
          <table class = 'passescosttable'>
            <thead>
              <tr>
                <th>Station ID</th>
                <th>Station Operator</th>
                <th>Request Timestamp</th>
                <th>Period From</th>
                <th>Period To</th>
                <th>Number of Passes</th>
              </tr>
            </thead>";
          echo "<div class = 'col m-5 p-2'>";
          echo "<tr>";
          echo "<td>".$json_response->Station."</td>";
          echo "<td>".$json_response->StationOperator."</td>";
          echo "<td>".$json_response->RequestTimestamp."</td>";
          echo "<td>".$json_response->PeriodFrom."</td>";
          echo "<td>".$json_response->PeriodTo."</td>";
          echo "<td>".$json_response->NumberOfPasses."</td>";
          echo "</tr>";
          echo "</table>";

          echo "<br>";
          echo "<div class='b-example-divider'></div>";
          echo "<table class = 'passescosttable'>
            <thead>
              <tr>
                <th>Pass Index</th>
                <th>Pass ID</th>
                <th>Passes Timestamp</th>
                <th>Vehicle ID</th>
                <th>Tag Provider</th>
                <th>Pass Charge</th>
                <th>Pass Type</th>
              </tr>
            </thead>";
              $home_counter = 0;
              $visitor_counter = 0;
              foreach($json_response->PassesList as $elem){
                echo "<tr>";
                echo "<td>".$elem->PassIndex ."</td>";
                echo "<td>".$elem->PassID ."</td>";
                echo "<td>".$elem->PassTimeStamp ."</td>";
                echo "<td>".$elem->VehicleID ."</td>";
                echo "<td>".$elem->TagProvider ."</td>";
                echo "<td>".$elem->PassCharge ."</td>";
                echo "<td>".$elem->PassType ."</td>";
                echo "</tr>";

                if ($elem->PassType == 'home') {
                  $home_counter = $home_counter + 1;
                }
                elseif ($elem->PassType == 'visitor') {
                  $visitor_counter = $visitor_counter + 1;
                }
              }
            echo "</table>";
            echo" </div>";
            echo" </div>";
            echo " <div class = 'card' >
                <div class = 'card-body d-flex align-self-center' style='height:100%; width:100%;'>";
            echo "<div class = 'chart-container' style = 'width:450px;'>";
            echo "<canvas id='pieChart'></canvas>";
            echo" </div>";
              echo" </div>";
            echo" </div>";
            echo" </div>";
            echo" </div>";
            echo "<script>";
            echo "
                var ctxP = document.getElementById('pieChart').getContext('2d');
                var myPieChart = new Chart(ctxP, {
                  type: 'pie',
                  data: {
                    labels: ['home', 'visitor'],
                    datasets: [{
                      label: 'Type of Visits (Total Visits:".$json_response->NumberOfPasses.")',
                      data: [" . $home_counter . ", ". $visitor_counter ."],
                      backgroundColor: ['#F7464A', '#46BFBD', '#FDB45C', '#949FB1', '#4D5360', '#57F908', '#A20FB2'],
                      hoverBackgroundColor: ['#FF5A5E', '#5AD3D1', '#FFC870', '#A8B3C5', '#616774']
                    }]
                  },
                  options: {
                    responsive: true
                  }
                });
                ";
              echo "</script>";
        }
      }
    }?>
        <br>
</body>


</html>
