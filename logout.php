<?php
	require_once("./config.php");

	// verify the user is logged in
	session_start();
	if (isset($_SESSION['username']) && isset($_SESSION['userid'])){
		
		/* IF YOU ARE HERE THEN THE USER IS LOGGED IN, AND WE CAN LOG THEM OUT */
		session_destroy();
		
		// redirect to the home page
		header("Location: ./MiniGameHubMenu.php");
	}
	else
		header("Location: ./login.php"); // redirect the user to the login page
	
?>