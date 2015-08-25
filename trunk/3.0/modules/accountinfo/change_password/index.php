<?php
if (isset($_POST['submit'])) {


  echo ("<script language=javascript>document.location.href = '?page=change_password&updated'</script>");

}
?>
<BR />This page allows you to set your ZPanel, main FTP and Mailbox password. When updating the password below, please remember that your FTP and Mailbox password are updated as well.<BR /><BR />
<div id="warning" style="display: none;"><div><div><div>
Your sensitive information has been updated!
</div></div></div></div>
<script language="javascript">
function showconf() {
	document.getElementById("warning").style.display = "block";
}

function Update() {
	xajax_ChangePasswd(document.form1.new_passwd.value,document.form1.confirm_new.value,document.form1.secret_question.value,document.form1.secret_answer.value);		
}
</script>
<script language="javascript">

	function SetQuestion(question) {
		document.form1.secret_question.value = question;
		EnableAnswer();
	}

	function EnableConfirm() {
		if (document.form1.new_passwd.value != '') {
			document.form1.confirm_new.disabled = false;
			document.getElementById('passconfirm').innerHTML='<font color="red">Please Confirm</font>';
			
			if (document.form1.confirm_new.value != '') {
				if (document.form1.new_passwd.value == document.form1.confirm_new.value) {
					document.getElementById('passconfirm').innerHTML='<font color="green">Passwords Match</font>';
					document.form1.submit.disabled = false;
				}else{
					document.getElementById('passconfirm').innerHTML='<font color="red">Passwords Do Not Match</font>';			
					document.form1.submit.disabled = true;
				}
			}
		}else{
			document.form1.confirm_new.disabled = true;
			document.getElementById('passconfirm').innerHTML='Enter a New Password';			
			document.form1.confirm_new.value = '';
			document.form1.submit.disabled = false;
		}
	}
	
	function EnableAnswer() {
		if (document.form1.secret_question.value != '') {
			document.form1.secret_answer.disabled = false;
		}else{
			document.form1.secret_answer.value = '';
			document.form1.secret_answer.disabled = true;
		}
	}
	
</script>
<form name="form1">
 <div class="category_heading">Your Password</div><hr align="left" width="400">
 <table width="400" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="110" height="29" align="left"><span class="properties">New Password:</span></td>
      <td width="290"><input name="new_passwd" type="password" class="properties" id="new_passwd" maxlength="100" onKeyUp="EnableConfirm();"></td>
    </tr>
    <tr>
      <td height="29" align="left"><span class="properties">Confirm New Password:</span></td>
      <td><input name="confirm_new" type="password" class="properties" id="confirm_new" maxlength="100" onKeyUp="EnableConfirm();"> <div id=passconfirm>Enter a New Password</div></td>
    </tr>
    <tr align="left" valign="bottom">
      <td height="47" colspan="2" align="left"><div class="category_heading">Password Recovery</div><hr align="left" width="400">
</td>
    </tr>
    <tr valign="top">
      <td height="30" align="left"><span class="properties">Secret Question: </span></td>
      <td><input name="secret_question" type="text" class="properties" id="secret_question" value="<?php echo $user['secret_question']; ?>" size="40" maxlength="100" onKeyUp="EnableAnswer();"></td>
    </tr>
    <tr align="left" valign="top">
      <td height="76">&nbsp;</td>
      <td><div class="plaintext style18 style18 style18">Examples:</div>
        <div style="padding-left: 10px; padding-right: 10px;"><span class="plaintext style18 style18 style18"><img src="images/arrow-r.gif" width="11" height="10" align="absmiddle"> <a href="javascript:SetQuestion('What is the name of your pet?');">What is the name of your pet?</a><br>
              <img src="images/arrow-r.gif" width="11" height="10" align="absmiddle"> <a href="javascript:SetQuestion('What is the street you live on?');">What is the street you live on?</a><br>
              <img src="images/arrow-r.gif" width="11" height="10" align="absmiddle"> <a href="javascript:SetQuestion('What city were you born in?');">What city were you born in? </a></span></div></td>
    </tr>
    <tr>
      <td height="29" align="left"><span class="properties">Secret Answer: </span></td>
      <td><input name="secret_answer" type="text" class="properties" id="secret_answer" maxlength="100"></td>
    </tr>
    <tr>
      <td height="53" align="left">&nbsp;</td>
      <td><input type="button" name="submit" value="Update" onMouseUp="Update();">      </td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<script language="javascript">
	document.form1.confirm_new.disabled = true;	
	EnableAnswer();
</script>
