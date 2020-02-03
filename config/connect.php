<?php

function db_connect()
 {
	static $connection;
	$hostname = "localhost"; //server
	$username = "YourDatabaseUserName";
	$password = "YourDatabasePassword";
	$dbname = "YourDatabaseName";

    $connection = mysqli_connect("localhost","YourDatabaseUserName","YourDatabasePassword","YourDatabaseName");

	if($connection === false) {
		return mysqli_connect_error();
	}
	else {
		return $connection;
		echo "connected...@!!!";
 	}
 }

 function db_query($query) {
    $connection = db_connect();
    $result = mysqli_query($connection,$query);

    if($result === false) {
        return false;
    }
    else {
	    return $result;
	}
}

function db_select($query) {
    $rows = array();
    $result = db_query($query);

    if($result === false) {
        return false;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function db_error() {
    $connection = db_connect();
    return mysqli_error($connection);
}

function db_string($value) {
    $connection = db_connect();
    return mysqli_real_escape_string($connection,$value);
}

function db_insert($query) {
    $connection = db_connect();
    $result = mysqli_query($connection,$query);

	if($result === false) {
	    return mysqli_error($connection);
	}
	else {
	    return mysqli_insert_id($connection);
	}
}


 ?>
