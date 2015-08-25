<?php
if (isset($_GET['delconf'])) {
?>
<fieldset class="confirmation">
<legend>Confirmation</legend>
Are you sure you would like to delete the domain <b><?=$_GET['dom']?></b>? All of the subdomains associated with this domain will also be removed. However, all of your files will remain on your accout.<br /> <br />

<center><a href="?cat=<?=$_GET['cat']?>&page=<?=$_GET['page']?>&delete&dom=<?=$_GET['dom']?>">Yes, delete</a> | <a href="?cat=<?=$_GET['cat']?>&page=<?=$_GET['page']?>">No, cancel</a></center>
</fieldset>
<?php
	exit;
}

if (isset($_GET['delete'])) {
	// Remove maindomain and subdomains
	$sql = $DB->Execute("DELETE FROM domains WHERE user='".$user['username']."' AND domain='".Clean($_GET['dom'],1)."' OR user='".$user['username']."' AND masterdomain='".Clean($_GET['dom'],1)."'");

	// Restart Apache
	CreateVH();
	
	// Redirect to conf message
	echo '<script type="text/javascript">window.location = "?cat='.$_GET['cat'].'&page='.$_GET['page'].'&deleted"</script>';
}

// Get domains
$result = $DB->GetAll("SELECT * FROM domains WHERE parked!=1 AND masterdomain='' AND user='".$user['username']."' ORDER BY domain ASC");


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
?><script type="text/javascript">
function checkDomain(nname)
{
var arr = new Array(
'.com','.net','.org','.biz','.coop','.info','.museum','.name',
'.pro','.edu','.gov','.int','.mil','.ac','.ad','.ae','.af','.ag',
'.ai','.al','.am','.an','.ao','.aq','.ar','.as','.at','.au','.aw',
'.az','.ba','.bb','.bd','.be','.bf','.bg','.bh','.bi','.bj','.bm',
'.bn','.bo','.br','.bs','.bt','.bv','.bw','.by','.bz','.ca','.cc',
'.cd','.cf','.cg','.ch','.ci','.ck','.cl','.cm','.cn','.co','.cr',
'.cu','.cv','.cx','.cy','.cz','.de','.dj','.dk','.dm','.do','.dz',
'.ec','.ee','.eg','.eh','.er','.es','.et','.fi','.fj','.fk','.fm',
'.fo','.fr','.ga','.gd','.ge','.gf','.gg','.gh','.gi','.gl','.gm',
'.gn','.gp','.gq','.gr','.gs','.gt','.gu','.gv','.gy','.hk','.hm',
'.hn','.hr','.ht','.hu','.id','.ie','.il','.im','.in','.io','.iq',
'.ir','.is','.it','.je','.jm','.jo','.jp','.ke','.kg','.kh','.ki',
'.km','.kn','.kp','.kr','.kw','.ky','.kz','.la','.lb','.lc','.li',
'.lk','.lr','.ls','.lt','.lu','.lv','.ly','.ma','.mc','.md','.mg',
'.mh','.mk','.ml','.mm','.mn','.mo','.mp','.mq','.mr','.ms','.mt',
'.mu','.mv','.mw','.mx','.my','.mz','.na','.nc','.ne','.nf','.ng',
'.ni','.nl','.no','.np','.nr','.nu','.nz','.om','.pa','.pe','.pf',
'.pg','.ph','.pk','.pl','.pm','.pn','.pr','.ps','.pt','.pw','.py',
'.qa','.re','.ro','.rw','.ru','.sa','.sb','.sc','.sd','.se','.sg',
'.sh','.si','.sj','.sk','.sl','.sm','.sn','.so','.sr','.st','.sv',
'.sy','.sz','.tc','.td','.tf','.tg','.th','.tj','.tk','.tm','.tn',
'.to','.tp','.tr','.tt','.tv','.tw','.tz','.ua','.ug','.uk','.um',
'.us','.uy','.uz','.va','.vc','.ve','.vg','.vi','.vn','.vu','.ws',
'.wf','.ye','.yt','.yu','.za','.zm','.zw');

var mai = nname;
var val = true;

var dot = mai.lastIndexOf(".");
var dname = mai.substring(0,dot);
var ext = mai.substring(dot,mai.length);
//alert(ext);
	
if(dot>2 && dot<57)
{
	for(var i=0; i<arr.length; i++)
	{
	  if(ext == arr[i])
	  {
	 	val = true;
		break;
	  }	
	  else
	  {
	 	val = false;
	  }
	}
	if(val == false)
	{
	  	 alert("Your domain extension "+ext+" is not correct");
		 return false;
	}
	else
	{
		for(var j=0; j<dname.length; j++)
		{
		  var dh = dname.charAt(j);
		  var hh = dh.charCodeAt(0);
		  if((hh > 47 && hh<59) || (hh > 64 && hh<91) || (hh > 96 && hh<123) || hh==45 || hh==46)
		  {
			 if((j==0 || j==dname.length-1) && hh == 45)	
		  	 {
		 	  	 alert("Domain name should not begin are end with '-'");
			      return false;
		 	 }
		  }
		else	{
		  	 alert("Your domain name should not have special characters");
			 return false;
		  }
		}
	}
}
else
{
 alert("Your Domain name is too short/long");
 return false;
}	

return true;
}

