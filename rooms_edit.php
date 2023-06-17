<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: rooms.php' );
  die();
  
}

if( isset( $_POST['name'] ) )
{
  
  if( $_POST['name'] )
  {
    
    $query = 'UPDATE rooms SET
      name = "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
      floor = "'.mysqli_real_escape_string( $connect, $_POST['floor'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Room has been updated' );
    
  }

  header( 'Location: rooms.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM rooms
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: rooms.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );

}

?>

<h2>Edit Datapoint</h2>

<form method="post">
  
  <label for="name">Name:</label>
  <input type="text" name="name" id="name" value="<?php echo htmlentities( $record['name'] ); ?>">
    
  <br>
    
  <label for="floor">Floor:</label>
  <input type="text" name="floor" id="floor" value="<?php echo htmlentities( $record['floor'] ); ?>">
    
  <br>
  
  <input type="submit" value="Edit Room">
  
</form>

<p><a href="rooms.php"><i class="fas fa-arrow-circle-left"></i> Return to Room List</a></p>


<?php

include( 'includes/footer.php' );

?>