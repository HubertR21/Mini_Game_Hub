<?php
	require_once("config.php");

	$title = 'Login Page | member system tutorial | HeyTuts.com';

	session_start();
	#if (isset($_SESSION['username']) && isset($_SESSION['userid']))
	#	header("Location: ./index.php"); // redirect the user to the home page
	
	// check to see if the user clicked the login button
	if (isset($_POST['loginBtn'])){
		// get the form data for processing
		$username = $_POST['username'];
		$passwd = $_POST['passwd'];
		
		// make sure the required fields were entered
		if ($username != "" && $passwd != ""){
			
			// connect to the database
			$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWD, DB_NAME);

			// query the database to see if the username exists
			$query = mysqli_query($conn, "SELECT * FROM users WHERE username='{$username}'");
			if (mysqli_num_rows($query) == 1){
				// get the record from the query
				$record = mysqli_fetch_assoc($query);
				
				// encrypt the user's password
				$passwd = md5($passwd);
				
				// compare the passwords to make sure they match
				if ($passwd === $record['password']){
					// make sure the user has activated their account
					if ($record['status'] == 1){
						
						// update the last_login tracker
						$last_login = time();
						mysqli_query($conn, "UPDATE users SET last_login='{$last_login}' WHERE id='{$record['id']}'");
						
						/* IF YOU GET HERE THE USER CAN LOGIN */
						
						$_SESSION['username'] = $record['username'];
						$_SESSION['userid'] = $record['id'];
						
						$success = true;
						
						// redirect the user to the home page
						header("Location: ./MiniGameHubMenu.php");
					}
					else
						$error_msg = 'Please activate your account before you login.';
				}
				else
					$error_msg = 'Your password was incorrect.';
			}
			else
				$error_msg = 'That account does not exist.';
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
    		<title>Mini Game Hub: Log in</title>
    	</head>
	
	<body>
		
	    <div class="logo_bg_small">
                    <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: left;" >
                    <img class="logo_small" src="./images/Logo.png" alt="Mini Game Hub" width="20%" height="20%" style="float: right;" >

                    <h1 class="logo_text" > Log in </h1>

                    <a class="logo_text" href="MiniGameHubMenu.html"> Menu </a>
        </div>

			<div class="insides">

					<?php
						// check to see if the user successfully created an account
						if (isset($success) && $success = true){
							echo '<p color="green">You have logged in. Please go to the <a href="'.SITE_ADDR.'/index.php">home page</a>.<p>';
						}
						// check to see if the error message is set, if so display it
						else if (isset($error_msg))
							echo '<p color="red">'.$error_msg.'</p>';	
					?>
					
					<form action="" method="POST" name="loginForm">
						<fieldset>
                        <legend> Log in </legend>
						<table>
							<tr>
								<td>Username: <font color="red">*</font></td>
							</tr>
							<tr>
								<td><input type="text" value="" name="username" /></td>
							</tr>
							<tr>
								<td>Password: <font color="red">*</font></td>
							</tr>
							<tr>
								<td><input type="password" value="" name="passwd" /></td>
							</tr>
							<tr>
								<td>
									<input type="submit" name="loginBtn" value="Login" />
									</br> <font color="red">*</font> = required fields
								</td>
							</tr>
						</table>
						</fieldset>
					</form>

				</center></div>

			</div>
		</div>
		
	</body>
	
</html>
