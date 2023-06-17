<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM rooms
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
  
  mysqli_query( $connect, 'DELETE FROM data WHERE roomId = '.$_GET['delete'] );
  
  
  set_message( 'Room has been deleted' );
  
  header( 'Location: rooms.php' );
  die();
  
}

$query = 'SELECT *,
  (
    SELECT COUNT(id)
    FROM sensors
    WHERE sensors.roomId = rooms.id
  ) AS sensors
  FROM rooms
  ORDER BY name';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Datapoints</h2>

<table>
  <tr>
    <th>Room</th>
    <th>Floor</th>
    <th>Sensors</th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td><?php echo htmlentities( $record['name'] ); ?></td>
      <td><?php echo $record['floor']; ?></td>
      <td><?php echo $record['sensors']; ?></td>
      <td align="center"><a href="rooms_edit.php?id=<?php echo $record['id']; ?>"><i class="fas fa-edit"></i></a></td>
      <td align="center">
        <a href="rooms.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this rooms?');"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="rooms_add.php"><i class="fas fa-plus-square"></i> Add Room</a></p>


<?php

include( 'includes/footer.php' );

?>