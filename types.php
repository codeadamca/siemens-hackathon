<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM sensorTypes
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
  
  mysqli_query( $connect, 'DELETE FROM sensors WHERE typeId = '.$_GET['delete'] );
  
  set_message( 'Sensor Type has been deleted' );
  
  header( 'Location: types.php' );
  die();
  
}

$query = 'SELECT *,
  (
    SELECT COUNT(id)
    FROM sensors
    WHERE sensors.typeId = sensorTypes.id
  ) AS sensors
  FROM sensorTypes
  ORDER BY abbreviation';
$result = mysqli_query( $connect, $query );

?>

<h2>Manage Sensor Types</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Abbreviation</th>
    <th>Units</th>
    <th>Range</th>
    <th>Sensors</th>
    <th></th>
    <th></th>
  </tr>
  <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td><?php echo $record['id']; ?></td>
      <td>
        <?php echo htmlentities( $record['abbreviation'] ); ?>
        <br>
        <small>
          <strong>Description:</strong> <?php echo htmlentities( $record['description'] ); ?>
          <br>
          <strong>Sample:</strong> <?php echo htmlentities( $record['sample'] ); ?>
        </small>
      </td>
      <td><?php echo htmlentities( $record['units'] ); ?></td>
      <td>
        <?php if( $record['rangeFrom'] or $record['rangeTo'] ): ?>
          <?php echo $record['rangeFrom']; ?> to <?php echo $record['rangeTo']; ?>
        <?php endif; ?>
      </td>
      <td><?php echo htmlentities( $record['sensors'] ); ?></td>
      <td align="center"><a href="types_edit.php?id=<?php echo $record['id']; ?>"><i class="fas fa-edit"></i></a></td>
      <td align="center">
        <a href="types.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this sensor type?');"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

<p><a href="types_add.php"><i class="fas fa-plus-square"></i> Add Sensor Type</a></p>


<?php

include( 'includes/footer.php' );

?>