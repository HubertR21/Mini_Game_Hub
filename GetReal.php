<?php
	require_once("config.php");

	session_start();
	if (isset($_SESSION['username']) && isset($_SESSION['userid']))
    		$LOGGED_IN = true;
    	else
    		$LOGGED_IN = false;

    //connecting to the data base
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWD, DB_NAME);
    //getting all records for us and our enemy
    $query = mysqli_query($conn, "SELECT * FROM tictactoe WHERE (user1 = {$_SESSION['userid']} AND user2 = {$_SESSION['enemy_id']})
    AND (user1 = {$_SESSION['enemy_id']} AND user2 = {$_SESSION['userid']})");
    // testing
    $emparray = array();
    while ($row = mysqli_fetch_assoc($query)) {
       $emparray[] = $row;
    }
    echo json_encode($emparray);
?>