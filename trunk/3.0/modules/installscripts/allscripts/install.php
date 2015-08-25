<?php
// Get selected package 
$pkg = $DB->GetRow("SELECT * FROM zantastico WHERE id='".Clean($_GET['id'],1)."'");

if (!isset($_GET['start'])) {

/* ROOT MYSQL INFORMATION */
// This must be correct, as this part of the script requires this much access
$root_user = '';
$root_pass = '';
$webserver = ''; // If DB is on a different machine, specify the hostname or IP
                  // of your web server.

// If you didn't set anything, lets use the default
if ($root_user == '') { $root_user = $settings['zp_user']; $root_pass = $settings['zp_pass']; }
if ($webserver == '') { $webserver = $settings['zp_host']; }

// Get list of databases
$ADMDB = NewADOConnection($settings['zp_dbtype']."://$root_user:$root_pass@$webserver/mysql");
$databases = $ADMDB->GetAll("SELECT * FROM db WHERE User = '".$user['username']."'");
$dbcount = $ADMDB->GetOne("SELECT COUNT(*) FROM db WHERE User = '".$user['username']."'");

?><h1>Installation Wizard</h1>
<p>You are now installing: <b><?=$pkg['name'].' '.$pkg['version']?></b></p>

<form action="?cat=installscripts&page=allscripts&install&id=<?=$pkg['id']?>&start" method="post">

<?php if ($pkg['instructions'] != '') { ?>
<!-- Give the user instructions  -->
<fieldset class="confirmation">
<legend>Instructions</legend>
<p><?=$pkg['instructions']?></p>
</fieldset>
<?php } ?>

<!-- Get location information -->
<fieldset class="confirmation">
<legend>Location</legend>
<p>Where would you like to install <?=$pkg['name']?>?</p>
<p><b><?=$user['webaddy']?></b>/<input type="textbox" name="path" value="<?=$pkg['exampledir']?>"/></p>
</fieldset>

<?php if ($pkg['sql'] != '') { ?>
<!-- Get db information -->
<fieldset class="confirmation">
<legend>Database</legend>
<p>What database would you like to install this application into?</p>
<p>Database:
<?php if ($dbcount > 0) {?>	<select name="db">
<?php while ($db = $dbcountresult->fetch(FETCH_ASSOC)) { ?>		<option><?=$db['Db']?></option>
<?php } echo '</select>'; }else{ echo 'None Available'; } ?> (<a href="?cat=databases&page=mysql">Create New</a>)
</p>
</fieldset>
<?php } ?>

<p><input type="submit" name="install" value="Install Now" /></p>
</form>
<?php

# END SHOWING OF FORM
}else{
# BEGIN INSTALL PROCESS
?>
<h1>Now Installing <?=$pkg['name'].' '.$pkg['version']?></h1>
<p id="pkg_install_wait"><img src="images/wait.gif" /> Please wait while the package is installed.</p>
<?php
ob_flush();
flush();

$given = str_replace('../','',$_POST['path']);
$webaddy = $user['webaddy'].'/'.$given.'/';

$zipfile = $settings['path'].'/modules/installscripts/archives/'.$pkg['zip'];
$dest = $user['homedir'].'/'.$given.'/';

unzip($zipfile,$dest);

?>
<p><b><?=$pkg['name']?></b> has been installed successfully. You can access it by going to the following web address:<p>
<p><a href="<?=$webaddy?>" target="_blank"><?=$webaddy?></a></p>
<br /><br />
<center><p><a href="?cat=installscripts&page=allscripts">Return to Installers</a></p></center>
<script language="javascript">
	document.getElementById("pkg_install_wait").style.display='none';
</script>
<?php
}
?>
