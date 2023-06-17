<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_FILES['file'] ) )
{
  
  if( $_FILES['file']['error'] == 0 )
  {
    
    $floor = substr( $_FILES['file']['name'], strpos( $_FILES['file']['name'], 'CTI' ) + 4, 1 );
    
    $csv = csv_to_array( $_FILES['file']['tmp_name'] );
      
    $data  = array();
    $sensors = array();
    $points = array();
    
    foreach( $csv as $key => $value )
    {
      
      // Skip headers
      if( $key >= 1 )
      {
          
        $query = 'INSERT IGNORE INTO weather (
            date,
            pressureStation,
            pressureSea,
            windDir,
            windDir10s,
            windSpeed,
            windGust,
            relativeHumidity,
            dewPoint,
            temperature,
            windchill,
            humidex,
            visibility,
            healthIndex
          ) VALUES (
            "'.str_replace( ' EST', '', $value[0] ).'",
            "'.$value[2].'",
            "'.$value[3].'",
            "'.$value[4].'",
            "'.$value[5].'",
            "'.$value[6].'",
            "'.$value[7].'",
            "'.$value[8].'",
            "'.$value[9].'",
            "'.$value[10].'",
            "'.$value[11].'",
            "'.$value[12].'",
            "'.$value[13].'",
            "'.$value[14].'"
          )'; 
        mysqli_query( $connect, $query );  

      }

    }

    set_message( 'Import has been completed' );
    
  }
  else
  {
    set_message( 'There was an error uploading the import file' );
  }
  
  header( 'Location: dashboard.php' );
  die();
  
}

?>

<h2>Import</h2>

<form method="post" enctype="multipart/form-data">
  
  <label for="file">File:</label>
  <input type="file" name="file" id="file">
  
  <br>
  
  <input type="submit" value="Import">
  
</form>

<p><a href="articles.php"><i class="fas fa-arrow-circle-left"></i> Return to Article List</a></p>


<?php

include( 'includes/footer.php' );

?>