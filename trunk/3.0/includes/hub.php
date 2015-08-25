<?php
$settings = parse_ini_file('/home/zpaneldev/conf/zpanel.conf');
$zpaneldirectory = $settings['path'];

include ('sessionfile.php');

// Check session
if ((!isset($_SESSION['username'])) && (!isset($loginpage))) {
	die ('You\'re not logged in... <a href="index.php">Click here to login</a><script language="javascript">window.location="index.php";</script>');
}

include ('userinfo.php');
include ('functions.php');
?>
