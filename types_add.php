<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_POST['abbreviation'] ) )
{
  
  if( $_POST['abbreviation'] )
  {
    
    $query = 'INSERT INTO sensorTypes (
        sample,
        abbreviation,
        description,
        explanation,
        units,
        rangeFrom,
        rangeTo
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['sample'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['abbreviation'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['description'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['explanation'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['units'] ).'",
         "'.( $_POST['rangeFrom'] ? $_POST['rangeFrom'] : 0 ).'",
         "'.( $_POST['rangeTo'] ? $_POST['rangeTo'] : 0 ).'"
      )';
    mysqli_query( $connect, $query );
    
    $id = mysqli_insert_id( $connect );
    
    set_message( 'Sensor Type has been added' );
    
  }
  
  header( 'Location: types.php' );
  die();
  
}

?>

<h2>Add Sensor Type</h2>

<form method="post">
  
  <label for="abbreviation">Abbreviation:</label>
  <input type="text" name="abbreviation" id="abbreviation">
    
  <br>

  <label for="sample">Sample:</label>
  <input type="text" name="sample" id="sample">
    
  <br>
  
  <label for="description">Description:</label>
  <input type="text" name="description" id="description">
    
  <br>
  
  <label for="explanation">Explanation:</label>
  <textarea type="text" name="explanation" id="explanation" rows="10"></textarea>
  
  <br>

  <label for="units">Units:</label>
  <input type="text" name="units" id="units">
    
  <br>

  <label for="rangeFrom">Range From:</label>
  <input type="text" name="rangeFrom" id="rangeFrom">
    
  <br>

  <label for="rangeTo">Range To:</label>
  <input type="text" name="rangeTo" id="rangeTo">
    
  <br>
  
  <input type="submit" value="Add Sensor Type">
  
</form>

<p><a href="types.php"><i class="fas fa-arrow-circle-left"></i> Return to Sensor Type List</a></p>


<?php

include( 'includes/footer.php' );

?>