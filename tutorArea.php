<!-- STUTOR TUTOR LOGIN PAGE-->
<!-- CREATED BY KATELYN BIESIADECKI WITH THE EXTREME HELP OF CODE.TUTSPLUS.COM -->

<?php include "mysql_connect.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Management System</title>
<link rel="stylesheet" href="style.css" type = "text/css" />
</head>
<body>
<div id="main">
	<?php
		//Direct to member area: you have successfully signed in!
		
		if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])){
			?>
			
			<h1>Tutor Area</h1>
			<h1><code><?=$_SESSION['FirstName']?></code> <code><?=$_SESSION['LastName']?></code></h1>
			<p>Thanks for logging in! </p>
			<p>Name: <code><?=$_SESSION['FirstName']?></code> <code><?=$_SESSION['LastName']?></code></p>
			<p>Username: <code><?=$_SESSION['Username']?></code></p>
			<p>Email Address: <code><?=$_SESSION['EmailAddress']?></code>.</p>
			<p>School: <code><?=$_SESSION['School']?></code></p>
			<p>Average Rate: <code><?=$_SESSION['AvgRate']?></code>.</p>
			<p>test</p>
			<p><a href = "logout.php">Logout</a></p>
			
			<?php
		}
		
	//Log-in: If you are not already logged in
	//Will either redirect you to member area or send an error message
	
	elseif(!empty($_POST['username']) && !empty($_POST['password'])){
		$username = mysql_real_escape_string($_POST['username']);
		$md5pass = md5(mysql_real_escape_string($_POST['password']));
		$sha1pass = sha1($md5pass);
		$password = crypt($sha1pass, "sp");
		
		//IN THE FUTURE: PLEASE FURTHER PASSWORD PROTECT USING SECURITY.PHP FILE!!
		//IN THE FUTURE: PLEASE FURTHER CHECK MYSQL_REAL_ESCAPE_STRING!!!
		//IN THE FUTURE: PLEASE FURTHER CHECK HOW TO SALT PASSWORDS!
		//
		//
		//
		
		$checklogin = mysql_query("SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'");
		
		if(mysql_num_rows($checklogin) == 1){
			$row = mysql_fetch_array($checklogin);
			$email = $row['EmailAddress'];
			$firstname = $row['FirstName'];
			$lastname = $row['LastName'];
			$school = $row['School'];
			$avgrate = $row['AvgRate'];
			
			$_SESSION['Username'] = $username;
			$_SESSION['EmailAddress'] = $email;
			$_SESSION['FirstName'] = $firstname;
			$_SESSION['LastName'] = $lastname;
			$_SESSION['School'] = $school;
			$_SESSION['AvgRate'] = $avgrate;
			$_SESSION['LoggedIn'] = 1;
			
			echo "<h1>Success</h1>";
			echo "<p>We are now redirecting you to the member area now.</p>";
			echo "<meta http-equiv='refresh' content = '2; tutorArea.php' />";
		}
		else{
			echo "<h1>Error</h1>";
			echo "<p>Sorry, your account could not be found. Please <a href=\"tutorArea.php\">click here to try again</a>.</p>";
		
		}
	}
	
	//Generic Log-in page
	else{
		?>
		
		<h1>Tutor Login</h1>
		
		<p>Thanks for visiting! Please either login below, or <a href="registerTutor.php">click here to register</a>.</p>
			
		<form method = "post" action="tutorArea.php" name = "loginform" id="loginform">
		<fieldset>
			<label for="username">Username:</label><input type = "text" name = "username" id = "username" /><br />
			<label for="password">Password:</label><input type = "password" name = "password" id = "password" /><br />
			<input type = "submit" name = "login" id = "login" value = "Login" />
		</fieldset>
		</form>
		
		<?php
	}
	?>
	
</div>
</body>
</html> 