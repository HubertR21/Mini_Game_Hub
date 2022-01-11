<?php
	require_once("config.php");

	session_start();
	if (isset($_SESSION['username']) && isset($_SESSION['userid']))
    		$LOGGED_IN = true;
    	else
    		$LOGGED_IN = false;

    //connecting to the data base
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWD, DB_NAME);
    //setting users from js (you need to post it from js)
    $user1 = NULL;
    $user2 = NULL;
    $sql2 = mysqli_query($conn,"SELECT * FROM tictactoe WHERE (user1 = $user1 AND user2 = $user2)
                                       AND id = (SELECT max(id) FROM tictactoe WHERE (user1 = $user1 AND user2 = $user2))");
    // testing
    $emparray = array();
    while ($row = mysqli_fetch_assoc($query)) {
       $emparray[] = $row;
    }
    echo json_encode($emparray);
?>