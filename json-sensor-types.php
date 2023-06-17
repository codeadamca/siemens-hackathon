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
  sensorTypes.rangeTo,
  (
    SELECT count(sensors.id)
    FROM sensors
    WHERE sensors.typeId = sensorTypes.id
  ) AS sensors
  FROM sensorTypes
  ORDER BY sensorTypes.abbreviation';
$result = mysqli_query( $connect, $query );

$data = array();

while( $record = mysqli_fetch_assoc( $result ) )
{
  
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