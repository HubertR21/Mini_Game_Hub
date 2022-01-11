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
    $fake_enemy_id = 9; //dla ussr
    // query któym znajdujemy ostatni wpisany rekord - działa!
    $sql = mysqli_query($conn, "SELECT * FROM tictactoe WHERE ((user1 = {$_SESSION['userid']} AND user2 = $fake_enemy_id)
                                   OR (user2 = {$_SESSION['userid']} AND user1 = $fake_enemy_id))
                                   AND id = (SELECT max(id) FROM tictactoe WHERE (user1 = {$_SESSION['userid']} AND user2 = $fake_enemy_id)
                                   OR (user2 = {$_SESSION['userid']} AND user1 = $fake_enemy_id))");
    // teraz po jendorazowym wczytaniu tego obaj użytkownicy dowiadują się którym userem są (czy user1 czy user2) zapamiętują
    // tę informację, sprawdzamy czyja jest tura i ten gracz zaczyna

    // zdefiniujmy expilcite, że chodzi nam o grę z taką kolejnością userów - działa
    $user1 = 9;
    $user2 = 7;

    $sql2 = mysqli_query($conn,"SELECT * FROM tictactoe WHERE (user1 = $user1 AND user2 = $user2)
                                   AND id = (SELECT max(id) FROM tictactoe WHERE (user1 = $user1 AND user2 = $user2))");
    //tutaj mamy już logikę po stronie jsa która określa czy jest nasza tura korzystając z parametru turn
    //(1 oznacza ture user1, 2 oznacza ture user2)

    // zdefiniujmy że jest tura 1 (ussr)
    $turn = 1;
    // dokonamy teraz aktualizacji ruchu gdzie dajemy X (1) na pierwszym polu
    $time = time();
    $id = 'DEFAULT';
    //to działa, ale nie dodawajmy teraz w nieskończoność więc jest zakomentowane
    //mysqli_query($conn, "INSERT INTO tictactoe VALUES({$id},{$user1},{$user2},{$turn},{$time},1,0,0,0,0,0,0,0,0)");

    $emparray = array();
    while ($row = mysqli_fetch_assoc($sql)) {
       $emparray[] = $row;
    }
    echo json_encode($emparray);
    //echo "XDD";
?>