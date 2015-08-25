<?php
if (isset($_POST['subject'])) {

// Gen ID
function GenID(){
        global $DB,$config;

	srand ((double) microtime( )*1000);
	$new_id = rand();
	$seg1 = substr($new_id, 0, 3);
	$seg2 = substr($new_id, 4, 3);
	$new_id = $config['reseller'].'-'.$seg1.'-'.$seg2;

	$check = $DB->GetOne("SELECT COUNT(*) FROM tickets WHERE id='$new_id'");

        if ($check == 0) {
                return $new_id;
        }else{
                GenID();
        }
}
$id=GenID();

// Gather other info
$time = time();
$reseller = $config['reseller'];
$os = $_POST['os'];
$summary = addslashes($_POST['subject']);
$description = addslashes($_POST['desc']);
$customer = $user['username']; 
//echo $description;

// Insert ticket's header
$DB->Execute("INSERT INTO tickets (id,reseller,os,summary,date,customer) VALUES ('$id','$reseller','$os','$summary','$time','$customer')");

// Insert ticket's body
$DB->Execute("INSERT INTO tickets_history (ticket,user,date,message) VALUES ('$id','$customer','$time','$description')");
?>
<div id="warning"><div><div><div>
Ticket number <b><?=$id?></b> has been opened on this issue. To review it, please visit your <a href="?cat=support&page=ticket_center">Ticket Center</a>
</div></div></div></div>
<?php
}
?><script language="javascript">
function Check() {
	var subject = document.getElementById("subject").value;
	var description = document.getElementById("desc").value;
	var button =  document.getElementById("submit");

	if (subject != '') {
		if (description != '') {
			button.disabled = false;
		}else{
			button.disabled = true;
		}
	}else{
		button.disabled = true;
	}
}
</script>

<p>We are always happy to assist you with your technical issues. Please use the form below to open a new support ticket with us.<p>
<form action="?cat=support&page=new_ticket" method="post">
<table class="ticketsys_newticket">
	<tr>
		<td class="fieldname">Subject:</td>
		<td><input type="textbox" name="subject" id="subject" onKeyUp="Check()" /></td>
	</tr>
	<tr>
		<td class="fieldname">Operating System:</td>
		<td><select name="os">
			<option />
			<option>Windows Vista</option>
			<option>Windows 2000/XP</option>
			<option>Windows 95/98</option>
			<option>Linux</option>
			<option>FreeBSD</option>
			<option>Solaris</option>
		    </select>
		</td>
	<tr>
		<td class="fieldname">Description:</td>
		<td><textarea name="desc" cols="40" rows="6" id="desc" onKeyUp="Check()"></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="add" id="submit" value="Submit Ticket" disabled="true" />
	</tr>
</table>
</form>
