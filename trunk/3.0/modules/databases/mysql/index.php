<?php
	$webserver='%';

	if (isset($settings['db_super_user'])) {
		$dbuser = $settings['db_super_user'];
		$dbpass = $settings['db_super_user'];
		$dbhost = $settings['db_external_host'];
	}else{
		$dbuser = $settings['zp_user'];
		$dbpass = $settings['zp_pass'];
		$dbhost = $settings['zp_host'];
	}

	$ADMDB = NewADOConnection("mysqli://$dbuser:$dbpass@$dbhost/mysql");

	$databases = $ADMDB->GetAll("SELECT * FROM db WHERE User = '".$user['username']."'");
	$dbcount = $ADMDB->GetOne("SELECT COUNT(*) FROM db WHERE User = '".$user['username']."'");
	
	if (isset($_POST['Add'])) {
		// Lets make sure the user has databases available
		if ($dbcount >= $package['maxsql']) {
			// Looks like they can't, redirect them to the overlimit message
			echo ("<script language=javascript>document.location.href = '?cat=databases&page=mysql&overlimit'</script>");
		}else{
			// They're not over, check if db exists
			$dbcount = $ADMDB->GetOne("SELECT COUNT(*) FROM db WHERE Db = '".$user['username'].'_'.$_POST['dbname']."'");

			if ($dbcount == 0) {
				$dbname = $user['username'].'_'.$_POST['dbname'];
				$dbname_grant = $user['username'].'_'.$_POST['dbname'];
				// db doesn't exist, add it
				$sql = $ADMDB->Execute("CREATE DATABASE `$dbname`;");
				
				// Set permissions
				$sql = $ADMDB->Execute("INSERT INTO db (Host, Db, User)  VALUES ('".$webserver."','$dbname','root');");
				
                                $sql = $ADMDB->Execute("GRANT USAGE ON *.* TO '".$user['username']."'@'".$webserver."' IDENTIFIED BY '".$_SESSION['password']."';");

                                $sql = $ADMDB->Execute("UPDATE user SET password=PASSWORD('".$_SESSION['password']."') WHERE user='".$user['username']."';");

                                $sql = $DB->Execute("GRANT ALL ON `$dbname_grant`.* TO '".$user['username']."'@'".$webserver."';");
                                $sql = $DB->Execute("FLUSH PRIVILEGES;");

				// Redirect and present the user with a 'successful' message
				echo ("<script language=javascript>document.location.href = '?cat=databases&page=mysql&added'</script>");
			}else{
				// db exists, issue an error
				echo ("<script language=javascript>document.location.href = '?cat=databases&page=mysql&inuse'</script>");
			}
		}
	}

	if (isset($_GET['delete'])) {
		// Make sure this DB belongs to them
		$dbcount = $ADMDB->GetOne("SELECT COUNT(*) FROM db WHERE db = '".$_GET['db']."' AND user='".$user['username']."'");
		
		if ($dbcount != 0) {
			// It belongs to them, drop it
			$sql = @$ADMDB->Execute("DROP DATABASE ".$_GET['db']);
			
			// Remove from db table
			$sql = $ADMDB->Execute("DELETE FROM db WHERE db='".$_GET['db']."'");
			
			// Redirect and present the user with a 'successful' message
			echo ("<script language=javascript>document.location.href = '?cat=databases&page=mysql&deleted'</script>");
		}else{
			// db exists, issue an error
			echo ("<script language=javascript>document.location.href = '?cat=databases&page=mysql&badowner'</script>");
		}
	}

	
	if (isset($_GET['added'])) {
?>
<div id="warning"><div><div><div>
Your new database has been added successfully.
</div></div></div></div>
<?php
	}else if (isset($_GET['deleted'])) {
?>
<div id="warning"><div><div><div>
Your database has been deleted.
</div></div></div></div>
<?php
	}else if (isset($_GET['overlimit'])) {
?>
<div id="warning"><div><div><div>
<b>Error:</b> You are currently at your limit for databases. You must delete a database before attempting to create another.
</div></div></div></div>
<?php
	}else if (isset($_GET['inuse'])) {
?>
<div id="warning"><div><div><div>
<b>Error:</b> The database you tried to add is currently in use. Please try again with a different name.
</div></div></div></div>
<?php
	}else if (isset($_GET['badowner'])) {
?>
<div id="warning"><div><div><div>
<b>Error:</b> Unable to delete database because you aren't the owner.
</div></div></div></div>
<?php
	}
	
	if (isset($_GET['deleteconf'])) {
?>
<fieldset class="confirmation">
<legend>Confirmation</legend>
Are you sure you would like to delete the database <b><?=$_GET['db']?></b>? All of the data currently in this database will be deleted.<br /> <br />

<center><a href="?cat=databases&page=mysql&delete&db=<?=$_GET['db']?>">Yes, delete</a> | <a href="?cat=databases&page=mysql">No, cancel</a></center>
</fieldset>
<?php
	}else{
?>
<div id="mysql_dbcontainer">
        <fieldset>
                <legend>Current Databases</legend>
<?php if (!empty($databases)) {
foreach ($databases as $value) { ?>
                <li>
<?php if ($value['Drop_priv'] == 'Y') {?>                   <div id='delete'><a href="?cat=databases&page=mysql&deleteconf&db=<?=$value['Db']?>">delete</a></div><?php } ?>
                        <div id='database'><?=$value['Db']?></div>

                </li>
<?php } }else{ echo '<li>None yet...</li>'; } ?>
        </fieldset>
</div>
<div id="mysql_information">
	<p>This page alows you to create and remove databases. After creating the database, you can then administer the tables it will contain by visiting the <a href="?cat=databases&page=phpmyadmin">phpMyAdmin</a> module.</p>
	<fieldset><legend>Usage</legend>You currently are using <b><?=$dbcount?></b> databases. You are allowed a max of <b><?=$package['maxsql']?></b>.</fieldset>
	<form action="?cat=databases&amp;page=mysql" method="post" enctype="multipart/form-data">
		<p>
	  <h1>Add a New Database</h1><br />
			<b>Database name:</b> <?=$user['username']?>_<input name="dbname" type="text" size="8" maxlength="16" /> 
			<input name="Add" type="submit" value="Add" />
		</p>
  </form>
</div>
<?php } ?>
<div id="mysql_bottom_padding">&nbsp;</div>
