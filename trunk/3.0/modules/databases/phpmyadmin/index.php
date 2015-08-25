<?php
// This application needs to know the location (URL) of your phpmyadmin installation

$location = 'http://www.zee-way.com/myadmin/';
?>
<div id="mod_phpmyadmin">
	<div id="logo">&nbsp;</div>
	phpMyAdmin is an open source software which can be found <a href="http://www.phpmyadmin.net" target="_blank">here</a>. As a customer, we have it installed to give you great administration abilities for your MySQL databases with us.

	<form name="login_form" method="post" action="<?=$location?>index.php" target="_blank">
		<input type="hidden" name="collation_connection" value="utf8_unicode_ci" />
		<input type="hidden" name="convcharset" value="iso-8859-1" />
		<input type="hidden" name="db" value="" />
		<input type="hidden" name="table" value="" />
		<input type="hidden" name="server" value="1" />
		<input type="hidden" name="lang" value="en-iso-8859-1" />
		<input type="hidden" name="pma_username" value="<?=$user['username']?>" />
		<input type="hidden" name="pma_password" value="<?=$_SESSION['password']?>" />
		<input type="submit" name="submit" value="Login Now" />
	</form>
</div>
