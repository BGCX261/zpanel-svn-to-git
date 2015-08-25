<?php
if (isset($_GET['delconf'])) {
?>
<fieldset class="confirmation">
<legend>Confirmation</legend>
Are you sure you would like to delete the subdomain <b><?=$_GET['dom']?></b>? All of your files will remain on your accout.<br /> <br />

<center><a href="?cat=<?=$_GET['cat']?>&page=<?=$_GET['page']?>&delete&dom=<?=$_GET['dom']?>">Yes, delete</a> | <a href="?cat=<?=$_GET['cat']?>&page=<?=$_GET['page']?>">No, cancel</a></center>
</fieldset>
<?php
        exit;
}

if (isset($_GET['delete'])) {
        // Remove maindomain and subdomains
	$DB->Execute("DELETE FROM domains WHERE user='".$user['username']."' AND domain='".Clean($_GET['dom'],1)."' OR user='".$user['username']."' AND masterdomain='".Clean($_GET['dom'],1)."'");

        // Restart Apache
        CreateVH();

        // Redirect to conf message
        echo '<script language="javascript">window.location = "?cat='.$_GET['cat'].'&page='.$_GET['page'].'&deleted"</script>';
}

// Get subdomains
$result = $DB->GetAll("SELECT * FROM domains WHERE parked!=1 AND masterdomain!='' AND user='".$user['username']."' ORDER BY masterdomain ASC, domain ASC");

// Get domains
$domresult = $DB->GetAll("SELECT * FROM domains WHERE parked!=1 AND masterdomain='' AND user='".$user['username']."' ORDER BY domain ASC");

function parse_dir($dir,$path=0) {
   if ($dh = @opendir($dir)) {
       while(($file = readdir($dh)) !== false) {
          if( !preg_match('/^\./s', $file) )  {
             if (is_dir($dir.'/'.$file)) {
                if ($path) {
                        if ($path == '/'.$file.'/') {
                                echo "<option SELECTED>/$file/</option>";
                        }else{
                                echo "<option>/$file/</option>";
                        }
                }else{
                        echo "<option>/$file/</option>";
                }
             }
          }
       }
   }
}

function DomStatus($dom,$path) {
	global $user;

	// Perform NS lookup
	$nslookup = strtolower(shell_exec("nslookup -timeout=1 $dom"));

	ini_set('default_socket_timeout', 1);
	$handle = @fopen("http://zwayradio.com/getip.php", "rb");
	$ip = @fread($handle, 8192);

	if (strpos($nslookup,$ip) !== false) {
		// The IP is set correctly, verify that the domain is pointing to the right location
		$testfile = $user['homedir'].$path.'zpdomtest.php';
		$testurl = 'http://'.$dom.'/zpdomtest.php';
		touch ($testfile);

		$handle = @fopen("http://zwayradio.com/testfile.php?dom=".$dom, "rb");
        	$response = @fread($handle, 8192);

		if ($response == 'passed') {
			unlink ($testfile);
			return '<font color="green">Verified</td>';
		}else{
			unlink ($testfile);
			return '<font color="red"><span title="Could not verify path">Unverified</span></font>';
		}
	}else{
		return '<font color="red"><span title="Domain doesn\'t resolve to '.$ip.'">Unverified</span></font>';
	}
}
?><script language="javascript">
function AddSubdomain() {
	var status = document.getElementById("add_domain_status").innerHTML;
	var master = document.addform.masterdomain.value;
	var domain = document.addform.domain.value + "." + master;
	var path = document.addform.path.value;

	status = '<img src="images/wait.gif">Adding subdomain, please wait...';

	// Add domain
	xajax_AddSubdomain(domain,master,path);
}
function EditSubdomain() {
        var status = document.getElementById("add_domain_status").innerHTML;
        var domain = document.editform.domain.value;
        var path = document.editform.path.value;

        status = '<img src="images/wait.gif">Updating subdomain, please wait...';

        // Update domain
        xajax_UpdateDomain(domain,path,'1');
}
</script>

<?php if (isset($_GET['added'])) { ?>
<div id="warning"><div><div><div>
Your new subdomain has been added successfully.
</div></div></div></div>
<?php } ?>

<p>Subdomains allow you to extend the functionality of your domains.</b>

<div id="domstatmsg"><img src="images/wait.gif" /> Loading subdomains...<br /><br /></div>

<?php
	flush();
	ob_flush();

	if (isset($_GET['edit'])) {
		$action = 'Edit';
		$button = 'Save';

		$thisdom = $DB->GetRow("SELECT * FROM domains WHERE user='".$user['username']."' AND domain='".Clean($_GET['edit'],1)."'");
	}else{
		$action = 'Add';
		$button = 'Add';
	}
?>

<form action="javascript:<?=$action?>Subdomain()" name="<?=strtolower($action)?>form">
<h1><?=$action?> a Subdomain</h1>
<table width="100%">
        <tr>
                <td class="fieldname">Domain Name:</td>
                <td><?php if ($action=='Edit') { echo '<b>'.$thisdom['domain'].'</b> (<a href="?cat='.$_GET['cat'].'&page='.$_GET['page'].'&delconf&dom='.$thisdom['domain'].'">Delete Subdomain</a>) <input type="hidden" name="domain" value="'.$thisdom['domain'].'" />'; }else{?><input name="domain" type="textbox" size="10" /><b>.</b><select name='masterdomain' id='masterdomain'><?php foreach ($domresult AS $master) {?><option><?=$master['domain']?></option><?php } ?></td><?php } ?>
        </tr>
	<tr>
		<td class="fieldname">Path:</td>
		<td><select name="path"><option value="/" <?php if ($action=='Edit') { if ($thisdom['path'] == '/') { echo 'SELECTED '; } }?>>[root]</option><?php if ($action=='Edit') { parse_dir($user['homedir'],$thisdom['path']); }else{ parse_dir($user['homedir']); }?></select></td>
	</tr>
	<tr>
		<td><input type="submit" id="Add" value="<?=$button?>"></td>
		<td><div id="add_domain_status"></div></td>
	<tr>
</table>
</form>
<br />
<h1>Current Subdomains</h1>
<table width="100%">
        <tr style="font-weight: 800;">
                <td>Subdomain</td>
                <td>Date Added</td>
                <td>Path</td>
		<td>Status</td>
                <td>Options</td>
        </tr>
<?php
        if (count($result) > 0) {
                $count = 0;
                foreach ($result AS $row) {
                        if ($count==0) { $style=' class="highlightrow"'; $count=1; }else{ $style=''; $count=0; }
?>      <tr<?=$style?>>
                <td><?=$row['domain']?></td>
                <td><?=date("m-d-Y",$row['date'])?></td>
                <td><?=$row['path']?></td>
		<td><?=DomStatus($row['domain'],$row['path'])?></td>
                <td><a href="?cat=domainadmin&page=subdomains&edit=<?=$row['domain']?>"><img src="modules/domainadmin/images/edit.gif" border="0" alt="Edit" /></a></td>
        </tr>
<?php
			flush();
                }
        }else{
                echo '<tr><td colspan="4">You have no subdomains at this time.</td></tr>';
        }
?>
</table>
<script language="javascript">document.getElementById("domstatmsg").style.display="none";</script>
