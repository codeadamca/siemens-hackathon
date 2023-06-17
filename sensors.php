<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM sensors
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
  
  set_message( 'Sensor has been deleted' );
  
  header( 'Location: sensors.php' );
  die();
  
}

$query = 'SELECT sensors.*,
  sensorTypes.abbreviation AS typeAbbreviation,
  rooms.name AS roomName,
  (
    SELECT COUNT(id)
    FROM data
    WHERE data.sensorId = sensors.id
  ) AS data
  FROM sensors
  LEFT JOIN rooms ON rooms.id = sensors.roomId
  LEFT JOIN sensorTypes ON sensorTypes.id = sensors.typeId
  ORDER BY sensors.name';
$result = mysqli_query( $connect, $query )

?>

<h2>Manage Sensors</h2>

<table>
  <tr>
    <th>Name</th>
    <th>Campus</th>
    <th>Building</th>
    <th>Type</th>
    <th>Room</th>
    <th>Data</th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td><?php echo htmlentities( $record['name'] ); ?></td>
      <td><?php echo htmlentities( $record['campus'] ); ?></td>
      <td><?php echo htmlentities( $record['building'] ); ?></td>
      <td><?php echo htmlentities( $record['typeAbbreviation'] ); ?></td>
      <td><?php echo htmlentities( $record['roomName'] ); ?></td>
      <td><?php echo htmlentities( $record['data'] ); ?></td>
      <td align="center"><a href="sensors_edit.php?id=<?php echo $record['id']; ?>"><i class="fas fa-edit"></i></a></td>
      <td align="center">
        <a href="sensors.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this sensor?');"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="sensors_add.php"><i class="fas fa-plus-square"></i> Add Sensor</a></p>


<?php

include( 'includes/footer.php' );

?>