<?php
	require_once("config.php");

	session_start();
	if (isset($_SESSION['username']) && isset($_SESSION['userid']))
    		$LOGGED_IN = true;
    	else
    		$LOGGED_IN = false;

    //connecting to the data base
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWD, DB_NAME);
    //informing that we are queuing for the game
    $query = mysqli_query($conn, "UPDATE users SET tic_state=1 WHERE id='{$_SESSION['userid']}'");
    //debugging
    print mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE tic_state=1 AND username!='{$_SESSION['username']}'"));
    //setting i as a timeout period (i_max)
    $i=0;
    $i_max = 15;
    // seting querries to DB every second to see if someone new wants to play (who is not us)
    while( mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE tic_state=1 AND username!='{$_SESSION['username']}'")) == 0 && $i < $i_max){
        sleep(1);
        $i=$i+1;
    }
    //debugging
    $text_query = "SELECT * FROM users WHERE tic_state=1 AND username!='{$_SESSION['username']}'";
    print $text_query;
    print $i;
    //if we reached timeout setting querrying state to 0
    if($i == $i_max){
        mysqli_query($conn, "UPDATE users SET tic_state=0 WHERE id='{$_SESSION['userid']}'");
    }
    // if there is another user who wants to play we go here
    if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE tic_state=1 AND username!='{$_SESSION['username']}'")) != 0){
        //we select second users id
        $query = mysqli_query($conn, "SELECT * FROM users WHERE tic_state=1 AND username!='{$_SESSION['username']}'");
        $record = mysqli_fetch_assoc($query);
        $user2 = $record['id'];
        sleep(2);
        // update searching state for the user to 0
        mysqli_query($conn, "UPDATE users SET tic_state=0 WHERE id='{$_SESSION['userid']}'");
        sleep(2);
        // define our id, time and randomize whose the first turn is
        $user1 = $_SESSION['userid'];
        $time = time();
        $turn = rand(1,2);
        $id = 'DEFAULT';
        // adds first record into the database
        mysqli_query($conn, "INSERT INTO tictactoe VALUES({$id},{$user1},{$user2},{$turn},{$time},0,0,0,0,0,0,0,0,0)");
        //debugging
        $text_query = "INSERT INTO tictactoe VALUES({$id},{$user1},{$user2},{$turn},{$time},0,0,0,0,0,0,0,0,0)";
        print $text_query;
        // go toward the game subsite
        header("Location: ./TicTacToeMulti.php");
    }

?>
<!DOCTYPE
html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Mini Game Hub: Tic Tac Toe Connecting</title>
</head>
<body>
    <div class="logo_bg_small">
        <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: left;" >
        <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: right;" >

        <h1 class="logo_text" >
        <?php
            if ($LOGGED_IN == true){
                echo 'Connecting TicTacToe, ' ;
                echo 'User: '.$_SESSION['username']. '';
                }else{
                echo 'Unable to connect ';
                }
        ?>
        </h1>

        <a class="logo_text" href="TicTacToe.php"> Go Offline </a>

</body>
</html>