function AddDomain() {
	var status = document.getElementById("add_domain_status").innerHTML;
	var domain = document.addform.domain.value;
	var path = document.addform.path.value;

	status = '<img src="images/wait.gif">Adding domain, please wait...';

	// Check domain
	$dom = checkDomain(domain);
	if (!$dom) {
		status = '<font color="red">Your domain is invalid.</font>';
	}

	// Add domain
	xajax_AddDomain(domain,path);
}

function EditDomain() {
        var status = document.getElementById("add_domain_status").innerHTML;
        var domain = document.editform.domain.value;
        var path = document.editform.path.value;

        status = '<img src="images/wait.gif">Updating domain, please wait...';

        // Update domain
        xajax_UpdateDomain(domain,path);
}
</script>

<?php if (isset($_GET['added'])) { ?>
<div id="warning"><div><div><div>
Your new domain has been added successfully.
</div></div></div></div>
<?php } ?>

<?php if (isset($_GET['deleted'])) { ?>
<div id="warning"><div><div><div>
The selected domain and it's subdomains have been deleted successfully.
</div></div></div></div>
<?php } ?>

<?php if (isset($_GET['updated'])) { ?>
<div id="warning"><div><div><div>
The selected domain has been updated successfully.
</div></div></div></div>
<?php } ?>

<p>Here you can add domains to your account after registering them with a domain registrar such as <a href="http://www.dotster.com/?refid=33726" target="_blank">Dotster</a>.</p>

<div id="domstatmsg"><img src="images/wait.gif" /> Loading domains...<br /><br /></div>

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

<form action="javascript:<?=$action?>Domain()" name="<?=strtolower($action)?>form">
<h1><?=$action?> a Domain</h1>
<table width="100%">
        <tr>
                <td class="fieldname">Domain Name:</td>
                <td><?php if ($action=='Edit') { echo '<b>'.$thisdom['domain'].'</b> (<a href="?cat='.$_GET['cat'].'&page='.$_GET['page'].'&delconf&dom='.$thisdom['domain'].'">Delete Domain</a>) <input type="hidden" name="domain" value="'.$thisdom['domain'].'" />'; }else{?><input name="domain" type="textbox" /> (ex. this.com or that.this.com)</td><?php } ?>
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
<h1>Current Domains</h1>
<table width="100%">
        <tr style="font-weight: 800;">
                <td>Domain Name</td>
                <td>Date Added</td>
                <td>Path</td>
		<td>Status</td>
                <td>Options</td>
        </tr>
<?php
        if (!empty($result)) {
                $count = 0;
                foreach ($result AS $row) {
                        if ($count==0) { $style=' class="highlightrow"'; $count=1; }else{ $style=''; $count=0; }
?>      <tr<?=$style?>>
                <td><?=$row['domain']?></td>
                <td><?=date("m-d-Y",$row['date'])?></td>
                <td><?=$row['path']?></td>
		<td><?=DomStatus($row['domain'],$row['path'])?></td>
                <td><a href="?cat=domainadmin&page=domains&edit=<?=$row['domain']?>"><img src="modules/domainadmin/images/edit.gif" border="0" alt="Edit" /></a></td>
        </tr>
<?php
			flush();
                }
        }else{
                echo '<tr><td colspan="4">You have no domains tied too your account at this time.</td></tr>';
        }
?>
</table>
<script type="text/javascript">document.getElementById("domstatmsg").style.display="none";</script>
