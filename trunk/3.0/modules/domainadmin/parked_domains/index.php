<?php
if (isset($_GET['delconf'])) {
?>
<fieldset class="confirmation">
<legend>Confirmation</legend>
Are you sure you would like to delete the parked domain <b><?=$_GET['dom']?></b>?<br /> <br />

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

// Get domains
$result = $DB->GetAll("SELECT * FROM domains WHERE parked=1 AND user='".$user['username']."' ORDER BY domain ASC");

function DomStatus($dom,$path) {
	global $user;

	// Perform NS lookup
	$nslookup = strtolower(shell_exec("nslookup -timeout=1 $dom"));

	ini_set('default_socket_timeout', 1);
	$handle = @fopen("http://zwayradio.com/getip.php", "rb");
	$ip = @fread($handle, 8192);

	if (strpos($nslookup,$ip) !== false) {
		return '<font color="green">Verified</td>';
	}else{
		return '<font color="red"><span title="Domain doesn\'t resolve to '.$ip.'">Unverified</span></font>';
	}
}
?><script language="javascript">
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

function AddParkedDomain() {
	var status = document.getElementById("add_domain_status").innerHTML;
	var domain = document.addform.domain.value;

	status = '<img src="images/wait.gif">Adding domain, please wait...';

	// Check domain
	$dom = checkDomain(domain);
	if (!$dom) {
		status = '<font color="red">Your domain is invalid.</font>';
	}

	// Add domain
	xajax_AddParkedDomain(domain);
}
</script>

<?php if (isset($_GET['added'])) { ?>
<div id="warning"><div><div><div>
Your domain has been parked successfully.
</div></div></div></div>
<?php } ?>

<?php if (isset($_GET['deleted'])) { ?>
<div id="warning"><div><div><div>
The selected domain has been unparked successfully.
</div></div></div></div>
<?php } ?>

<p>Here you can add park domains that you've registered with a registrar such as <a href="http://www.dotster.com/?refid=33726" target="_blank">Dotster</a>. Parking provides surfers with a "coming soon" page.</p>

<div id="domstatmsg"><img src="images/wait.gif" /> Loading domains...<br /><br /></div>

<?php
	flush();
	ob_flush();
?>

<form action="javascript:AddParkedDomain()" name="addform">
<h1>Park a Domain</h1>
<table width="100%">
        <tr>
                <td class="fieldname">Domain Name:</td>
                <td><input name="domain" type="textbox" /> (ex. this.com or that.this.com)</td>
        </tr>
	<tr>
		<td><input type="submit" id="Add" value="Park"></td>
		<td><div id="add_domain_status"></div></td>
	<tr>
</table>
</form>
<br />
<h1>Current Parked Domains</h1>
<table width="100%">
        <tr style="font-weight: 800;">
                <td>Domain Name</td>
                <td>Date Added</td>
		<td>Status</td>
                <td>Delete</td>
        </tr>
<?php
        if (count($result) > 0) {
                $count = 0;
                foreach ($result AS $row) {
                        if ($count==0) { $style=' class="highlightrow"'; $count=1; }else{ $style=''; $count=0; }
?>      <tr<?=$style?>>
                <td><?=$row['domain']?></td>
                <td><?=date("m-d-Y",$row['date'])?></td>
		<td><?=DomStatus($row['domain'],$row['path'])?></td>
                <td><a href="?cat=domainadmin&page=parked_domains&delconf&dom=<?=$row['domain']?>"><img src="modules/domainadmin/images/edit.gif" border="0" alt="Delete" /></a></td>
        </tr>
<?php
			flush();
                }
        }else{
                echo '<tr><td colspan="4">You have no domains parked on your account at this time.</td></tr>';
        }
?>
</table>
<script language="javascript">document.getElementById("domstatmsg").style.display="none";</script>
