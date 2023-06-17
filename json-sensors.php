<?php

header('Access-Control-Allow-Origin: *'); 

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

$query = 'SELECT sensorTypes.id,
  sensorTypes.abbreviation,
  sensorTypes.description,
  sensorTypes.explanation,
  sensorTypes.units,
  sensorTypes.rangeFrom,
  sensorTypes.rangeTo
  FROM sensorTypes
  ORDER BY sensorTypes.abbreviation';
$result = mysqli_query( $connect, $query );

$types = array();

while( $record = mysqli_fetch_assoc( $result ) )
{
  foreach( $record as $key => $value )
  {
    $record[$key] = htmlentities( $value );
  }
  $types[$record['id']] = $record;
}

$query = 'SELECT rooms.id,
  rooms.name,
  rooms.floor
  FROM rooms
  ORDER BY rooms.name';
$result = mysqli_query( $connect, $query );

$rooms = array();

while( $record = mysqli_fetch_assoc( $result ) )
{
  foreach( $record as $key => $value )
  {
    $record[$key] = htmlentities( $value );
  }
  $rooms[$record['id']] = $record;
}

$query = 'SELECT sensors.id,
  sensors.name,
  sensors.campus,
  sensors.building,
  sensors.typeId,
  sensors.roomId,
  (
    SELECT count(data.id)
    FROM data
    WHERE data.sensorId = sensors.id
  ) AS data
  FROM sensors
  ORDER BY sensors.name';
$result = mysqli_query( $connect, $query );

$data = array();

while( $record = mysqli_fetch_assoc( $result ) )
{
  
  if( $record['roomId'] ) $record['room'] = $rooms[$record['roomId']];
  if( $record['typeId'] ) $record['type'] = $types[$record['typeId']];
  
  $data[$record['id']] = $record;
  
}

if( isset( $_GET['sample'] ) )
{
  pre( $data );  
}
else
{

  if( isset( $_GET['callback'] ) ) echo $_GET['callback'].'(';

  echo json_encode( $data );

  if( isset( $_GET['callback'] ) ) echo ')';

}

?>