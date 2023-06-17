<?php

function data_get_room( $sensor )
{
  
    global $connect;
  
    $data = explode( '.', $sensor ); 
    $room = $data[2];
  
    if( $room == 'NATV' ) $room = preg_replace( '/\D/', '', $data[3] );
    
    $query = 'SELECT id
        FROM rooms
        WHERE name = "'.$room.'"
        LIMIT 1';
    $result = mysqli_query( $connect, $query );
  
    if( mysqli_num_rows( $result ) )
    {
        $record = mysqli_fetch_assoc( $result );
        return $record['id'];
    }
    else
    {
        $query = 'INSERT INTO rooms (
                name,
                floor
            ) VALUES (
                "'.$room.'",
                "'.substr( $room, 0, 1 ).'"
            )';
        $result = mysqli_query( $connect, $query );
        return mysqli_insert_id( $connect );
    }
  
}

function data_get_campus( $sensor )
{
  
    $data = explode( '.', $sensor ); 
    return $data[0];
  
}

function data_get_building( $sensor )
{
  
    $data = explode( '.', $sensor ); 
    return $data[1];
  
}

function data_get_datapoint( $sensor )
{
  
    global $connect; 
  
    $data = explode( '.', $sensor ); 
  
    if( $data[2] == 'NATV' )
    {
        $point = $data[4];
    }
    elseif( substr( $data[3], 0, 3 ) == 'MIT' ) 
    {
        $point = $data[4];
    }
    else
    {
        $point = $data[3];
      
        if( strpos( $point, 'CTL TEMP' ) )
        {
            $point = preg_replace( '/[^a-zA-Z\s\:]/', '', $point );
        }
        else
        {
            $point = explode( '_', $point )[0];
        }
    }
  
    $query = 'SELECT id
        FROM sensorTypes
        WHERE abbreviation = "'.$point.'"
        LIMIT 1';
    $result = mysqli_query( $connect, $query );
  
    if( mysqli_num_rows( $result ) )
    {
        $record = mysqli_fetch_assoc( $result );
        return $record['id'];
    }
    else
    {
        $query = 'INSERT INTO sensorTypes (
                abbreviation,
                sample
            ) VALUES (
                "'.$point.'",
                "'.$sensor.'"
            )';
        $result = mysqli_query( $connect, $query );
        return mysqli_insert_id( $connect );
    }
  
}

function csv_to_array( $filename = '', $delimiter = ',' )
{
    if( !file_exists( $filename ) || !is_readable( $filename ) ) return FALSE;

    $data = array();
  
    if( ( $handle = fopen( $filename, 'r' ) ) !== FALSE )
    {
        while( ( $row = fgetcsv( $handle, 1000, $delimiter ) ) !== FALSE )
        {
            $data[] = $row;
        }
        fclose( $handle );
    }
    return $data;
}

function time_elapsed_string( $datetime, $full = false ) 
{
  
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
  
}

/*
function curl_get_contents( $url )
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
*/

function pre( $data )
{
  
  echo '<pre>';
  print_r( $data );
  echo '</pre>';
  
}

function secure()
{
  
  if( !isset( $_SESSION['id'] ) )
  {
    
    header( 'Location: /' );
    die();
    
  }
  
}

function set_message( $message )
{
  
  $_SESSION['message'] = $message;
  
}

function get_message()
{
  
  if( isset( $_SESSION['message'] ) )
  {
    
    echo '<p style="padding: 0 1%;" class="error">
        <i class="fas fa-exclamation-circle"></i> 
        '.$_SESSION['message'].'
      </p>
      <hr>';
    unset( $_SESSION['message'] );
    
  }
  
}