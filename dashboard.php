<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

?>

<ul id="dashboard">
  <li>
    <a href="rooms.php">
      <i class="fas fa-map-marker-alt fa-3x"></i>
      <br>
      Rooms
    </a>
  </li>
  <li>
    <a href="sensors.php">
      <i class="fas fa-broadcast-tower fa-3x"></i>     
      <br>
      Sensors
    </a>
  </li>
  <li>
    <a href="types.php">
      <i class="fas fa-stream fa-3x"></i>      
      <br>
      Sensor Types
    </a>
  </li>
  <li>
    <a href="import_data.php">
      <i class="fas fa-file-upload fa-3x"></i>
      <br>
      Import Sensor Data
    </a>
  </li>
  <li>
    <a href="import_lighting.php">
      <i class="fas fa-lightbulb fa-3x"></i>
      <br>
      Import Lighting Data
    </a>
  </li>
  <li>
    <a href="import_weather.php">
      <i class="fas fa-cloud fa-3x"></i>
      <br>
      Import Weather Data
    </a>
  </li>
  <!--
  <li>
    <a href="data.php">
      <i class="fas fa-list fa-3x"></i>
      <br>
      Data
    </a>
  </li>
  -->
  <li>
    <a href="json.php">
      <i class="fas fa-rss fa-3x"></i>
      <br>
      JSON Feeds
    </a>
  </li>
  <li>
    <a href="users.php">
      <i class="fas fa-user fa-3x"></i>
      <br>
      Users
    </a>
  </li>
</ul>

<?php

include( 'includes/footer.php' );

?>