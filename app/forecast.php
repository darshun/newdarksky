<?php
  // Get the address from the form and sanitize it
  $address = htmlspecialchars($_POST["location"]);

  // Replace any spaces in the url with a plus symbol
  // using the str_replace() PHP function
  $address = str_replace(' ', '+', $address);

  // Get a Google Maps API key, and store it here
  // https://developers.google.com/maps/documentation/geocoding/get-api-key
  $google_key = $keys['google'];

  // Send the address to Google to get an array of geo data
  $address_url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key='.$google_key;


  // Convert the Google Geo data to an array
  $address_data = json_decode(file_get_contents($address_url), true);

  // Optional, uncomment to see the data array
  // echo '<pre>';
  // print_r($address_data);
  // echo '</pre>';

  // Get the latitude and longitude array from the Google Geo data
  $coordinates = $address_data['results'][0]['geometry']['location'];

  // Put the array values into a string
  $coordinates = $coordinates['lat'].','.$coordinates['lng'];

  // Get the place name from the Google Geo data — we'll echo it later
  $place = $address_data['results'][0]['address_components'][0]['long_name'];

  // Get the formatted address from the Google Geo data
  $formatted_address = $address_data['results'][0]['formatted_address'];

  // Call DarkSky and pass along the coordinates we got from Google
  $forecast = 'https://api.darksky.net/forecast/'.$keys['darksky'].'/'.$coordinates.'/?exclude=minutely?exclude=hourly?lang=es';

  // Get our forecast data back
  $forecast = json_decode(file_get_contents($forecast), true);
