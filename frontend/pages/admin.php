<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet"  href="../custom_design.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts.js"></script>
    <title>Admin Page</title>
  </head>

  <body>
    <?php include '../header.php';?>

<!-- Main Body -->
<div class = "container d-flex flex-column mt-3 p-5">
  <h3 class = "mb-3 text-center">Available Services for Administrators</h3>
  <p></p>
  <p><u>Healthcheck</u>: the connection to the database is checked and on success Status 'OK' will be shown</p>
  <p><u>Reset Vehicles</u>: all records of pass owners's vehicles are deleted form the database </p>
  <p><u>Reset Stations</u>: all records of every toll station are deleted form the database </p>
  <p><u>Reset Passes</u>: the history of previous pass records is deleted form the database </p>
  <p></p>
  <p class="w3-opacity w3-center"><i>Please click on the corresponding button</i></p>

  <!-- Button Group -->
  <form  action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = 'POST'>
    <div class="w3-content w3-center"  role="group">
      <button type="submit"  name = "endpoint"  value = "healthcheck">Healthcheck</button>
      <button type="submit"  name = "endpoint" onclick ="return confirm('This action will make changes on the database. Continue?');"  value = "resetvehicles">Reset Vehicles</button>
      <button type="submit"  name = "endpoint" onclick ="return confirm('This action will make changes on the database. Continue?');"  value = "resetstations">Reset Stations</button>
      <button type="submit"  name = "endpoint" onclick ="return confirm('This action will make changes on the database. Continue?');"  value = "resetpasses">Reset Passes</button>
    </div>
  </form>
</div>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../functions.php';
    $host_ip = setAPIName();
    $curl = curl_init();
    if ($_POST["endpoint"] == "healthcheck"){
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://'.$host_ip.':8000/interoperability/api/admin/healthcheck',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    }
    else{
      $endpoint = $_POST["endpoint"];
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://'.$host_ip.':8000/interoperability/api/admin/' . $endpoint,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
    ));
  }
}?>
    <br>

  <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $response = curl_exec($curl);
      curl_close($curl);
      $json_response = json_encode(json_decode($response), JSON_PRETTY_PRINT);
      echo "<div class = 'container' style = 'padding:20px'>
                  <div class = 'card'>
                    <div class = 'card-body'>";
      echo "<pre>" .$json_response ."</pre>";
      echo "</div>";
      echo "</div>";
      echo "</div>";

          }?>

    </p>
  </div>
</div>
</div>
<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
  <i class="fa fa-github w3-hover-opacity"><a href="https://github.com/ntua/TL21-02" target="_blank">Github</a></i>
</footer>
  </body>


</html>
