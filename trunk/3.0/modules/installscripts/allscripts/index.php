<?php
// Check if we're instaling, if so, display another page
if (isset($_GET['install'])) {
	include('modules/installscripts/allscripts/install.php');
	exit;
}

function GetCat($id) {
        global $DB;
        $name = $DB->GetOne("SELECT name FROM zantastico_categories WHERE id='$id'");
        return $name;
}

if (isset($_GET['catid'])) {
	$where = "WHERE catid='".Clean($_GET['catid'],1)."' ";
	$cat = GetCat(Clean($_GET['catid'],1));
}else{  $where = ''; $cat = 'All Scripts'; }

// Get packages installed
$pkresult = $DB->GetAll('SELECT * FROM zantastico '.$where.'ORDER BY name ASC');
$pkcount = $DB->GetOne('SELECT COUNT(*) FROM zantastico '.$where);

?><p>We have made it easier than ever to install helpful applications into your hosting. Below is a list of available applications. If you'd like to see another application available, please let us know.</p>

<h1><?=$cat?></h1>
<table width="100%">
	<tr style="font-weight: 800;">
		<td>Name</td>
		<td>Version</td>
		<td>Category</td>
		<td>Install</td>
	</tr>
<?php
	if ($pkcount > 0) {
		$count = 0;
		foreach ($pkresult as $row) {
			if ($count==0) { $style=' class="highlightrow"'; $count=1; }else{ $style=''; $count=0; }
?>	<tr<?=$style?>>
		<td><?=$row['name']?></td>
		<td><?=$row['version']?></td>
		<td><?=GetCat($row['catid'])?></td>
		<td><a href="?cat=installscripts&page=allscripts&install&id=<?=$row['id']?>">Install</a></td>
	</tr>
<?php
		}
	}else{
		echo '<tr><td colspan="4">None available at this time, sorry.</td></tr>';
	}
?>
</table>
