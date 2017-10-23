<?php
  // Get the address from the form and sanitize it
  $address1 = htmlspecialchars($_POST["location1"]);
  $address2 = htmlspecialchars($_POST["location2"]);
  $address3 = htmlspecialchars($_POST["location3"]);

  // Replace any spaces in the url with a plus symbol
  // using the str_replace() PHP function
  $address1 = str_replace(' ', '+', $address1);
  $address2 = str_replace(' ', '+', $address2);
  $address3 = str_replace(' ', '+', $address3);

  // Get a Google Maps API key, and store it here
  // https://developers.google.com/maps/documentation/geocoding/get-api-key
  $google_key = $keys['google'];

  // Send the address to Google to get an array of geo data
  $address_url1 = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address1.'&key='.$google_key;
  $address_url2 = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address2.'&key='.$google_key;
  $address_url3 = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address3.'&key='.$google_key;

var_dump($address_url1);

  // Convert the Google Geo data to an array
  $address_data1 = json_decode(file_get_contents($address_url1), true);
  $address_data2 = json_decode(file_get_contents($address_url2), true);
  $address_data3 = json_decode(file_get_contents($address_url3), true);

  // Optional, uncomment to see the data array
  // echo '<pre>';
  // print_r($address_data1);
  // echo '</pre>';

  // Get the latitude and longitude array from the Google Geo data
  $coordinates1 = $address_data1['results'][0]['geometry']['location'];
  $coordinates2 = $address_data2['results'][0]['geometry']['location'];
  $coordinates3 = $address_data3['results'][0]['geometry']['location'];

  // Put the array values into a string
  $coordinates1 = $coordinates1['lat'].','.$coordinates1['lng'];
  $coordinates2 = $coordinates2['lat'].','.$coordinates2['lng'];
  $coordinates3 = $coordinates3['lat'].','.$coordinates3['lng'];

// var_dump='coordinates';

  // Get the place name from the Google Geo data — we'll echo it later
  $place1 = $address_data1['results'][0]['address_components'][0]['long_name'];
  $place2 = $address_data2['results'][0]['address_components'][0]['long_name'];
  $place3 = $address_data3['results'][0]['address_components'][0]['long_name'];

  // Get the formatted address from the Google Geo data
  $formatted_address1 = $address_data1['results'][0]['formatted_address'];
  $formatted_address2 = $address_data2['results'][0]['formatted_address'];
  $formatted_address3 = $address_data3['results'][0]['formatted_address'];

  // Call DarkSky and pass along the coordinates we got from Google
  $forecast1 = 'https://api.darksky.net/forecast/'.$keys['darksky'].'/'.$coordinates1.'/?exclude=minutely?exclude=hourly?lang=es';
  $forecast2 = 'https://api.darksky.net/forecast/'.$keys['darksky'].'/'.$coordinates2.'/?exclude=minutely?exclude=hourly?lang=es';
  $forecast3 = 'https://api.darksky.net/forecast/'.$keys['darksky'].'/'.$coordinates3.'/?exclude=minutely?exclude=hourly?lang=es';
  // echo '<pre>';
  // print_r($forecast1);
  // echo '</pre>';
  // Get our forecast data back
  $forecast1 = json_decode(file_get_contents($forecast1), true);
  $forecast2 = json_decode(file_get_contents($forecast2), true);
  $forecast3 = json_decode(file_get_contents($forecast3), true);
