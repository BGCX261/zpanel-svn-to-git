<?php
if (isset($_POST['submit'])) {


  echo ("<script language=javascript>document.location.href = '?cat=accountinfo&page=my_account&updated'</script>");
}
?>
<BR />The My Account page is used to update important information about your account with us. Please be sure to keep all of the information contained accurate.<BR /><BR />
<div id="warning" style="display: none;"><div><div><div>
Your Account Info has been updated!
</div></div></div></div>
<script language="javascript">
function showconf() {
        document.getElementById("warning").style.display = "block";
}

function Update() {
	var firstname = document.my_account.firstname.value;
	var lastname = document.my_account.lastname.value;
	var sex = document.my_account.sex.value;
	var email = document.my_account.email.value;
	var phone = document.my_account.phone.value;
	var address = document.my_account.addy.value;
	var address2 = document.my_account.address2.value;
	var city = document.my_account.city.value;
	var state = document.my_account.state.value;
	var country = document.my_account.country.value
	var zip = document.my_account.zip.value
	var date_format = document.my_account.date_format.value
	var time_format = document.my_account.time_format.value
	xajax_MyAccount_Update(firstname,lastname,sex,email,phone,address,address2,city,state,country,zip,date_format,time_format);		
}
</script>
<form name="my_account">
<div class="category_heading">Your Name</div><hr align="left" width="400">
  <table width="400" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="107" align="right"><div align="left"><span class="properties">First Name: </span></div></td>
      <td width="293"><div align="left">
        <input name="firstname" type="text" class="properties" id="firstname" value="<?=$user['firstname']?>" maxlength="100">
      </div></td>
    </tr>
    <tr>
      <td align="right"><div align="left"><span class="properties">Last Name: </span></div></td>
      <td><div align="left">
        <input name="lastname" type="text" class="properties" id="lastname" value="<?=$user['lastname']?>" maxlength="100">
      </div></td>
    </tr>
    <tr align="left" valign="bottom">
      <td height="47" colspan="2"><div class="category_heading">Contact Information</div><hr width="400"></td>
    </tr>
    <tr>
      <td align="right"><div align="left"><span class="properties">Gender</span></div></td>
      <td class="properties"><div align="left">
      <select name="sex">
        <option value="M"<?php if ($user['gender'] == "M") { echo " selected"; } ?>>Male</option>
        <option value="F"<?php if ($user['gender'] == "F") { echo " selected"; } ?>>Female</option>
      </select>
      </div></td>
    </tr>
    <tr>
      <td align="right"><div align="left"><span class="properties">E-Mail Address </span></div></td>
      <td><div align="left">
        <input name="email" type="text" class="properties" id="email" value="<?=$user['email']?>" maxlength="100">
      </div></td>
    </tr>
    <tr>
      <td align="right"><div align="left"><span class="properties">Phone:</span></div></td>
      <td><div align="left">
        <input name="phone" type="text" class="properties" id="phone" value="<?=$user['phone']?>" maxlength="100">
      </div></td>
    </tr>
    <tr align="left" valign="bottom">
      <td height="47" colspan="2" class="category_heading">Address<hr width="400"></td>
    </tr>
    <tr>
      <td align="right"><div align="left"><span class="properties">Address:</span></div></td>
      <td><div align="left">
        <input name="addy" type="text" class="properties" id="addy" value="<?=$user['address']?>" maxlength="100">
      </div></td>
    </tr>
    <tr>
      <td align="right"><div align="left"><span class="properties"></span></div></td>
      <td><div align="left">
        <input name="address2" type="text" class="properties" id="address2" value="<?=$user['address2']?>" maxlength="100">
      </div></td>
    </tr>
    <tr>
      <td align="right"><div align="left"><span class="properties">City:</span></div></td>
      <td><div align="left">
        <input name="city" type="text" class="properties" id="city" value="<?=$user['city']?>" maxlength="100">
      </div></td>
    </tr>
    <tr>
      <td align="right"><div align="left"><span class="properties">State:</span></div></td>
      <td><div align="left">
        <select name="state" class="properties" id="state">
            <option value="" selected <?php if (!(strcmp("", $user['state']))) {echo "SELECTED";} ?>>Select One</option>
            <option value="Other" <?php if (!(strcmp("Other", $user['state']))) {echo "SELECTED";} ?>>Other</option>
            <option value="AL" <?php if (!(strcmp("AL", $user['state']))) {echo "SELECTED";} ?>>Alabama(AL)</option>
            <option value="AK" <?php if (!(strcmp("AK", $user['state']))) {echo "SELECTED";} ?>>Alaska(AK)</option>
            <option value="AZ" <?php if (!(strcmp("AZ", $user['state']))) {echo "SELECTED";} ?>>Arizona(AZ)</option>
            <option value="AR" <?php if (!(strcmp("AR", $user['state']))) {echo "SELECTED";} ?>>Arkansas(AR)</option>
            <option value="CA" <?php if (!(strcmp("CA", $user['state']))) {echo "SELECTED";} ?>>California(CA)</option>
            <option value="CO" <?php if (!(strcmp("CO", $user['state']))) {echo "SELECTED";} ?>>Colorado(CO)</option>
            <option value="CT" <?php if (!(strcmp("CT", $user['state']))) {echo "SELECTED";} ?>>Connecticut(CT)</option>
            <option value="DE" <?php if (!(strcmp("DE", $user['state']))) {echo "SELECTED";} ?>>Delaware(DE)</option>
            <option value="DC" <?php if (!(strcmp("DC", $user['state']))) {echo "SELECTED";} ?>>District of Columbia(DC)</option>
            <option value="FL" <?php if (!(strcmp("FL", $user['state']))) {echo "SELECTED";} ?>>Florida(FL)</option>
            <option value="GA" <?php if (!(strcmp("GA", $user['state']))) {echo "SELECTED";} ?>>Georgia(GA)</option>
            <option value="GU" <?php if (!(strcmp("GU", $user['state']))) {echo "SELECTED";} ?>>Guam(GU)</option>
            <option value="HI" <?php if (!(strcmp("HI", $user['state']))) {echo "SELECTED";} ?>>Hawaii(HI)</option>
            <option value="ID" <?php if (!(strcmp("ID", $user['state']))) {echo "SELECTED";} ?>>Idaho(ID)</option>
            <option value="IL" <?php if (!(strcmp("IL", $user['state']))) {echo "SELECTED";} ?>>Illinois(IL)</option>
            <option value="IN" <?php if (!(strcmp("IN", $user['state']))) {echo "SELECTED";} ?>>Indiana(IN)</option>
            <option value="IA" <?php if (!(strcmp("IA", $user['state']))) {echo "SELECTED";} ?>>Iowa(IA)</option>
            <option value="KS" <?php if (!(strcmp("KS", $user['state']))) {echo "SELECTED";} ?>>Kansas(KS)</option>
            <option value="KY" <?php if (!(strcmp("KY", $user['state']))) {echo "SELECTED";} ?>>Kentucky(KY)</option>
            <option value="LA" <?php if (!(strcmp("LA", $user['state']))) {echo "SELECTED";} ?>>Louisiana(LA)</option>
            <option value="ME" <?php if (!(strcmp("ME", $user['state']))) {echo "SELECTED";} ?>>Maine(ME)</option>
            <option value="MD" <?php if (!(strcmp("MD", $user['state']))) {echo "SELECTED";} ?>>Maryland(MD)</option>
            <option value="MA" <?php if (!(strcmp("MA", $user['state']))) {echo "SELECTED";} ?>>Massachusetts(MA)</option>
            <option value="MI" <?php if (!(strcmp("MI", $user['state']))) {echo "SELECTED";} ?>>Michigan(MI)</option>
            <option value="MN" <?php if (!(strcmp("MN", $user['state']))) {echo "SELECTED";} ?>>Minnesota(MN)</option>
            <option value="MS" <?php if (!(strcmp("MS", $user['state']))) {echo "SELECTED";} ?>>Mississippi(MS)</option>
            <option value="MO" <?php if (!(strcmp("MO", $user['state']))) {echo "SELECTED";} ?>>Missouri(MO)</option>
            <option value="MT" <?php if (!(strcmp("MT", $user['state']))) {echo "SELECTED";} ?>>Montana(MT)</option>
            <option value="NE" <?php if (!(strcmp("NE", $user['state']))) {echo "SELECTED";} ?>>Nebraska(NE)</option>
            <option value="NV" <?php if (!(strcmp("NV", $user['state']))) {echo "SELECTED";} ?>>Nevada(NV)</option>
            <option value="NH" <?php if (!(strcmp("NH", $user['state']))) {echo "SELECTED";} ?>>New Hampshire(NH)</option>
            <option value="NJ" <?php if (!(strcmp("NJ", $user['state']))) {echo "SELECTED";} ?>>New Jersey(NJ)</option>
            <option value="NM" <?php if (!(strcmp("NM", $user['state']))) {echo "SELECTED";} ?>>New Mexico(NM)</option>
            <option value="NY" <?php if (!(strcmp("NY", $user['state']))) {echo "SELECTED";} ?>>New York(NY)</option>
            <option value="NC" <?php if (!(strcmp("NC", $user['state']))) {echo "SELECTED";} ?>>North Carolina(NC)</option>
            <option value="ND" <?php if (!(strcmp("ND", $user['state']))) {echo "SELECTED";} ?>>North Dakota(ND)</option>
            <option value="OH" <?php if (!(strcmp("OH", $user['state']))) {echo "SELECTED";} ?>>Ohio(OH)</option>
            <option value="OK" <?php if (!(strcmp("OK", $user['state']))) {echo "SELECTED";} ?>>Oklahoma(OK)</option>
            <option value="OR" <?php if (!(strcmp("OR", $user['state']))) {echo "SELECTED";} ?>>Oregon(OR)</option>
            <option value="PA" <?php if (!(strcmp("PA", $user['state']))) {echo "SELECTED";} ?>>Pennsylvania(PA)</option>
            <option value="RI" <?php if (!(strcmp("RI", $user['state']))) {echo "SELECTED";} ?>>Rhode Island(RI)</option>
            <option value="SC" <?php if (!(strcmp("SC", $user['state']))) {echo "SELECTED";} ?>>South Carolina(SC)</option>
            <option value="SD" <?php if (!(strcmp("SD", $user['state']))) {echo "SELECTED";} ?>>South Dakota(SD)</option>
            <option value="TN" <?php if (!(strcmp("TN", $user['state']))) {echo "SELECTED";} ?>>Tennessee(TN)</option>
            <option value="TX" <?php if (!(strcmp("TX", $user['state']))) {echo "SELECTED";} ?>>Texas(TX)</option>
            <option value="UT" <?php if (!(strcmp("UT", $user['state']))) {echo "SELECTED";} ?>>Utah(UT)</option>
            <option value="VT" <?php if (!(strcmp("VT", $user['state']))) {echo "SELECTED";} ?>>Vermont(VT)</option>
            <option value="VI" <?php if (!(strcmp("VI", $user['state']))) {echo "SELECTED";} ?>>Virgin Islands(VI)</option>
            <option value="VA" <?php if (!(strcmp("VA", $user['state']))) {echo "SELECTED";} ?>>Virginia(VA)</option>
            <option value="WA" <?php if (!(strcmp("WA", $user['state']))) {echo "SELECTED";} ?>>Washington(WA)</option>
            <option value="WV" <?php if (!(strcmp("WV", $user['state']))) {echo "SELECTED";} ?>>West Virginia(WV)</option>
            <option value="WI" <?php if (!(strcmp("WI", $user['state']))) {echo "SELECTED";} ?>>Wisconsin(WI)</option>
            <option value="WY" <?php if (!(strcmp("WY", $user['state']))) {echo "SELECTED";} ?>>Wyoming(WY)</option>
    
    </select>
      </div></td>
    </tr>
    <tr>
      <td align="right"><div align="left"><span class="properties">Country:</span></div></td>
      <td><div align="left">
        <select name="country" id="country">
            <option value="USA" <?php if (!(strcmp("USA", $user['country']))) {echo "SELECTED";} ?>>U.S.A.</option>
            <option value="UK" <?php if (!(strcmp("UK", $user['country']))) {echo "SELECTED";} ?>>U.K.</option>
            <option value="Albania" <?php if (!(strcmp("Albania", $user['country']))) {echo "SELECTED";} ?>>Albania</option>
            <option value="Algeria" <?php if (!(strcmp("Algeria", $user['country']))) {echo "SELECTED";} ?>>Algeria</option>
            <option value="American Samoa" <?php if (!(strcmp("American Samoa", $user['country']))) {echo "SELECTED";} ?>>American Samoa</option>
            <option value="Andorra" <?php if (!(strcmp("Andorra", $user['country']))) {echo "SELECTED";} ?>>Andorra</option>
            <option value="Angola" <?php if (!(strcmp("Angola", $user['country']))) {echo "SELECTED";} ?>>Angola</option>
            <option value="Anguilla" <?php if (!(strcmp("Anguilla", $user['country']))) {echo "SELECTED";} ?>>Anguilla</option>
            <option value="Antigua" <?php if (!(strcmp("Antigua", $user['country']))) {echo "SELECTED";} ?>>Antigua</option>
            <option value="Argentina" <?php if (!(strcmp("Argentina", $user['country']))) {echo "SELECTED";} ?>>Argentina</option>
            <option value="Armenia" <?php if (!(strcmp("Armenia", $user['country']))) {echo "SELECTED";} ?>>Armenia</option>
            <option value="Aruba" <?php if (!(strcmp("Aruba", $user['country']))) {echo "SELECTED";} ?>>Aruba</option>
            <option value="Australia" <?php if (!(strcmp("Australia", $user['country']))) {echo "SELECTED";} ?>>Australia</option>
            <option value="Austria" <?php if (!(strcmp("Austria", $user['country']))) {echo "SELECTED";} ?>>Austria</option>
            <option value="Azerbaijan" <?php if (!(strcmp("Azerbaijan", $user['country']))) {echo "SELECTED";} ?>>Azerbaijan</option>
            <option value="Bahamas" <?php if (!(strcmp("Bahamas", $user['country']))) {echo "SELECTED";} ?>>Bahamas</option>
            <option value="Bahrain" <?php if (!(strcmp("Bahrain", $user['country']))) {echo "SELECTED";} ?>>Bahrain</option>
            <option value="Bangladesh" <?php if (!(strcmp("Bangladesh", $user['country']))) {echo "SELECTED";} ?>>Bangladesh</option>
            <option value="Barbados" <?php if (!(strcmp("Barbados", $user['country']))) {echo "SELECTED";} ?>>Barbados</option>
            <option value="Barbuda" <?php if (!(strcmp("Barbuda", $user['country']))) {echo "SELECTED";} ?>>Barbuda</option>
            <option value="Belgium" <?php if (!(strcmp("Belgium", $user['country']))) {echo "SELECTED";} ?>>Belgium</option>
            <option value="Belize" <?php if (!(strcmp("Belize", $user['country']))) {echo "SELECTED";} ?>>Belize</option>
            <option value="Benin" <?php if (!(strcmp("Benin", $user['country']))) {echo "SELECTED";} ?>>Benin</option>
            <option value="Bermuda" <?php if (!(strcmp("Bermuda", $user['country']))) {echo "SELECTED";} ?>>Bermuda</option>
            <option value="Bhutan" <?php if (!(strcmp("Bhutan", $user['country']))) {echo "SELECTED";} ?>>Bhutan</option>
            <option value="Bolivia" <?php if (!(strcmp("Bolivia", $user['country']))) {echo "SELECTED";} ?>>Bolivia</option>
            <option value="Bonaire" <?php if (!(strcmp("Bonaire", $user['country']))) {echo "SELECTED";} ?>>Bonaire</option>
            <option value="Botswana" <?php if (!(strcmp("Botswana", $user['country']))) {echo "SELECTED";} ?>>Botswana</option>
            <option value="Brazil" <?php if (!(strcmp("Brazil", $user['country']))) {echo "SELECTED";} ?>>Brazil</option>
            <option value="Virgin islands" <?php if (!(strcmp("Virgin islands", $user['country']))) {echo "SELECTED";} ?>>British Virgin isl.</option>
            <option value="Brunei" <?php if (!(strcmp("Brunei", $user['country']))) {echo "SELECTED";} ?>>Brunei</option>
            <option value="Bulgaria" <?php if (!(strcmp("Bulgaria", $user['country']))) {echo "SELECTED";} ?>>Bulgaria</option>
            <option value="Burundi" <?php if (!(strcmp("Burundi", $user['country']))) {echo "SELECTED";} ?>>Burundi</option>
            <option value="Cambodia" <?php if (!(strcmp("Cambodia", $user['country']))) {echo "SELECTED";} ?>>Cambodia</option>
            <option value="Cameroon" <?php if (!(strcmp("Cameroon", $user['country']))) {echo "SELECTED";} ?>>Cameroon</option>
            <option value="Canada" <?php if (!(strcmp("Canada", $user['country']))) {echo "SELECTED";} ?>>Canada</option>
            <option value="Cape Verde" <?php if (!(strcmp("Cape Verde", $user['country']))) {echo "SELECTED";} ?>>Cape Verde</option>
            <option value="Cayman isl" <?php if (!(strcmp("Cayman isl", $user['country']))) {echo "SELECTED";} ?>>Cayman Islands</option>
            <option value="Central African Rep" <?php if (!(strcmp("Central African Rep", $user['country']))) {echo "SELECTED";} ?>>Central African Rep.</option>
            <option value="Chad" <?php if (!(strcmp("Chad", $user['country']))) {echo "SELECTED";} ?>>Chad</option>
            <option value="Channel isl" <?php if (!(strcmp("Channel isl", $user['country']))) {echo "SELECTED";} ?>>Channel Islands</option>
            <option value="Chile" <?php if (!(strcmp("Chile", $user['country']))) {echo "SELECTED";} ?>>Chile</option>
            <option value="China" <?php if (!(strcmp("China", $user['country']))) {echo "SELECTED";} ?>>China</option>
            <option value="Colombia" <?php if (!(strcmp("Colombia", $user['country']))) {echo "SELECTED";} ?>>Colombia</option>
            <option value="Congo" <?php if (!(strcmp("Congo", $user['country']))) {echo "SELECTED";} ?>>Congo</option>
            <option value="cook isl" <?php if (!(strcmp("cook isl", $user['country']))) {echo "SELECTED";} ?>>Cook Islands</option>
            <option value="Costa Rica" <?php if (!(strcmp("Costa Rica", $user['country']))) {echo "SELECTED";} ?>>Costa Rica</option>
            <option value="Croatia" <?php if (!(strcmp("Croatia", $user['country']))) {echo "SELECTED";} ?>>Croatia</option>
            <option value="Curacao" <?php if (!(strcmp("Curacao", $user['country']))) {echo "SELECTED";} ?>>Curacao</option>
            <option value="Cyprus" <?php if (!(strcmp("Cyprus", $user['country']))) {echo "SELECTED";} ?>>Cyprus</option>
            <option value="Czech Republic" <?php if (!(strcmp("Czech Republic", $user['country']))) {echo "SELECTED";} ?>>Czech Republic</option>
