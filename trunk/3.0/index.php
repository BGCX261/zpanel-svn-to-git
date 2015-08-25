<?php
$loginpage = 1;
include ('includes/hub.php');


// Handle the login process
if (isset($_POST['username'])) {
	
	$dbcall = $DB->GetRow("SELECT * FROM accounts WHERE username='".Clean($_POST['username'],1)."' AND password='".md5($_POST['password'])."'");

	if (count($dbcall) > 0) {
		// Are they suspended?
		if ($dbcall['status'] == 1) {
			// The user exists and password matches, create session
			$_SESSION['username'] = $dbcall['username'];
			$_SESSION['password'] = $_POST['password'];

			die('<script language="javascript">window.location="zpanel.php";</script>You\'re logged in, but don\'t have javascript enabled. Most of ZPanel will not work correctly without Javascript. Please enable it.<br /><br />To continue, <a href="zpanel.php">click here</a>.');
		}else{
			$alert = 'Your account is currently suspended. Please contact support.';
		}
	}else{
ini_set('display_errors', 'yes');
		LogFailure(Clean($_POST['username'],1));	
		$alert = 'That username or password is incorrect.';
	}

}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title><?=$config['company']?> &bull; ZPanel Login</title>
		<link rel="stylesheet" type="text/css" href="style.css" title="Default">
	</head>

	<body>
	<form action="index.php" method="post" name="login">
		<div id="topbar"><a href="http://www.thezpanel.com" target="_blank">ZPanel</a> v3.0.001</div>
		
		<div id="logincontainer">
			<div id="zplogo"></div>
			
			<span>Login</span>
			<p>Welcome to the <?=$config['company']?> control panel.</p>
			<p>
				Username<br /><input type="text" name="username" /><br />
				Password<br /><input type="password" name="password" />
				<br />
			</p>
			<p>
				<input type="submit" value="Login" style="float: right;" />
				<!--<a href="#">Lost Password</a>-->
			</p>
		</div>
		<?php if (isset($alert)) { echo '<br /><br /><font color="red">'.$alert.'</font'; }?>
	</form>

	<script language="javascript">
		document.login.username.focus();
	</script>

	</body>
</html>
