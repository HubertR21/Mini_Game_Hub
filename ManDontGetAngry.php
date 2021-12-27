  <?php
  	require_once("config.php");

  	session_start();
  	if (isset($_SESSION['username']) && isset($_SESSION['userid']))
      		$LOGGED_IN = true;
      	else
      		$LOGGED_IN = false;

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="style.css" type="text/css">
      <title>Mini Game Hub: Dont Get Angry</title>
  </head>
  <body>
  <div class="logo_bg_small">
      <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: left;" >
      <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: right;" >

      <h1 class="logo_text" >
       <?php
           if ($LOGGED_IN == true){
               echo 'Dont Get Angry, ' ;
               echo 'User: '.$_SESSION['username']. '';
               }else{
               echo 'Dont Get Angry ';
               }
       ?>
       </h1>

      <a class="logo_text" href="MiniGameHubMenu.php"> Menu </a>

  </div>

  <div class="insides">
      <h1> About the game </h1>
      <p>
          Dont Get Angry (German: Mensch ärgere Dich nicht Man) is a German board game (but not a German-style board game), developed by Josef Friedrich Schmidt in 1907/1908. Some 70 million copies have been sold since its introduction in 1914 and it is played in many European countries.
          <br>
          The name derives from the fact that a peg is sent back to the "out" field when another peg lands on it, similar to the later game Sorry!. It is a cross and circle game with the circle collapsed onto the cross, similar to the Indian game Pachisi, the Colombian game Parqués, the American games Parcheesi and Trouble, and the English game Ludo.
      </p>
  </div>



  </body>
  </html>