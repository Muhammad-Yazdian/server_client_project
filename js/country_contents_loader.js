/* 
 * File:    country_contents_loader.js
 * 
 * Author:  S. Muhammad Yazdian (muhammad.yazdian@gmail.com) 
 * Date:    2021-10-26 
 * 
 * Summary of File: 
 * 
 *   This file contains code which updates the value of HTML 
 *   tags in index.php file
 */

//console.log(countries);
console.log(countries[0]);

function updateDisplayedCountryInfo(countryId){
  countaryInfo = countries[countryId.value];
  console.log(countries[countryId.value]);
  document.getElementById("country-name").textContent = countaryInfo['Name'];
  document.getElementById("country-code").textContent = countaryInfo['Code'];
  document.getElementById("country-population").textContent = countaryInfo['Population'];
  document.getElementById("country-capital").textContent = countaryInfo['Capital'];
}

function updateDisplayedCountryInfo2(countryCode) {
  //alert(countryCode.value);
  $.ajax({
    url: "cities_by_country.php",
    type: "POST",
    data: {country_code: countryCode.value},
    cache: false,
    success: function(response) {
      document.getElementById("cities-list").innerHTML = response;
      document.getElementById("banks-list").innerHTML = 
      '<option>Select a banck</option>';
      //Or you can use a simple format using jQuery
      //$('#cities-list').html(response);
      //$('#banks-list').html('<option>Select a banck</option>');
    }
  });
}