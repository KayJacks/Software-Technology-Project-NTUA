<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="stylesheet" type = "text/css" href="custom_design.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Home Page</title>
  </head>

  <body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large">HOME</a>
    <a href="pages/about.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">About Us</a>
    <a href="pages/admin.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Admin</a>
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-padding-large w3-button" title="More">Available Services <i class="fa fa-caret-down"></i></button>     
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="pages/passesPerStation.php" class="w3-bar-item w3-button">Passes Per Station</a>
        <a href="pages/passesAnalysis.php" class="w3-bar-item w3-button">Passes Analysis</a>
        <a href="pages/passesCost.php" class="w3-bar-item w3-button">Cost Analysis</a>
        <a href="pages/chargesBy.php" class="w3-bar-item w3-button">Charges By</a>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">

  <!-- The Band Section -->
  <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px">
    <h2 class="w3-wide">Tolls ePASS Software</h2>
    <p class="w3-opacity"><i>Software Description</i></p>
    <p class="w3-sepia"><i>This is the wep app designed for the Tolls ePASS software as a user interface. </i></p>
    <p><i>The mentioned software
      makes an effort at solving the interoperability problem between different operators when the ePASS of a certain 
      operator is used on a station owened by a different one. This app features several services which give 
    the user the chance of studying the traffic between operators, analyze the dept among them and view statistical results</i></p>
    <!--<div class="w3-row w3-padding-32">-->

  </div>
  <img src="images/tolls.jpg" class="" style="width:100%">
<!-- End Page Content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
  <i class="fa fa-github w3-hover-opacity"><a href="https://github.com/ntua/TL21-02" target="_blank">Github</a></i>
</footer>
</body>
</html>
