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
  mysqli_close($conn);
  if ($DEBUG) {
    echo '<pre>';
    print_r($countries);
    echo '</pre>';
  }
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

</head>

<body>
  <h1>Server-Client Project (Countries)</h1>
  <hr>
  <!-- Create a country select menu -->
  <?php echo '<p>There are ' . count($countries) . ' countries in the database.'; ?>
  <div>
    <label for="country-list">Select a country:</label>
    <select id="country-list" name="country-list" onchange="updateDisplayedCountryInfo(this)">
      <?php foreach ($countries as $country) {
        echo '<option value="' . $country['Name'] . '">' . $country['Name'] . '</option>';
      } ?>
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

  <script>
    // Convert php $countries array to javascript countries array
    <?php
    $countries_json = json_encode($countries);
    echo "var countries = " . $countries_json . ";";
    ?>
  </script>
  <script src="js/country_contents_loader.js"></script>

</body>

</html>