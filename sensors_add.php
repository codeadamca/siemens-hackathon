<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_POST['name'] ) )
{
  
  if( $_POST['name'] )
  {
    
    $query = 'INSERT INTO sensors (
        name,
        campus,
        building,
        roomId,
        typeId
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
         "'.$_POST['campus'].'",
         "'.$_POST['building'].'",
         "'.$_POST['roomId'].'",
         "'.$_POST['typeId'].'"
      )';
    mysqli_query( $connect, $query );
    
    $id = mysqli_insert_id( $connect );
    
    set_message( 'Sensor has been added' );
    
  }
  
  header( 'Location: sensors.php' );
  die();
  
}

?>

<h2>Add Sensor</h2>

<form method="post">
  
  <label for="campus">Campus:</label>
  <?php
  
  $values = array( 'N' );
  
  echo '<select name="campus" id="campus">';
  foreach( $values as $key => $value )
  {
    echo '<option value="'.$value.'"';
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
    echo '>'.$value.'</option>';
  }
  echo '</select>';
  
  ?>
    
  <br>
  
  <label for="name">Name:</label>
  <input type="text" name="name" id="name">
    
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
    echo '<option value="'.$room['id'].'">'.htmlentities( $room['name'] ).'</option>';
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
    echo '<option value="'.$type['id'].'">'.htmlentities( $type['abbreviation'] ).'</option>';
  }
  echo '</select>';
  
  ?>
    
  <br>
  
  <input type="submit" value="Add Sensor">
  
</form>

<p><a href="sensors.php"><i class="fas fa-arrow-circle-left"></i> Return to Sensor List</a></p>


<?php

include( 'includes/footer.php' );

?>