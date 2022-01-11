<?php
	require_once("config.php");

	session_start();
	if (isset($_SESSION['username']) && isset($_SESSION['userid']))
    		$LOGGED_IN = true;
    	else
    		$LOGGED_IN = false;

    //connecting to the data base
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWD, DB_NAME);
    //we need to get those from js post method. Move also
    $id = NULL;
    $user1 = NULL;
    $user2 = NULL;
    $turn = NULL;
    $time = time();
    $id = 'DEFAULT';
    mysqli_query($conn, "INSERT INTO tictactoe VALUES({$id},{$user1},{$user2},{$turn},{$time},1,0,0,0,0,0,0,0,0)");
?>