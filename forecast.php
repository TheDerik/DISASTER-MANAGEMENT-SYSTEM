<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: login.php");
}
?>




<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Weather Forecast</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script3.js" defer></script>
    <script>
      function showRainAlert(city, temperature, wind, humidity) {
        if (humidity > 70) {
          alert(`Rain Alert!\nCity: ${city}\nTemperature: ${temperature}°C\nWind: ${wind} M/S\nHumidity: ${humidity}%`);
        }
      }

      // This function will be called when the user clicks the "Search" button
      function searchWeather() {
        const cityInput = document.querySelector(".city-input");
        const cityName = cityInput.value.trim();

        // Assume these values for demonstration, replace with actual weather data
        const temperature = 20;
        const wind = 5;
        const humidity = 80;

        // Call the alert function with weather data
        showRainAlert(cityName, temperature, wind, humidity);
      }
    </script>
  </head>
  <body>
    <h1>Weather Dashboard</h1>
    <div class="container">
      <div class="weather-input">
        <h3>Enter a City Name</h3>
        <input class="city-input" type="text" placeholder="E.g., New York, London, Tokyo">
        <button class="search-btn" onclick="searchWeather()">Search</button>
        <div class="separator"></div>
        <button class="location-btn" onclick="searchWeather()">Use Current Location</button>
      </div>
      <div class="weather-data">
        <div class="current-weather">
          <div class="details">
            <h2>_______ ( ______ )</h2>
            <h6>Temperature: __°C</h6>
            <h6>Wind: __ M/S</h6>
            <h6>Humidity: __%</h6>
          </div>
        </div>
        <div class="days-forecast">
          <h2>5-Day Forecast</h2>
          <ul class="weather-cards">
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Temp: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidity: __%</h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Temp: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidity: __%</h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Temp: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidity: __%</h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Temp: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidity: __%</h6>
            </li>
            <li class="card">
              <h3>( ______ )</h3>
              <h6>Temp: __C</h6>
              <h6>Wind: __ M/S</h6>
              <h6>Humidity: __%</h6>
            </li>
          </ul>
        </div>
      </div>
    </div>
    
  </body>
</html>