<option value="Denmark" <?php if (!(strcmp("Denmark", $user['country']))) {echo "SELECTED";} ?>>Denmark</option>
            <option value="Djibouti" <?php if (!(strcmp("Djibouti", $user['country']))) {echo "SELECTED";} ?>>Djibouti</option>
            <option value="Dominica" <?php if (!(strcmp("Dominica", $user['country']))) {echo "SELECTED";} ?>>Dominica</option>
            <option value="Dominican Republic" <?php if (!(strcmp("Dominican Republic", $user['country']))) {echo "SELECTED";} ?>>Dominican Republic</option>
            <option value="Ecuador" <?php if (!(strcmp("Ecuador", $user['country']))) {echo "SELECTED";} ?>>Ecuador</option>
            <option value="Egypt" <?php if (!(strcmp("Egypt", $user['country']))) {echo "SELECTED";} ?>>Egypt</option>
            <option value="El Salvador" <?php if (!(strcmp("El Salvador", $user['country']))) {echo "SELECTED";} ?>>El Salvador</option>
            <option value="Equatorial Guinea" <?php if (!(strcmp("Equatorial Guinea", $user['country']))) {echo "SELECTED";} ?>>Equatorial Guinea</option>
            <option value="Eritrea" <?php if (!(strcmp("Eritrea", $user['country']))) {echo "SELECTED";} ?>>Eritrea</option>
            <option value="Faeroe isl" <?php if (!(strcmp("Faeroe isl", $user['country']))) {echo "SELECTED";} ?>>Faeroe Islands</option>
            <option value="Fiji" <?php if (!(strcmp("Fiji", $user['country']))) {echo "SELECTED";} ?>>Fiji</option>
            <option value="Finland" <?php if (!(strcmp("Finland", $user['country']))) {echo "SELECTED";} ?>>Finland</option>
            <option value="France" <?php if (!(strcmp("France", $user['country']))) {echo "SELECTED";} ?>>France</option>
            <option value="French Guiana" <?php if (!(strcmp("French Guiana", $user['country']))) {echo "SELECTED";} ?>>French Guiana</option>
            <option value="French Polynesia" <?php if (!(strcmp("French Polynesia", $user['country']))) {echo "SELECTED";} ?>>French Polynesia</option>
            <option value="Gabon" <?php if (!(strcmp("Gabon", $user['country']))) {echo "SELECTED";} ?>>Gabon</option>
            <option value="Gambia" <?php if (!(strcmp("Gambia", $user['country']))) {echo "SELECTED";} ?>>Gambia</option>
            <option value="Georgia" <?php if (!(strcmp("Georgia", $user['country']))) {echo "SELECTED";} ?>>Georgia</option>
            <option value="Gemany" <?php if (!(strcmp("Gemany", $user['country']))) {echo "SELECTED";} ?>>Germany</option>
            <option value="Ghana" <?php if (!(strcmp("Ghana", $user['country']))) {echo "SELECTED";} ?>>Ghana</option>
            <option value="Gibraltar" <?php if (!(strcmp("Gibraltar", $user['country']))) {echo "SELECTED";} ?>>Gibraltar</option>
            <option value="GB" <?php if (!(strcmp("GB", $user['country']))) {echo "SELECTED";} ?>>Great Britain</option>
            <option value="Greece" <?php if (!(strcmp("Greece", $user['country']))) {echo "SELECTED";} ?>>Greece</option>
            <option value="Greenland" <?php if (!(strcmp("Greenland", $user['country']))) {echo "SELECTED";} ?>>Greenland</option>
            <option value="Grenada" <?php if (!(strcmp("Grenada", $user['country']))) {echo "SELECTED";} ?>>Grenada</option>
            <option value="Guadeloupe" <?php if (!(strcmp("Guadeloupe", $user['country']))) {echo "SELECTED";} ?>>Guadeloupe</option>
            <option value="Guam" <?php if (!(strcmp("Guam", $user['country']))) {echo "SELECTED";} ?>>Guam</option>
            <option value="Guatemala" <?php if (!(strcmp("Guatemala", $user['country']))) {echo "SELECTED";} ?>>Guatemala</option>
            <option value="Guinea" <?php if (!(strcmp("Guinea", $user['country']))) {echo "SELECTED";} ?>>Guinea</option>
            <option value="Guinea Bissau" <?php if (!(strcmp("Guinea Bissau", $user['country']))) {echo "SELECTED";} ?>>Guinea Bissau</option>
            <option value="Guyana" <?php if (!(strcmp("Guyana", $user['country']))) {echo "SELECTED";} ?>>Guyana</option>
            <option value="Haiti" <?php if (!(strcmp("Haiti", $user['country']))) {echo "SELECTED";} ?>>Haiti</option>
            <option value="Honduras" <?php if (!(strcmp("Honduras", $user['country']))) {echo "SELECTED";} ?>>Honduras</option>
            <option value="Hong Kong" <?php if (!(strcmp("Hong Kong", $user['country']))) {echo "SELECTED";} ?>>Hong Kong</option>
            <option value="Hungary" <?php if (!(strcmp("Hungary", $user['country']))) {echo "SELECTED";} ?>>Hungary</option>
            <option value="Iceland" <?php if (!(strcmp("Iceland", $user['country']))) {echo "SELECTED";} ?>>Iceland</option>
            <option value="India" <?php if (!(strcmp("India", $user['country']))) {echo "SELECTED";} ?>>India</option>
            <option value="Indonesia" <?php if (!(strcmp("Indonesia", $user['country']))) {echo "SELECTED";} ?>>Indonesia</option>
            <option value="Irak" <?php if (!(strcmp("Irak", $user['country']))) {echo "SELECTED";} ?>>Irak</option>
            <option value="Iran" <?php if (!(strcmp("Iran", $user['country']))) {echo "SELECTED";} ?>>Iran</option>
            <option value="Ireland" <?php if (!(strcmp("Ireland", $user['country']))) {echo "SELECTED";} ?>>Ireland</option>
            <option value="Northern Ireland" <?php if (!(strcmp("Northern Ireland", $user['country']))) {echo "SELECTED";} ?>>Ireland, Northern</option>
            <option value="Israel" <?php if (!(strcmp("Israel", $user['country']))) {echo "SELECTED";} ?>>Israel</option>
            <option value="Italy" <?php if (!(strcmp("Italy", $user['country']))) {echo "SELECTED";} ?>>Italy</option>
            <option value="Ivory Coast" <?php if (!(strcmp("Ivory Coast", $user['country']))) {echo "SELECTED";} ?>>Ivory Coast</option>
            <option value="Jamaica" <?php if (!(strcmp("Jamaica", $user['country']))) {echo "SELECTED";} ?>>Jamaica</option>
            <option value="Japan" <?php if (!(strcmp("Japan", $user['country']))) {echo "SELECTED";} ?>>Japan</option>
            <option value="Jordan" <?php if (!(strcmp("Jordan", $user['country']))) {echo "SELECTED";} ?>>Jordan</option>
            <option value="Kazakhstan" <?php if (!(strcmp("Kazakhstan\"", $user['country']))) {echo "SELECTED";} ?>>Kazakhstan</option>
            <option value="Kenya" <?php if (!(strcmp("Kenya", $user['country']))) {echo "SELECTED";} ?>>Kenya</option>
            <option value="Kuwait" <?php if (!(strcmp("Kuwait\"", $user['country']))) {echo "SELECTED";} ?>>Kuwait</option>
            <option value="Kyrgyzstan" <?php if (!(strcmp("Kyrgyzstan\"", $user['country']))) {echo "SELECTED";} ?>>Kyrgyzstan</option>
            <option value="Latvia" <?php if (!(strcmp("Latvia\"", $user['country']))) {echo "SELECTED";} ?>>Latvia</option>
            <option value="Lebanon" <?php if (!(strcmp("Lebanon\"", $user['country']))) {echo "SELECTED";} ?>>Lebanon</option>
            <option value="Liberia" <?php if (!(strcmp("Liberia", $user['country']))) {echo "SELECTED";} ?>>Liberia</option>
            <option value="Liechtenstein" <?php if (!(strcmp("Liechtenstein", $user['country']))) {echo "SELECTED";} ?>>Liechtenstein</option>
            <option value="Lithuania" <?php if (!(strcmp("Lithuania", $user['country']))) {echo "SELECTED";} ?>>Lithuania</option>
            <option value="Luxembourg" <?php if (!(strcmp("Luxembourg", $user['country']))) {echo "SELECTED";} ?>>Luxembourg</option>
            <option value="Macau" <?php if (!(strcmp("Macau", $user['country']))) {echo "SELECTED";} ?>>Macau</option>
            <option value="Macedonia" <?php if (!(strcmp("Macedonia", $user['country']))) {echo "SELECTED";} ?>>Macedonia</option>
            <option value="Madagascar" <?php if (!(strcmp("Madagascar", $user['country']))) {echo "SELECTED";} ?>>Madagascar</option>
            <option value="Malawi" <?php if (!(strcmp("Malawi", $user['country']))) {echo "SELECTED";} ?>>Malawi</option>
            <option value="Malaysia" <?php if (!(strcmp("Malaysia", $user['country']))) {echo "SELECTED";} ?>>Malaysia</option>
            <option value="Maldives" <?php if (!(strcmp("Maldives", $user['country']))) {echo "SELECTED";} ?>>Maldives</option>
            <option value="Mali" <?php if (!(strcmp("Mali", $user['country']))) {echo "SELECTED";} ?>>Mali</option>
            <option value="Malta" <?php if (!(strcmp("Malta", $user['country']))) {echo "SELECTED";} ?>>Malta</option>
            <option value="Marshall isl" <?php if (!(strcmp("Marshall isl", $user['country']))) {echo "SELECTED";} ?>>Marshall Islands</option>
            <option value="Martinique" <?php if (!(strcmp("Martinique", $user['country']))) {echo "SELECTED";} ?>>Martinique</option>
            <option value="Mauritania" <?php if (!(strcmp("Mauritania", $user['country']))) {echo "SELECTED";} ?>>Mauritania</option>
            <option value="Mauritius" <?php if (!(strcmp("Mauritius", $user['country']))) {echo "SELECTED";} ?>>Mauritius</option>
            <option value="Mexico" <?php if (!(strcmp("Mexico", $user['country']))) {echo "SELECTED";} ?>>Mexico</option>
            <option value="Micronesia" <?php if (!(strcmp("Micronesia", $user['country']))) {echo "SELECTED";} ?>>Micronesia</option>
            <option value="Moldova" <?php if (!(strcmp("Moldova", $user['country']))) {echo "SELECTED";} ?>>Moldova</option>
            <option value="Monaco" <?php if (!(strcmp("Monaco", $user['country']))) {echo "SELECTED";} ?>>Monaco</option>
            <option value="Mongolia" <?php if (!(strcmp("Mongolia", $user['country']))) {echo "SELECTED";} ?>>Mongolia</option>
            <option value="Montserrat" <?php if (!(strcmp("Montserrat", $user['country']))) {echo "SELECTED";} ?>>Montserrat</option>
            <option value="Morocco" <?php if (!(strcmp("Morocco", $user['country']))) {echo "SELECTED";} ?>>Morocco</option>
            <option value="Mozambique" <?php if (!(strcmp("Mozambique", $user['country']))) {echo "SELECTED";} ?>>Mozambique</option>
            <option value="Myanmar" <?php if (!(strcmp("Myanmar", $user['country']))) {echo "SELECTED";} ?>>Myanmar/Burma</option>
            <option value="Namibia" <?php if (!(strcmp("Namibia", $user['country']))) {echo "SELECTED";} ?>>Namibia</option>
            <option value="Nepal" <?php if (!(strcmp("Nepal", $user['country']))) {echo "SELECTED";} ?>>Nepal</option>
            <option value="Netherlands" <?php if (!(strcmp("Netherlands", $user['country']))) {echo "SELECTED";} ?>>Netherlands</option>
            <option value="Netherlands Antilles" <?php if (!(strcmp("Netherlands Antilles", $user['country']))) {echo "SELECTED";} ?>>Netherlands Antilles</option>
            <option value="New Caledonia" <?php if (!(strcmp("New Caledonia", $user['country']))) {echo "SELECTED";} ?>>New Caledonia</option>
            <option value="New Zealand" <?php if (!(strcmp("New Zealand", $user['country']))) {echo "SELECTED";} ?>>New Zealand</option>
            <option value="Nicaragua" <?php if (!(strcmp("Nicaragua", $user['country']))) {echo "SELECTED";} ?>>Nicaragua</option>
            <option value="Niger" <?php if (!(strcmp("Niger", $user['country']))) {echo "SELECTED";} ?>>Niger</option>
            <option value="Nigeria" <?php if (!(strcmp("Nigeria", $user['country']))) {echo "SELECTED";} ?>>Nigeria</option>
            <option value="Norway" <?php if (!(strcmp("Norway", $user['country']))) {echo "SELECTED";} ?>>Norway</option>
            <option value="Oman" <?php if (!(strcmp("Oman", $user['country']))) {echo "SELECTED";} ?>>Oman</option>
            <option value="Palau" <?php if (!(strcmp("", $user['country']))) {echo "SELECTED";} ?>>Palau</option>
            <option value="Panama" <?php if (!(strcmp("Panama", $user['country']))) {echo "SELECTED";} ?>>Panama</option>
            <option value="Papua New Guinea" <?php if (!(strcmp("Papua New Guinea", $user['country']))) {echo "SELECTED";} ?>>Papua New Guinea</option>
            <option value="Paraguay" <?php if (!(strcmp("Paraguay", $user['country']))) {echo "SELECTED";} ?>>Paraguay</option>
            <option value="Peru" <?php if (!(strcmp("Peru", $user['country']))) {echo "SELECTED";} ?>>Peru</option>
            <option value="Philippines" <?php if (!(strcmp("Philippines", $user['country']))) {echo "SELECTED";} ?>>Philippines</option>
            <option value="Poland" <?php if (!(strcmp("Poland", $user['country']))) {echo "SELECTED";} ?>>Poland</option>
            <option value="Portugal" <?php if (!(strcmp("Portugal", $user['country']))) {echo "SELECTED";} ?>>Portugal</option>
            <option value="Puerto Rico" <?php if (!(strcmp("Puerto Rico", $user['country']))) {echo "SELECTED";} ?>>Puerto Rico</option>
            <option value="Qatar" <?php if (!(strcmp("Qatar", $user['country']))) {echo "SELECTED";} ?>>Qatar</option>
            <option value="Reunion" <?php if (!(strcmp("Reunion", $user['country']))) {echo "SELECTED";} ?>>Reunion</option>
            <option value="Rwanda" <?php if (!(strcmp("Rwanda", $user['country']))) {echo "SELECTED";} ?>>Rwanda</option>
            <option value="Saba" <?php if (!(strcmp("Saba", $user['country']))) {echo "SELECTED";} ?>>Saba</option>
            <option value="Saipan" <?php if (!(strcmp("Saipan", $user['country']))) {echo "SELECTED";} ?>>Saipan</option>
            <option value="Saudi Arabia" <?php if (!(strcmp("Saudi Arabia", $user['country']))) {echo "SELECTED";} ?>>Saudi Arabia</option>
            <option value="Scotland" <?php if (!(strcmp("Scotland", $user['country']))) {echo "SELECTED";} ?>>Scotland</option>
            <option value="Senegal" <?php if (!(strcmp("Senegal", $user['country']))) {echo "SELECTED";} ?>>Senegal</option>
            <option value="Seychelles" <?php if (!(strcmp("", $user['country']))) {echo "SELECTED";} ?>>Seychelles</option>
            <option value="Sierra Leone" <?php if (!(strcmp("Sierra Leone", $user['country']))) {echo "SELECTED";} ?>>Sierra Leone</option>
            <option value="Singapore" <?php if (!(strcmp("Singapore", $user['country']))) {echo "SELECTED";} ?>>Singapore</option>
            <option value="Slovac Republic" <?php if (!(strcmp("Slovac Republic", $user['country']))) {echo "SELECTED";} ?>>Slovak Republic</option>
            <option value="Slovenia" <?php if (!(strcmp("Slovenia", $user['country']))) {echo "SELECTED";} ?>>Slovenia</option>
            <option value="South Africa" <?php if (!(strcmp("South Africa", $user['country']))) {echo "SELECTED";} ?>>South Africa</option>
            <option value="South Korea" <?php if (!(strcmp("South Korea", $user['country']))) {echo "SELECTED";} ?>>South Korea</option>
            <option value="Spain" <?php if (!(strcmp("Spain", $user['country']))) {echo "SELECTED";} ?>>Spain</option>
            <option value="Sri Lanka" <?php if (!(strcmp("Sri Lanka", $user['country']))) {echo "SELECTED";} ?>>Sri Lanka</option>
            <option value="Sudan" <?php if (!(strcmp("Sudan", $user['country']))) {echo "SELECTED";} ?>>Sudan</option>
            <option value="Suriname" <?php if (!(strcmp("Suriname", $user['country']))) {echo "SELECTED";} ?>>Suriname</option>
            <option value="Swaziland" <?php if (!(strcmp("Swaziland", $user['country']))) {echo "SELECTED";} ?>>Swaziland</option>
            <option value="Sweden" <?php if (!(strcmp("Sweden", $user['country']))) {echo "SELECTED";} ?>>Sweden</option>
            <option value="Switzerland" <?php if (!(strcmp("Switzerland", $user['country']))) {echo "SELECTED";} ?>>Switzerland</option>
            <option value="Syria" <?php if (!(strcmp("Syria", $user['country']))) {echo "SELECTED";} ?>>Syria</option>
            <option value="Taiwan" <?php if (!(strcmp("Taiwan", $user['country']))) {echo "SELECTED";} ?>>Taiwan</option>
            <option value="Tanzania" <?php if (!(strcmp("Tanzania", $user['country']))) {echo "SELECTED";} ?>>Tanzania</option>
            <option value="Thailand" <?php if (!(strcmp("Thailand", $user['country']))) {echo "SELECTED";} ?>>Thailand</option>
            <option value="Togo" <?php if (!(strcmp("Togo", $user['country']))) {echo "SELECTED";} ?>>Togo</option>
            <option value="Trinidad-Tobago" <?php if (!(strcmp("Trinidad-Tobago", $user['country']))) {echo "SELECTED";} ?>>Trinidad-Tobago</option>
            <option value="Tunesia" <?php if (!(strcmp("Tunesia", $user['country']))) {echo "SELECTED";} ?>>Tunisia</option>
            <option value="Turkey" <?php if (!(strcmp("Turkey", $user['country']))) {echo "SELECTED";} ?>>Turkey</option>
            <option value="Turkmenistan" <?php if (!(strcmp("Turkmenistan", $user['country']))) {echo "SELECTED";} ?>>Turkmenistan</option>
            <option value="United Arab Emirates" <?php if (!(strcmp("United Arab Emirates", $user['country']))) {echo "SELECTED";} ?>>United Arab Emirates</option>
            <option value="U.S. Virgin isl" <?php if (!(strcmp("U.S. Virgin isl", $user['country']))) {echo "SELECTED";} ?>>U.S. Virgin Islands</option>
            <option value="Uganda" <?php if (!(strcmp("Uganda", $user['country']))) {echo "SELECTED";} ?>>Uganda</option>
            <option value="Urugay" <?php if (!(strcmp("Urugay", $user['country']))) {echo "SELECTED";} ?>>Uruguay</option>
            <option value="Uzbekistan" <?php if (!(strcmp("Uzbekistan", $user['country']))) {echo "SELECTED";} ?>>Uzbekistan</option>
            <option value="Vanuatu" <?php if (!(strcmp("Vanuatu", $user['country']))) {echo "SELECTED";} ?>>Vanuatu</option>
            <option value="Vatican City" <?php if (!(strcmp("Vatican City", $user['country']))) {echo "SELECTED";} ?>>Vatican City</option>
            <option value="Venezuela" <?php if (!(strcmp("Venezuela", $user['country']))) {echo "SELECTED";} ?>>Venezuela</option>
            <option value="Vietnam" <?php if (!(strcmp("Vietnam", $user['country']))) {echo "SELECTED";} ?>>Vietnam</option>
            <option value="Wales" <?php if (!(strcmp("Wales", $user['country']))) {echo "SELECTED";} ?>>Wales</option>
            <option value="Yemen" <?php if (!(strcmp("Yemen", $user['country']))) {echo "SELECTED";} ?>>Yemen</option>
            <option value="Zaire" <?php if (!(strcmp("Zaire", $user['country']))) {echo "SELECTED";} ?>>Zaire</option>
            <option value="Zambia" <?php if (!(strcmp("Zambia", $user['country']))) {echo "SELECTED";} ?>>Zambia</option>
            <option value="Zimbabwe" <?php if (!(strcmp("Zimbabwe", $user['country']))) {echo "SELECTED";} ?>>Zimbabwe</option>
        </select>
      </div></td>
    </tr>
    <tr>
      <td align="right"><div align="left"><span class="properties">ZIP:</span></div></td>
      <td><div align="left">
        <input name="zip" type="text" class="properties" id="zip" value="<?=$user['zip']?>" maxlength="10">
      </div></td>
    </tr>
    <tr align="left" valign="bottom">
      <td height="47" colspan="2" class="category_heading">Preferences
      	<hr width="400"></td>
    </tr>
    <tr>
      <td align="right"><div align="left"><span class="properties">Date Format :</span></div></td>
      <td><div align="left">
        <input name="date_format" type="text" class="properties" id="date_format" value="<?=$user['date_format']?>" maxlength="10">
      </div></td>
    </tr>
    <tr>
      <td align="right"><div align="left"><span class="properties">Time Format :</span></div></td>
      <td><div align="left">
        <input name="time_format" type="text" class="properties" id="time_format" value="<?=$user['time_format']?>" maxlength="10">
      </div></td>
    </tr>
    <tr>
      <td align="right"><div align="left"></div></td>
      <td><div align="left"></div></td>
    </tr>
    <tr>
      <td align="right"><div align="left"></div></td>
      <td><div align="left">
        <input type="button" name="Button" value="Update" onMouseUp="Update()">
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
