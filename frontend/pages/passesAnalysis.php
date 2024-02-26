<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet"  href="../custom_design.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Passes Analysis</title>
  </head>

  <body>
    <?php include '../header.php';?>
<!-- Title -->
<h3 class = "d-flex justify-content-center m-3 p-5"><u>Passes Analysis</u></h3>
<p class = "d-flex justify-content-center">The currect service shows every pass record made for an operator1 ePASS owner passing through an operator2 station during the selected time period</p>
<p class="w3-opacity w3-center"><i>Please select your operators of choice and a time period</i></p>
<!-- Form Container -->
<div class = "container d-flex justify-content-center" style = "padding-top:10px;">
  <form  action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = 'POST'>
    <div class = "form-inline" style = "width:100%;">
      <label class="label">Operator 1</label>
      <select class = "form-select" name = "op1">
        <option style = "display:none"></option>
        <option name = "op1" value = "aodos">Attikh Odos</option>
        <option name = "op1" value = "egnatia">Egnatia Odos</option>
        <option name = "op1" value = "gefyra">Gefyra</option>
        <option name = "op1" value = "nea_odos">Nea Odos</option>
        <option name = "op1" value = "olympia_odos">Olympia Odos</option>
        <option name = "op1" value = "moreas">Moreas</option>
        <option name = "op1" value = "kentriki_odos">Kentriki Odos</option>
      </select>
    </div>
    <div class = "form-inline">
      <label class="label">Operator 2</label>
      <select class = "form-select" name = "op2" style = "width:100%;">
        <option style = "display:none"></option>
        <option name = "op2" value = "aodos">Attikh Odos</option>
        <option name = "op2" value = "egnatia">Egnatia Odos</option>
        <option name = "op2" value = "gefyra">Gefyra</option>
        <option name = "op2" value = "nea_odos">Nea Odos</option>
        <option name = "op2" value = "olympia_odos">Olympia Odos</option>
        <option name = "op2" value = "moreas">Moreas</option>
        <option name = "op2" value = "kentriki_odos">Kentriki Odos</option>
      </select>
    </div>
    <div class = "row row-cols-2" >
      <div class="form-group date" name = "datefrom" style = "padding-top:5px;">
        <label class="label">Period Start</label>
        <input type="date" class = "form-control" name = "datefrom" id="datepicker">
      </div>
      <div class="form-group date"name = "dateto" style = "padding-top:5px;">
        <label class="label">Period End</label>
        <input type="date" class = "form-control" name = "dateto" id="dateto">
      </div>
  </div>
  <div class = "d-flex justify-content-center" style = "padding-top:20px;">
    <button type="submit">Send Request</button>
  </div>
</form>
</div>
<!-- PHP Form Handling -->
<?php
  include '../functions.php';
  $host_ip = setAPIName();
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $op1 = $_POST["op1"];
    $op2 = $_POST["op2"];
    $datefromraw =  date_create($_POST["datefrom"]);
    $datetoraw =  date_create($_POST["dateto"]);
    $datefrom = date_format($datefromraw,"Ymd");
    $dateto = date_format($datetoraw,"Ymd");
    $api_url = 'http://'.$host_ip.':8000/interoperability/api/passesanalysis/' . $op1 . '/' . $op2 . '/' . $datefrom . '/' . $dateto . '/';
    $request_method = 'GET';
    $response = sendRequest($api_url, $request_method);
    $json_response = json_decode($response);
  }?>

  <br>
  <?php   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (($op1 == '') || ($op2 == '') || ($datefrom == '') || ($dateto == '')){
      echo "<div class = 'container d-flex justify-content-center'>
              <div class = 'card'>
                <div class = 'card-body'>
                  <p> Please input data into every form!</p>";
                  echo" </div>";
                  echo" </div>";
                  echo" </div>";
    }
    else {
    echo "<div class = 'container d-flex justify-content-center'>
      <div class = 'card' style = 'padding:10px'>
        <div class = 'card-body'>";
        if ($json_response == null){
          echo "<p>No Data Found! Check your Request Form!</p>";
          echo" </div>";
          echo" </div>";
          echo" </div>";
          }
          else{
          echo "
          <table class = 'passescosttable'>
            <thead>
              <tr>
                <th>Operator 1</th>
                <th>Operator 2</th>
                <th>Request Timestamp</th>
                <th>Period From</th>
                <th>Period To</th>
                <th>Number of Passes</th>
              </tr>
            </thead>";

          echo "<tr>";
          echo "<td>".$json_response->op1_ID."</td>";
          echo "<td>".$json_response->op2_ID."</td>";
          echo "<td>".$json_response->RequestTimestamp."</td>";
          echo "<td>".$json_response->PeriodFrom."</td>";
          echo "<td>".$json_response->PeriodTo."</td>";
          echo "<td>".$json_response->NumberOfPasses."</td>";
          echo "</tr>";
          echo "</table>";
          echo" </div>";
          echo" </div>";
          echo" </div>";
          echo "<br>";

          echo "<div class = 'container d-flex justify-content-center'>
            <div class = 'card' style = 'padding:10px'>
              <div class = 'card-body'>
                <table class = 'passescosttable'>
                  <thead>
                    <tr>
                      <th>Pass Index</th>
                      <th>PassID</th>
                      <th>Station ID</th>
                      <th>TimeStamp</th>
                      <th>VehicleID</th>
                      <th>Charge</th>
                    </tr>
                  </thead>";
                  foreach($json_response->PassesList as $elem){
                  echo "<tr>";
                  echo "<td>".$elem->PassIndex ."</td>";
                  echo "<td>".$elem->PassID ."</td>";
                  echo "<td>".$elem->StationID ."</td>";
                  echo "<td>".$elem->TimeStamp ."</td>";
                  echo "<td>".$elem->VehicleID ."</td>";
                  echo "<td>".$elem->Charge ."</td>";
                  echo "</tr>";
                }
                echo "</table>";
                echo" </div>";
                echo" </div>";
                echo" </div>";
                echo "</table>";
                echo" </div>";
                echo" </div>";
                echo" </div>";
                echo "<br>";
        }
      }
      }?>


    </body>


  </html>
