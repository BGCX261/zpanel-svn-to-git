<?php
// Status function
function Status($stat) {
        switch ($stat) {
                case 0: return 'New'; break;
                case 1: return '<font color="red">Waiting on Customer</font>'; break;
                case 2: return 'Waiting on Tech'; break;
                case 3: return 'Closed'; break;
        }
}

if (!isset($_GET['ticket'])) {

// Get open tickets
$row = $DB->GetAll("SELECT * FROM tickets WHERE customer='".$user['username']."'");

?><p>This page allows you to view your current support tickets as well as your closed tickets. If you need support, please <a href="?cat=support&page=new_ticket">open a support ticket</a>.</p>

<h1>Current Stats</h1>
<table width="100%">
        <tr style="font-weight: 800;">
                <td>Ticket Number</td>
		<td>Subject</td>
                <td>Opened</td>
                <td>Status</td>
        </tr>
<?php if (!empty($row)) { $rc=0; foreach ($row as $tix) {
	if ($rc==0) { $style=' class="highlightrow"'; $rc=1; }else{ $style=''; $rc=0; }
?>        <tr<?=$style?>>
                <td><a href="?cat=support&page=ticket_center&ticket=<?=$tix['id']?>"><?=$tix['id']?></a></td>
		<td><?=stripslashes($tix['summary'])?></td>
                <td><?=date("m-d-Y",$tix['date'])?></td>
                <td><?=Status($tix['status'])?></td>
        </tr>
<?php } }else{ echo '<tr class="colpage"><td colspan="3">You have no open tickets...</td></tr>'; } ?></table>

<?php
}else{
########
## Display a ticket
########

if (isset($_POST['addition'])) { 
	$id = Clean($_GET['ticket'],1);
	$time = time();
	$description = addslashes($_POST['addition']);
	$customer = $user['username'];

	// Insert ticket's body
	$DB->Execute("INSERT INTO tickets_history (ticket,user,date,message) VALUES ('$id','$customer','$time','$description')");
}

// Get open tickets
$ticket = $DB->GetRow("SELECT * FROM tickets WHERE id='".Clean($_GET['ticket'],1)."'");
?>
<h1>Ticket #<?=$ticket['id']?></h1>
<table class="ticketsys_newticket">
        <tr>
                <td class="fieldname" width="70px">Customer:</td>
                <td><?=UserInfo($ticket['customer'],'firstname').' '.UserInfo($ticket['customer'],'lastname')?></td>
		<td class="fieldname" width="50px">Status:</td>
		<td><?=Status($ticket['status'])?></td>
        </tr>
		<td class="fieldname">Opened:</td>
		<td><?=date("m-d-Y",$ticket['date'])?></td>
		<td class="fieldname">Agent:</td>
		<td><?php if ($ticket['assignedto']) { echo $ticket['assignedto']; }else{ echo 'Unassigned'; }?></td>
        </tr>
	<tr>
		<td class="fieldname">OS:</td>
		<td colspan="3"><?=$ticket['os']?></td>
	</tr>
	<tr>
		<td class="fieldname">Subject:</td>
		<td colspan="3"><?=$ticket['summary']?></td>
	</tr>
</table>
<br />
<fieldset class="confirmation">
<legend>New Correspondence</legend>
<form action="?cat=support&page=ticket_center&ticket=<?=$_GET['ticket']?>" method="post">
<p><textarea name="addition" style="width: 100%;"></textarea><br /><input type="submit" name="add" id="add" value="Add" /></p>
</form>
</fieldset>
<br />
<?php
// Get ticket history
$history = $DB->GetAll("SELECT * FROM tickets_history WHERE ticket='".$ticket['id']."' AND techonly='0'");
?>
<fieldset class="confirmation">
<legend>Ticket History</legend>
<?php $rc=0; foreach ($history AS $row) { ?>&bull; Posted by <b><?=$row['user']?></b> on <?=date("m-d-Y",$row['date'])?> at <?=date("g:i T",$row['date'])?>
<p><?=stripslashes($row['message'])?></p>
<?php
	$rc = $rc + 1;
	if ($rc != (count($history))){ echo '<hr />'; }
}
?>
</fieldset>
<?php } ?>
