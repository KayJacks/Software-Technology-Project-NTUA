<!-- Navbar -->
<?php echo'
<div class="w3-top">

  <div class="w3-bar w3-black w3-card">
    <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="../index.php" class="w3-bar-item w3-button w3-padding-large">HOME</a>
    <a href="about.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">About Us</a>
    <a href="admin.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Admin</a>
    <div class="w3-dropdown-hover w3-hide-small">
      <button class="w3-padding-large w3-button" title="More">Available Services <i class="fa fa-caret-down"></i></button>     
      <div class="w3-dropdown-content w3-bar-block w3-card-4">
        <a href="passesPerStation.php" class="w3-bar-item w3-button">Passes Per Station</a>
        <a href="passesAnalysis.php" class="w3-bar-item w3-button">Passes Analysis</a>
        <a href="passesCost.php" class="w3-bar-item w3-button">Cost Analysis</a>
        <a href="chargesBy.php" class="w3-bar-item w3-button">Charges By</a>
      </div>
    </div>
  </div>
</div>;'?>