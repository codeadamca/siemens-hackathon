<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: sensors.php' );
  die();
  
}

if( isset( $_POST['name'] ) )
{
  
  if( $_POST['name'] )
  {
    
    $query = 'UPDATE sensors SET
      name = "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
      campus = "'.$_POST['campus'].'",
      building = "'.$_POST['building'].'",
      roomId = "'.$_POST['roomId'].'",
      typeId = "'.$_POST['typeId'].'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Sensor has been updated' );
    
  }

  header( 'Location: sensors.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM sensors
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: sensors.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );

}

?>

<h2>Edit Sensor</h2>

<form method="post">
  
  <label for="campus">Campus:</label>
  <?php
  
  $values = array( 'N' );
  
  echo '<select name="campus" id="campus">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    if( $key == $record['campus'] ) echo ' selected="selected"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <label for="building">Building:</label>
  <?php
  
  $values = array( 'CTI' );
  
  echo '<select name="building" id="building">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
    if( $key == $record['building'] ) echo ' selected="selected"';
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
    
  <label for="name">Name:</label>
  <input type="text" name="name" id="name" value="<?php echo htmlentities( $record['name'] ); ?>">
    
  <br>

  <label for="roomId">Room:</label>
  <?php
  
  $query = 'SELECT id,name
    FROM rooms
    ORDER BY name';
  $result = mysqli_query( $connect, $query );
  
  echo '<select name="roomId" id="roomId">';
  while( $room = mysqli_fetch_assoc( $result ) )
  {
    echo '<option value="'.$room['id'].'"';
    if( $room['id'] == $record['roomId'] ) echo ' selected="selected"';
    echo '>'.htmlentities( $room['name'] ).'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <label for="typeId">Type:</label>
  <?php
  
  $query = 'SELECT id,abbreviation
    FROM sensorTypes
    ORDER BY abbreviation';
  $result = mysqli_query( $connect, $query );
  
  echo '<select name="typeId" id="typeId">';
  while( $type = mysqli_fetch_assoc( $result ) )
  {
    echo '<option value="'.$type['id'].'"';
    if( $type['id'] == $record['typeId'] ) echo ' selected="selected"';
    echo '>'.htmlentities( $type['abbreviation'] ).'</option>';
  }
  echo '</select>';
  
  ?>
  
  <br>
  
  <input type="submit" value="Edit Sensor">
  
</form>

<p><a href="sensors.php"><i class="fas fa-arrow-circle-left"></i> Return to Sensot List</a></p>


<?php

include( 'includes/footer.php' );

?>