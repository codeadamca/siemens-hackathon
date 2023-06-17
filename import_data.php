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
    
    $csv = csv_to_array( $_FILES['file']['tmp_name'] );
      
    $data  = array();
    $sensors = array();
    $points = array();
    
    foreach( $csv as $key => $value )
    {
      
        if( substr( $value[0], 0, 5 ) == 'Point' )
        {
            $query = 'SELECT *
                FROM sensors
                WHERE name = "'.$value[1].'"
                LIMIT 1';
            $result = mysqli_query( $connect, $query );
          
            if( mysqli_num_rows( $result ) )
            {
                $record = mysqli_fetch_assoc( $result );
                $sensors[$record['name']] = $record['id'];
            }
            else
            {
                $query = 'INSERT IGNORE INTO sensors (
                          name,
                          campus,
                          building,
                          typeId,
                          roomId
                      ) VALUES (
                          "'.$value[1].'",
                          "'.data_get_campus( $value[1] ).'",
                          "'.data_get_building( $value[1] ).'",
                          "'.data_get_datapoint( $value[1] ).'",
                          "'.data_get_room( $value[1] ).'"
                      )';  
                  $result = mysqli_query( $connect, $query );
                  $sensors[$value[1]] = mysqli_insert_id( $connect );
            }
          
            $points[str_replace( ':', '', $value[0] )] = $value[1];
          
        }
        elseif( substr_count( $value[0], '/' ) == 2 )
        {

            foreach( $value as $key2 => $value2 )
            {
                if( $key2 > 1 )
                {
                  
                    // echo $value[0].' - '.$value[1].' - '.( $key2 - 1 ).' - '.$value2.' - '.$points['Point_'.( $key2 - 1 )].'<br>';  
                    // pre( $points );
                    // pre( $sensors );
                  
                    $sensor = $points['Point_'.( $key2 - 1 )];

                    $date = DateTime::createFromFormat( 'd/m/Y H:i:s', $value[0].' '.$value[1] );
                    $timestamp = $date->getTimestamp();
                  
                    $query = 'INSERT IGNORE INTO data (
                            sensorId,
                            number, 
                            date
                        ) VALUES (
                            "'.$sensors[$points['Point_'.( $key2 - 1 )]].'",
                            "'.$value2.'",
                            "'.date( 'Y-m-d H:i:s', $timestamp ).'"
                        )';  
                    mysqli_query( $connect, $query );
                      
                }
            }
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