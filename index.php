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
  <!--   
    This is just a static template. Later on, populate the list based on 
    countries in DB
  -->  
  <div>
    <label for="country-list">Select a country:</label>
    <select id="country-list" name="country-list">
      <option value="China">China</option>
      <option value="Iran">Iran</option>
      <option value="Switzerlander">Switzerlander</option>
      <option value="United States">Unites States</option>
      <option value="Others">Others</option>
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

</body>

</html>