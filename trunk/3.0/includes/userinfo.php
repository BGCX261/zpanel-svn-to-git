<?php
include('adodb/adodb-exceptions.inc.php');
include('adodb/adodb.inc.php');
$server = $settings['zp_host'];
$user = $settings['zp_user'];
$pwd = $settings['zp_pass'];
$db = $settings['zp_db'];

// Choose your connection type
#$DB = NewADOConnection("mysql://$user:$pwd@$server/$db");
$DB = NewADOConnection("mysqli://$user:$pwd@$server/$db?persist");
#$DB = NewADOConnection("mssql://$user:$pwd@$server/$db");
#$DB = NewADOConnection("oracle://$user:$pwd@$server/$db");
#$DB = NewADOConnection("postgres://$user:$pwd@$server/$db");


// Gather user information
if (isset($_SESSION['username'])) {
	$user = $DB->GetRow("SELECT * FROM accounts WHERE username='".$_SESSION['username']."'");
}

// Gather Config
if (!isset($_GET['hostid'])) { $host = 0; }else{ $host = $_GET['hostid']; }
$config = $DB->GetRow("SELECT * FROM config WHERE reseller=".$host);

// Gather package information
if (isset($_SESSION['username'])) {
	if ($user['custom_package'] == 0) {
		$package = $DB->GetRow("SELECT * FROM packages WHERE id='".$user['package']."'");
	}else{
		$package = $DB->GetRow("SELECT * FROM packages_custom WHERE id='".$user['custom_package']."'");
	}
}
?>
