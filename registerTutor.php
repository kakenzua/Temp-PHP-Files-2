<!-- STUTOR TUTOR REGISTRATION PAGE-->
<!-- CREATED BY KATELYN BIESIADECKI WITH THE EXTREME HELP OF CODE.TUTSPLUS.COM -->

<?php include "mysql_connect.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
 
<title>User Management System</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>  
<body>  
<div id="main">
<?php
if(!empty($_POST['username']) && !empty($_POST['password']))
{
    $username = mysql_real_escape_string($_POST['username']);
    
    $md5pass = md5(mysql_real_escape_string($_POST['password']));
	$sha1pass = sha1($md5pass);
	$password = crypt($sha1pass, "sp");
	
    $email = mysql_real_escape_string($_POST['email']);
    $firstname = mysql_real_escape_string($_POST['firstname']);
    $lastname = mysql_real_escape_string($_POST['lastname']);
    $school = mysql_real_escape_string($_POST['school']);
    $avgrate = mysql_real_escape_string($_POST['avgrate']);
     
     $checkusername = mysql_query("SELECT * FROM users WHERE Username = '".$username."'");
      
     if(mysql_num_rows($checkusername) == 1)
     {
        echo "<h1>Error</h1>";
        echo "<p>Sorry, that username is taken. Please go back and try again.</p>";
     }
     else
     {
        $registerquery = mysql_query("INSERT INTO users (Username, Password, EmailAddress, FirstName, LastName, School, AvgRate) VALUES('".$username."', '".$password."', '".$email."', '".$firstname."', '".$lastname."', '".$school."','".$avgrate."')");
        if($registerquery)
        {
            echo "<h1>Success</h1>";
            echo "<p>Your account was successfully created. Please <a href=\"tutorArea.php\">click here to login</a>.</p>";
        }
        else
        {
            echo "<h1>Error</h1>";
            echo "<p>Sorry, your registration failed. Please go back and try again.</p>";    
        }       
     }
}
else
{
    ?>
     
   <h1>Register Tutors</h1>
     
   <p>Please enter your details below to register.</p>
     
    <form method="post" action="registerTutor.php" name="registerform" id="registerform">
    <fieldset>
        <label for="username">Username:</label><input type="text" name="username" id="username" /><br />
        <label for="password">Password:</label><input type="password" name="password" id="password" /><br />
        <label for="email">Email Address:</label><input type="text" name="email" id="email" /><br />
        <label for="firstname">First Name:</label><input type="text" name="firstname" id="firstname" /><br />
        <label for="lastname">Last Name:</label><input type="text" name="lastname" id="lastname" /><br />
        <label for="school">School:</label><input type="text" name="school" id="school" /><br />
        <label for="avgrate">Average Rate (please enter a number for $/hr):</label><input type="text" name="avgrate" id="avgrate" /><br />
        <input type="submit" name="register" id="register" value="Register" />
    </fieldset>
    </form>
     
    <?php
}
?>
 
</div>
</body>
</html>