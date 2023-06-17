<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: types.php' );
  die();
  
}

if( isset( $_POST['abbreviation'] ) )
{
  
  if( $_POST['abbreviation'] )
  {
    
    $query = 'UPDATE sensorTypes SET
      abbreviation = "'.mysqli_real_escape_string( $connect, $_POST['abbreviation'] ).'",
      sample = "'.mysqli_real_escape_string( $connect, $_POST['sample'] ).'",
      description = "'.mysqli_real_escape_string( $connect, $_POST['description'] ).'",
      explanation = "'.mysqli_real_escape_string( $connect, $_POST['explanation'] ).'",
      units = "'.mysqli_real_escape_string( $connect, $_POST['units'] ).'",
      rangeFrom = "'.( $_POST['rangeFrom'] ? $_POST['rangeFrom'] : 0 ).'",
      rangeTo = "'.( $_POST['rangeTo'] ? $_POST['rangeTo'] : 0 ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Sensor Type has been updated' );
    
  }

  header( 'Location: types.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM sensorTypes
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: types.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );

}

?>

<h2>Edit Sensor Type</h2>

<form method="post">
  
  <label for="abbreviation">Abbreviation:</label>
  <input type="text" name="abbreviation" id="abbreviation" value="<?php echo htmlentities( $record['abbreviation'] ); ?>">
    
  <br>
    
  <label for="sample">Sample:</label>
  <input type="text" name="sample" id="sample" value="<?php echo htmlentities( $record['sample'] ); ?>">
    
  <br>
  
  <label for="description">Description:</label>
  <input type="text" name="description" id="description" value="<?php echo htmlentities( $record['description'] ); ?>">
    
  <br>
  
  <label for="explanation">Explanation:</label>
  <textarea type="text" name="explanation" id="explanation" rows="5"><?php echo htmlentities( $record['explanation'] ); ?></textarea>
  
  <br>
  
  <label for="units">Units:</label>
  <input type="text" name="units" id="units" value="<?php echo htmlentities( $record['units'] ); ?>">
    
  <br>
  
  <label for="rangeFrom">Range From:</label>
  <input type="text" name="rangeFrom" id="rangeFrom" value="<?php echo htmlentities( $record['rangeFrom'] ); ?>">
    
  <br>
  
  <label for="rangeTo">Range To:</label>
  <input type="text" name="rangeTo" id="rangeTo" value="<?php echo htmlentities( $record['rangeTo'] ); ?>">
    
  <br>
  
  <input type="submit" value="Edit Sensor Type">
  
</form>

<p><a href="types.php"><i class="fas fa-arrow-circle-left"></i> Return to Sensot Type List</a></p>


<?php

include( 'includes/footer.php' );

?>