<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

?>

  <h2>JSON Feeds</h2>

  <h3>Sensor Types</h3>
  <p><a href="json-sensor-types.php"><i class="fas fa-rss"></i> http://siemenshackathon.professoradamthomas.com/json-sensor-types.php</a></p>
  <p><a href="json-sensor-types.php?sample"><i class="fas fa-search"></i> View Sample Data</a>

  <h3>Sensors</h3>
  <p><a href="json-sensors.php"><i class="fas fa-rss"></i> http://siemenshackathon.professoradamthomas.com/json-sensors.php</a></p>
  <p><a href="json-sensors.php?sample"><i class="fas fa-search"></i> View Sample Data</a>

  <h3>Rooms</h3>
  <p><a href="json-rooms.php"><i class="fas fa-rss"></i> http://siemenshackathon.professoradamthomas.com/json-rooms.php</a></p>
  <p><a href="json-rooms.php?sample"><i class="fas fa-search"></i> View Sample Data</a>
    
  <hr>  

  <h3>Weather</h3>
  <p><a href="json-weather.php"><i class="fas fa-rss"></i> http://siemenshackathon.professoradamthomas.com/json-weather.php</a></p>
  <p><a href="json-weather.php?sample"><i class="fas fa-search"></i> View Sample Data</a>
    
  <h3>Lighting</h3>
  <p><a href="json-lights.php?floor=1"><i class="fas fa-rss"></i> http://siemenshackathon.professoradamthomas.com/json-lights.php?floor=1</a></p>
  <p><a href="json-lights.php?sample&floor=1"><i class="fas fa-search"></i> View Sample Data</a>

  <hr>
    
  <h2>Feeds by Individual Sensor</h2>

  <?php

  $query = 'SELECT *
    FROM sensors
    ORDER BY sensors.name';
  $result = mysqli_query( $connect, $query )
 
  ?>
    
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
  
    <h3><?php echo $record['name']; ?></h3>
    <p><a href="json-sensor-data.php?id=<?php echo $record['id']; ?>"><i class="fas fa-rss"></i> http://siemenshackathon.professoradamthomas.com/json-sensor-data.php?id=<?php echo $record['id']; ?></a></p>
    <p><a href="json-sensor-data.php?id=<?php echo $record['id']; ?>&sample"><i class="fas fa-search"></i> View Sample Data</a>
      
  <?php endwhile; ?>


  <?php

include( 'includes/footer.php' );

?>