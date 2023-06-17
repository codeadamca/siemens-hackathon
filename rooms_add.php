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
    
    $query = 'INSERT INTO rooms (
        name,
        floor
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['floor'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    $id = mysqli_insert_id( $connect );
    
    set_message( 'Floor has been added' );
    
  }
  
  header( 'Location: rooms.php' );
  die();
  
}

?>

<h2>Add Sensor Type</h2>

<form method="post">
  
  <label for="name">Name:</label>
  <input type="text" name="name" id="name">
    
  <br>

  <label for="floor">Floor:</label>
  <input type="text" name="floor" id="floor">
    
  <br>
  
  <input type="submit" value="Add Room">
  
</form>

<p><a href="rooms.php"><i class="fas fa-arrow-circle-left"></i> Return to Room List</a></p>


<?php

include( 'includes/footer.php' );

?>