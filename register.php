<?php
	require_once("config.php");

	$title = 'Register Page | member system tutorial | HeyTuts.com';

	// check to see if there is a user already logged in, if so redirect them
	session_start();
	#if (isset($_SESSION['username']) && isset($_SESSION['userid']))
	#	header("Location: ".SITE_ADDR."/index.php"); // redirect the user to the home page
	
	// see if the user clicked the register button
	if (isset($_POST['registerBtn'])){
		// get all of the form data
		$username = $_POST['username'];
		$email = $_POST['email'];
		$passwd = $_POST['passwd'];
		$passwd_again = $_POST['passwd_again'];
		
		// verify all the required form data was entered
		if ($username != "" && $passwd != "" && $passwd_again != ""){
			// make sure the two passwords match
			if ($passwd === $passwd_again){
				// make sure the password meets the min strength requirements
				if ( strlen($passwd) >= 5 && strpbrk($passwd, "!#$.,:;()") != false ){

					// connect to the database
					$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWD, DB_NAME);

					// query the database to see if the username is taken
					$query = mysqli_query($conn, "SELECT * FROM users WHERE username='{$username}'");
					print "we're out";
					if (mysqli_num_rows($query) == 0){
						
						// create and format some variables for the database
						$id = 'DEFAULT';
						$passwd = md5($passwd);
						$date_created = 'NULL';#time();
						$last_login = 'NULL';#0;
						$status = 1;

						// insert the user into the database
						mysqli_query($conn, "INSERT INTO users VALUES (
							{$id}, '{$username}', '{$email}', '{$passwd}', {$date_created}, {$last_login}, {$status}
						)");

						$text_query = "INSERT INTO users VALUES ({$id}, '{$username}', '{$email}', '{$passwd}', '{$date_created}', '{$last_login}', {$status})";
						print $text_query;
						print 'We are in';
						// verify the user's account was created
						$query = mysqli_query($conn, "SELECT * FROM users WHERE username='{$username}'");
						if (mysqli_num_rows($query) == 1){
							
							/* IF WE ARE HERE THEN THE ACCOUNT WAS CREATED! YAY! */
							
							$success = true;
						}
						else
							$error_msg = 'An error occurred and your account was not created.';
					}
					else
						$error_msg = 'The username <i>'.$username.'</i> is already taken. Please try another.';
				}
				else
					$error_msg = 'Your password is not strong enough. Please use another.';
			}
			else
				$error_msg = 'Your passwords did not match.';
		}
		else
			$error_msg = 'Please fill out all required fields.';
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Mini Game Hub: Register</title>
	</head>
	
	<body>
		<div class="logo_bg_small">
            <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: left;" >
            <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: right;" >

            <h1 class="logo_text" > Register </h1>

            <a class="logo_text" href="MiniGameHubMenu.html"> Menu </a>

        </div>

		<div class="insides">

					<?php
						// check to see if the user successfully created an account
						if (isset($success) && $success = true){
							echo '<p color="green">Yay!! Your account has been created. <a href="'.SITE_ADDR.'/login.php">Click here</a> to login!<p>';
						}
						// check to see if the error message is set, if so display it
						else if (isset($error_msg))
							echo '<p color="red">'.$error_msg.'</p>';
						
					?>
					
					<form action="" method="POST" name="registerForm">
					    <fieldset>
					    <legend> Register </legend>
						<table>
							</tr>
							<tr>
								<td>Username: <font color="red">*</font></td>
							</tr>
							<tr>
								<td><input type="text" value="" name="username" /></td>
							</tr>
							<tr>
								<td>Email Address:</td>
							</tr>
							<tr>
								<td><input type="text" value="" name="email" /></td>
							</tr>
							<tr>
								<td>Password: <font color="red">*</font></td>
							</tr>
							<tr>
								<td><input type="password" value="" name="passwd" /></td>
							</tr>
							<tr>
								<td>password must be at least 5 characters and  have a special character, e.g. !#$.,:;()
							</tr>
							<tr>
								<td>Confirm Password: <font color="red">*</font></td>
							</tr>
							<tr>
								<td><input type="password" value="" name="passwd_again" /></td>
							</tr>
							<tr>
								<td>
									<input type="submit" name="registerBtn" value="Register" />
									</br> <font color="red">*</font> = required fields
								</td>
							</tr>
						</table>
						</fieldset>
					</form>
		</div>
		
	</body>
	
</html>
