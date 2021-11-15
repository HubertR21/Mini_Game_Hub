<?php
	define("SITE_ADDR", ".");
    //index magicznie sprawia że stronka wyświetla się od razu po przejściu do folderu
	$title = 'member system tutorial | HeyTuts.com';
	
	// check to see if there is a user already logged in
	session_start();
	if (isset($_SESSION['username']) && isset($_SESSION['userid']))
		$LOGGED_IN = true;
	else
		$LOGGED_IN = false;
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		
		<title><?php echo $title; ?></title>
		
		<!-- link to the stylesheets -->
		<link rel="stylesheet" type="text/css" href="<?php echo SITE_ADDR; ?>/main.css"></link>
		<!--<link rel="stylesheet" type="text/css" href="<?php echo SITE_ADDR; ?>/style/font-awesome/css/font-awesome.css"></link>-->
	</head>
	
	<body>
		
		<div id="wrapper">
			
			<div id="top_header">
				
				<div id="nav">
					<a href="<?php echo SITE_ADDR; ?>/login.php">Login</a> | 
					<a href="<?php echo SITE_ADDR; ?>/register.php">Register</a>
				</div>
				
				<div id="logo">
					<h1><a href="<?php echo SITE_ADDR; ?>/">Member System</a></h1>
				</div>
				
			</div>

			<div id="main" class="box-shadow">
		
				<div id="content">

				<?php
					if ($LOGGED_IN == true){
						echo 'Hello '.$_SESSION['username'].', how are you today?<br /><br />';
						
						// get the user's account information from the database
						$query = mysql_query("SELECT * FROM users WHERE id='{$_SESSION['userid']}'");
						if (mysql_num_rows($query) == 1){
							$_USER = mysql_fetch_assoc($query);
							
							echo 'Your account was created on: <u>'.date("M d, Y", $_USER['date_created']).'</u><br /><br />';
							echo 'You last logged in at <i>'.date("g:i A (T)", $_USER['last_login']).'</i> on <i>'.date("M d, Y", $_USER['last_login']).'</i><br />';
						}
						else
							echo 'Unable to load your account information. Please logout and log back in.';
					}
					else{
						echo 'Please login to your account to see some super cool stuff!';
					}
				?>

				</div>
			</div>

			<div id="footer">

				<div class="left">
					created by <a href="https://www.heytuts.com/web-dev" target="_blank">HeyTuts.com</a>. &copy; 2019
				</div>

				<div class="right">
					<a href="https://www.heytuts.com/web-dev/php/create-a-member-system-in-php">read the article</a> | 
					<a href="https://www.heytuts.com/video/php-member-system">watch the videos</a>
				</div>

				<div class="clear"></div>
			</div>
		</div>
		
	</body>
	
</html>
