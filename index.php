<?php
/* 
 * File:    index.php
 * 
 * Author:  S. Muhammad Yazdian (muhammad.yazdian@gmail.com) 
 * Date:    2021-10-25 
 * 
 * Summary of File: 
 * 
 *   This file contains code which creates a HTML HMI, communicates to a server
 *   and displays information for countries. 
 *
 * Development Steps:
 *   1- Fetch list of countires form database
 *   2- Create a country select menu
 *   3- Send a request to the server
 *   4- Display received information from the server
 */

// Connect to database
include('../config/connect_db.php');

$DEBUG = 0;

if ($conn) {
  if ($DEBUG) echo '<p style="color:green;">Successful connection</p>';
  $sql = "SELECT * FROM `country`";
  $result = mysqli_query($conn, $sql);
  $countries = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);

  if ($DEBUG) {
    echo '<pre>';
    print_r($countries);
    echo '</pre>';
  }
  echo '<div style="background-color: lightblue;">';
  echo '<h3>Few stats:</h3>';
  $sql = "SELECT `Name`, `Population` FROM `country` 
          WHERE `Population` =  (SELECT Min(`Population`) FROM `country`)";
  $result = mysqli_query($conn, $sql);
  $least_populated_country = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  echo '<p>' .  $least_populated_country["Name"] . ', with ' .
    $least_populated_country["Population"] .
    ' people, is the least populated countary.</p>';

  $sql = "SELECT `Name`, `Population` FROM `country` 
          WHERE `Population` =  (SELECT Max(`Population`) FROM `country`)";
  $result = mysqli_query($conn, $sql);
  $least_populated_country = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  echo '<p>' .  $least_populated_country["Name"] . ', with ' .
    $least_populated_country["Population"] .
    ' people, is the most populated countary.</p>';

  $sql = "SELECT `Name`, `SurfaceArea` FROM `country` 
          WHERE `SurfaceArea` =  (SELECT Min(`SurfaceArea`) FROM `country`)";
  $result = mysqli_query($conn, $sql);
  $least_populated_country = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  echo '<p>' .  $least_populated_country["Name"] . ', with ' .
    $least_populated_country["SurfaceArea"] .
    ' meter square area, is the smallest countary.</p>';

  $sql = "SELECT `Name`, `SurfaceArea` FROM `country` 
          WHERE `SurfaceArea` =  (SELECT Max(`SurfaceArea`) FROM `country`)";
  $result = mysqli_query($conn, $sql);
  $least_populated_country = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  echo '<p>' .  $least_populated_country["Name"] . ', with ' .
    $least_populated_country["SurfaceArea"] .
    ' meter square area, is the largest countary.</p>';
  echo '</div>';
  //mysqli_close($conn);

} else {
  echo '<p style="color:red;">Error: Could not connect to the database</p>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Server-Client Project</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>

<body>
  <h1>Server-Client Project (Countries)</h1>
  <hr>
  <!-- Create a country select menu -->
  <?php echo '<p>There are ' . count($countries) .
    ' countries in the database.'; ?>
  <div>
    <label for="country-list">Select a country (client side):</label>
    <select id="country-list" name="country-list" 
            onchange="updateDisplayedCountryInfo(this)">
      <?php
      $country_id = 0;
      foreach ($countries as $country) {
        echo '<option value="' . $country_id . '">' .
          $country['Name'] . '</option>';
        $country_id++;
      }
      ?>
    </select>
  </div>
  <hr>

  <!-- Step 4: Display received information from the server -->
  <!-- This a tempplate for what information to be displayed -->
  <div>
    <label for="country-name">Country:</label>
    <output id="country-name">TBD</output>
    <br>
    <label for="country-code">Code:</label>
    <output id="country-code">TBD</output>
    <br>
    <label for="country-population">Population:</label>
    <output id="country-population">TBD</output>
    <br>
    <label for="country-population-date">Population date:</label>
    <output id="country-population-date">TBD</output>
    <br>
    <label for="country-capital">Capital:</label>
    <output id="country-capital">TBD</output>
  </div>

  <div>
    The captal is ...
  </div>
  <hr>
  <div>
    <label for="country-list-2">Select a country (server side):</label>
    <select id="country-list-2" name="country-list-2" 
            onchange="updateDisplayedCountryInfo2(this)">
      <option value="">Select a country</option>
      <?php
      require_once '../config/connect_db.php';
      $sql = "SELECT * FROM `country`";
      $result = mysqli_query($conn, $sql);
      while ($country_2 = mysqli_fetch_array($result)) {
      ?>
        <option value="<?php echo $country_2['Code']; ?>">
                       <?php echo $country_2["Name"]; ?></option>
      <?php
      }
      mysqli_free_result($result);
      ?>
    </select>
  </div>
  <div>
    <label for="cities-list">Select a city:</label>
    <select id="cities-list" name="cities-list" onchange=""></select>
  </div>
  <div>
  <label for="banks-list">Select a bank:</label>
    <select id="banks-list" name="banks-list" onchange=""></select>
  </div>
  <!-- TODO(SMY): Write a function query -->
  <p>Countries with less than 8,000,000 population:</p> 

  <hr>
  <h1>Countary Table</h1>
  <table id="tblCountries" class="display" width="100%"></table>

  <script>
    // Convert php $countries array to javascript countries array
    <?php
    $countries_json = json_encode($countries);
    echo "var countries = " . $countries_json . ";";
    ?>
  </script>
  <script src="js/country_contents_loader.js"></script>
  <script>
    $(document).ready(function(){
      populateTable();
    });

    function populateTable(){
      $("#tblCountries").DataTable({
        data : countries,
        "columns" : [
          { "data" : "Name" },
          { "data" : "Region" },
          { "data" : "Continent" },
          { "data" : "Capital" },
          { "data" : "SurfaceArea" },
          { "data" : "Population" },
          { "data" : "IndepYear" },
          { "data" : "LifeExpectancy" },
          { "data" : "HeadOfState" },
          { "data" : "LocalName" },
          { "data" : "Code" },
          { "data" : "Code2" },
          { "data" : "GNP" },
          { "data" : "GNPOld" },
          { "data" : "raGovernmentFormce" }
        ]
      });
    }
  </script>

</body>

</html>