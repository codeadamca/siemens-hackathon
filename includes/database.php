<?php

$connect = mysqli_connect( "localhost","<DB_USERNAME>","<DB_PASSWORD>", "<DB_DATABASE>" );

mysqli_set_charset( $connect, 'UTF8' );

// mysqli_query( $connect, 'SET character_set_results=utf8' );
