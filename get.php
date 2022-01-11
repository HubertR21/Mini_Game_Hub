<?php
    // ten plik sprawia że udaje sięwypisać jsona i przekazać go generalnie dalej (jak klikniesz w Dots and boxes gdy jesteś w tictactoe to
    // się wyświetli) GetReal.php ma mieć poprawne zapytanie do bazy odnośnie gierki i całą tą logikę. Na razie nie mam lepszego pomysłu na
    // debugowanie zapytań niz robienie href i sprawdzanie co zwraca nam ten php
	require_once("config.php");

	session_start();
	if (isset($_SESSION['username']) && isset($_SESSION['userid']))
    		$LOGGED_IN = true;
    	else
    		$LOGGED_IN = false;

    //connecting to the data base
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWD, DB_NAME);
    //getting all records for us and our enemy
    /*$query = mysqli_query($conn, "SELECT * FROM tictactoe WHERE (user1 = '{$_SESSION['userid']}' AND user2 = '{$_SESSION['enemy']}')
    AND (user1 = '{$_SESSION['enemy']}' AND user2 = '{$_SESSION['userid']}')");
    */
    // testing
    $sql = mysqli_query($conn, "SELECT * FROM users");
    //$result = mysqli_query($conn, $sql) or die("Error in Selecting ".mysqli_error($conn));
    $emparray = array();
    while ($row = mysqli_fetch_assoc($sql)) {
       $emparray[] = $row;
    }
    echo json_encode($emparray);
    //echo "XDD";
?>