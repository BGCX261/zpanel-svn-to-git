<?php
/*
/ Functions file. Functions in this file are used throughout ZPanel.
/
/ Created: 3/20/2005
/ Last Edited: 9/9/2005 - KGA
*/

// Function: Clean
// Creation Date: 3/20/2005
// Alter Date: 3/20/2005
// Usage: Restricts the input to a certain number of words.
function Clean($subject, $restriction) {
        $subject = trim($subject);
        $subject = addslashes($subject);

        // Break down spaces and only return the first "words"
        if (strpos($subject,' ')) {
                $subject = explode(' ', $subject);
                $newstring = '';
                for ($i=0; $i <= $restriction-1; $i++) {
                        $newstring .= $subject[$i].' ';
                }
                $subject = trim($newstring);
        }

        return $subject;
}


// Function: New Month
// Creation Date: 3/28/2005
// Alter Date: 3/28/2005
// Usage: Used to process billing if it's a new month. This will charge all accounts for the
//                amount of the package in which they are assigned.
//
//      THIS FUNCTION IS NOT FINISHED
//
function newmonth(){
        if (date("d") >= '01') {
                if ($row_Config['billsent'] == '12') {
                        if (date("m") >= '01' && date("m") != '12') {

                                mysql_select_db($database_Customer_Database, $Customer_Database);

                                $updateSQL = "INSERT INTO `billingbase` VALUES (NULL,'".$username."','".date("m-d-Y")."',". $payment .",'Paypal','0','debit','Payment Denied')";
                                $Result1 = mysql_query($updateSQL, $Customer_Database) or die(mysql_error());

                                $updateSQL2 = "UPDATE config SET billsent='".date("m")."'";
                                $Result1 = mysql_query($updateSQL2, $Customer_Database) or die(mysql_error());

                        }
                }elseif (date("m") >= $row_Config['billsent']) {

                                mysql_select_db($database_Customer_Database, $Customer_Database);

                                $updateSQL = "INSERT INTO `billingbase` VALUES (NULL,'".$username."','".date("m-d-Y")."',". $payment .",'Paypal','0','debit','Payment Denied')";
                                $Result1 = mysql_query($updateSQL, $Customer_Database) or die(mysql_error());

                                $updateSQL2 = "UPDATE config SET billsent='".date("m")."'";
                                $Result1 = mysql_query($updateSQL2, $Customer_Database) or die(mysql_error());
                }
        }
}

// Function: Rec_Copy
// Creation Date: 3/28/2005
// Alter Date: 4/5/2005
// Usage: Used to copy the contents of a folder to another location.
function rec_copy($to_path, $from_path) {
        //Sanitize input so ../ isn't allowed (Bug #933)
        $to_path = str_replace('../', '', $to_path);

        //Continue with the copying!
        mkdir($to_path, 0777);
        $this_path = getcwd();
        if (is_dir($from_path)) {
                chdir($from_path);
                $handle=opendir('.');
                while (($file = readdir($handle))!==false) {
                        if (($file != ".") && ($file != "..")) {
                                if (is_dir($file)) {
                                        rec_copy ($to_path.$file."/", $from_path.$file."/");
                                        chdir($from_path);
                                }
                                if (is_file($file)){
                                        copy($from_path.$file, $to_path.$file);
                                }
                        }
                }
        closedir($handle);
        }
}

// Function: CheckFolderSize
// Creation Date: 3/29/2005
// Alter Date: 3/29/2005
// Usage: Uses diruse.exe to get the size of a folder, much quicker than the previous method.
function CheckFolderSize($path, $root) {
        echo '<!--- ';
        $last_line = system($root.'/exe/diruse.exe /M "'.$path.'"', $retval);
        echo ' --->';

        $size = explode(' ',trim($last_line));

        return $size[0];
}

// Function: GetFileCount
// Creation Date: 3/29/2005
// Alter Date: 3/29/2005
// Usage: Counts the amount of files in a directory. Very simuler to CheckFolderSize
function GetFileCount($path, $root) {
        echo '<!--- ';
        $last_line = system($root.'/exe/diruse.exe /M "'.$path.'"', $retval);
        echo ' --->';

        $size = explode(' ',trim($last_line));

        return $size[2];
}

// Function: OnlineUsers
// Creation Date: 5/9/2005
// Alter Date: 5/9/2005
// Usage: Displays how many users are online.
function OnlineUsers($db, $conn) {
        mysql_select_db($db, $conn);
        $query_OnlineUsers = sprintf("SELECT COUNT(*) as TheTotal FROM execlients");

        $OnlineUsers = mysql_query($query_OnlineUsers, $conn) or die(mysql_error());
        $row_OnlineUsers = mysql_fetch_assoc($OnlineUsers);

        return $row_OnlineUsers['TheTotal'];
}

// Function: OS
// Creation Date: 9/9/2005
// Alter Date: 9/9/2005 - KGA
// Usage: Checks what operating system is running on the server
function OS() {
        switch (strtoupper(substr(PHP_OS, 0, 3))) {

        case 'WIN':
                return 'Windows';
                break;
        case 'LIN':
                return 'Linux';
                break;
        case 'FRE':
                return 'FreeBSD';
                break;
        }
}

// Function: KernelVer
// Creation Date: 9/9/2005
// Alter Date: 9/9/2005 - KGA
// Usage: Checks what kernal is running on the server
function KernelVer() {
	// This only works if you're running linux
	$version = exec('uname -r');
	return $version;
}

// Function: Current OS
// Creation Date: 5/10/2006
// Usage: Drop Down or Image
function current_os($os='',$type) {
  global $row_Config;

        if ($type == 'select') {
                if ($row_Config['loginimage'] == $os) {
                        return ' selected="selected"';
                }
        }elseif ($type == 'image') {

          if ($row_Config['loginimage'] == 'Windows') { return 'windows'; }elseif
             ($row_Config['loginimage'] == 'Linux')  { return 'nix'; }elseif
             ($row_Config['loginimage'] == 'Apple')  { return 'apple'; }

        }
}

// Function: File Size Converter
// Creation Date: 5/14/2006
// Usage: file_size(bytes)
function file_size($size) {
  $i=0;
  $iec = array("MB", "GB", "TB", "PB", "EB", "ZB", "YB");
  while (($size/1024)>1) {
   $size=$size/1024;
   $i++;
  }
  return substr($size,0,strpos($size,'.')+4).' '.$iec[$i];
}

// Function: UnZip
// Creation Date: 7/28/2005
// Alter Date: 7/28/2005 - KGA
// Usage: Uses either unzip on the system or unzip.exe
function unzip($src,$loc) {
        global $zpaneldirectory;

        if (OS() != 'Windows') {
                // We are using a *nix system.
                $command = "unzip \"$src\" -d \"$loc\"";
                $makedir = "mkdir -p $loc";
        }else{
                // Using Windows
                $command = "$zpaneldirectory\includes\exe\unzip.exe \"$src\" -d \"$loc\"";
                $makedir = "mkdir $loc";
        }

        shell_exec($makedir);
        shell_exec($command);
}

// Function: BBCode
// Creation Date: 8/11/2006
// Alter Date: 8/11/2006 - JNC
// Usage:
function bbcode($message) {
        function replaceMessage($message) {
                $message    = strip_tags($message, '<b></b><i></i><u></u><a></a><img>');
                $message    = str_ireplace ("\n", "<BR>", "$message");
                // When you store the $message in a database you might get errors cause of the quotes
                $message    = str_ireplace("[singleQuote]", "'", $message);
                $message    = str_ireplace("[doubleQuote]", "\"", $message);

                $message    = str_ireplace ("[U]", "<U>", "$message");
                $message    = str_ireplace ("[/U]", "</U>", "$message");
                $message    = str_ireplace ("[I]", "<I>", "$message");
                $message    = str_ireplace ("[/I]", "</I>", "$message");
                $message    = str_ireplace ("[B]", "<B>", "$message");
                $message    = str_ireplace ("[/B]", "</B>", "$message");

                $message    = replaceUrl($message);
                $message    = replaceImg($message);

                return $message;
        }

        function replaceImg($message) {
                // Make image from [img]htp://.... [/img]
                while(strpos($message, "[img]")!==false){
                        $begImg = strpos($message, "[img]");
                        $endImg = strpos($message, "[/img]");
                        $img = substr($message, $begImg, $endImg-$begImg+6);

                        $link        = substr($img, 5, $endImg - $begImg -5);
                        $htmlImg    = "<img src=\"$link\">";

                        $message = str_replace($img, $htmlImg, $message);
                        // searches for other [img]-nodes
                }
                return $message;
        }

        function replaceUrl($message) {
                // Make link from [url]htp://.... [/url] or [url=http://.... ]text[/url]
                while(strpos($message, "[url")!==false){
                        $begUrl = strpos($message, "[url");
                        $endUrl = strpos($message, "[/url]");
                        $url = substr($message, $begUrl, $endUrl-$begUrl+6);
                        $posBracket = strpos($url, "]");

                        if ($posBracket != null){
                                if ($posBracket == 4){
                                        // [url]http://.... [/url]
                                        $link        = substr($url, 5, $endUrl - $begUrl -5);
                                        $htmlUrl    = "<a href=\"$link\">$link</a>";
                                }else{
                                        // [url=http://....]text[/url]
                                        $link        = substr($url, 5, $posBracket-5);
                                        $text        = substr($url, $posBracket+1, strpos($url, "[/url]") - $posBracket-1);
                                        $htmlUrl    = "<a href=\"$link\">$text</a>";
                                }
                        }

                        $message = str_replace($url, $htmlUrl, $message);
                        // searches for other [url]-nodes
                }
        }

        return replaceMessage(replaceImg(replaceUrl($message)));
}
function ApacheVer() {
        $version = shell_exec('httpd -v');
        $start = strpos($version,'/') + 1;
        $subver = nl2br(substr($version, $start));
        $theend = strpos($subver,'br') -1;

        return substr($subver, 0, $theend);
}


function CreatePage() {
        global $template, $_GET, $zpaneldirectory, $user, $config, $settings, $package, $DB;

        if (!isset($_GET['page'])){
                        $body = "main.php";
        }else{
                        if (!isset($_GET['ext']) || $_GET['ext'] == ''){
                                        if ($_GET['page'] == "main") {
                                                        $body = "main.php";
                                        }else{
                                                        $body = "modules/" . $_GET['cat'] . "/" . $_GET['page'] . "/index.php";

                                                        //Load module information
                                                        require("modules/" . $_GET['cat'] . "/" . $_GET['page'] . "/modinfo.zp.php");
                                        }
                        }else{
                                        $body = "modules/" . $_GET['cat'] . "/" . $_GET['page'] . "/" . $_GET['ext'] . ".php";

                                        //Load module information
                                        require("modules/" . $_GET['cat'] . "/" . $_GET['page'] . "/modinfo.zp.php");
                        }
        }

        // Get Template
        $templatefile = $template['path'].'/template.php';
        $fd = fopen($templatefile,'r');
        $fileContents = fread($fd,filesize($templatefile));
        fclose($fd);

        // Get Content
        $file = $body;
        $fd = fopen($file,'r');
        $content = fread($fd,filesize($file));
        fclose($fd);

	// Get Header
        $headerfile = 'includes/pagehead.php';
        $fd = fopen($headerfile,'r');
        $pageheader = fread($fd,filesize($headerfile));
        fclose($fd);

	// Load xajax functions
	include_once ('ajax_functions.php');

        #
        # Replace template variables
        #

        function TemplateReplace($content,$type,$body=0) {
                global $user, $config, $settings, $template, $package, $DB, $pageheader, $xajax;
                if ($type=='template') { global $bodycontent; }

                // Look for if statements
                $fileContents = str_replace('{if:tech}', '<?php if ($user[\'tech\']) {?>',$content);
                $fileContents = str_replace('{if:linux}', '<?php if (OS() == \'Linux\') {?>',$fileContents);
		$fileContents = str_replace('{if:windows}', '<?php if (OS() == \'Windows\') {?>',$fileContents);
                $fileContents = str_replace('{if!linux}', '<?php if (OS() != \'Linux\') {?>',$fileContents);
                $fileContents = str_replace('{if!windows}', '<?php if (OS() != \'Windows\') {?>',$fileContents);
                $fileContents = str_replace('{/if}', '<?php } ?>',$fileContents);

		// User Information
		$usrvars = $DB->GetAll('SHOW COLUMNS FROM accounts');
		foreach ($usrvars AS $var) {
	            $fileContents = str_replace('{user:'.$var[0].'}', $user[$var[0]],$fileContents);
		}

                // Plan  Information
		$pkgvars = $DB->GetAll('SHOW COLUMNS FROM packages');
		foreach ($pkgvars AS $var) {
        	        $fileContents = str_replace('{package:'.$var[0].'}', $package[$var[0]],$fileContents);
		}

		// Usage Information
		$fileContents = str_replace('{usage:ftp}', UsageInfo('ftp'),$fileContents);
		$fileContents = str_replace('{usage:space}', UsageInfo('space'),$fileContents);
		$fileContents = str_replace('{usage:domains}', UsageInfo('domains'),$fileContents);
                $fileContents = str_replace('{usage:subdomains}', UsageInfo('subdomains'),$fileContents);
		$fileContents = str_replace('{usage:parked}', UsageInfo('parkeddomains'),$fileContents);
                $fileContents = str_replace('{usage:sql}', UsageInfo('mysql'),$fileContents);

                // Final Content
                $fileContents = str_replace('{company}', $config['company'], $fileContents) or die ('Ooops');
		$fileContents = str_replace('{apachever}', ApacheVer(),$fileContents);
		$fileContents = str_replace('{phpver}', phpversion(),$fileContents);
		$fileContents = str_replace('{kernelver}', KernelVer(),$fileContents);
		$fileContents = str_replace('{mysqlver}', $DB->GetOne('SELECT version( ) ;'),$fileContents);
		$fileContents = str_replace('{operatingsystem}', OS(),$fileContents);
                $fileContents = str_replace('{templatepath}', $template['path'],$fileContents);
		$fileContents = str_replace('{zpanelheader}', '<?php include(\'includes/pagehead.php\'); ?>',$fileContents);

                if ($type == 'template') {
                        $fileContents = str_replace('{content}', $body,$fileContents);
                }

                return $fileContents;
        }

        $bodycontent = TemplateReplace($content,'body');
        $templatecontent = TemplateReplace($fileContents,'template',$bodycontent);


        $finalcontents = str_replace('<'.'?php','<'.'?',$templatecontent);
        $finalcontents = '?'.'>'.trim($finalcontents).'<'.'?';

        return eval($finalcontents);
}

function du($dir){
 global $settings;
 if (OS() == 'Windows') {

   // Handle on a Windows system
   // Kris: I uploaded a file called diruse.exe to the bin directory.
   //       use case is: diruse /b "C:\program files"
	
 }else{
   $du = popen("du -sk $dir", "r");
   $res = fgets($du, 256);
   pclose($du);
   $res = str_replace(' ', ' ',$res);
   $res = str_replace(' ', ' ',$res);
   $res = explode(' ', $res);

   return $res[0];
 }
}

function UserUsage($homedir) {
        return du($homedir);
}

function UsageInfo($object,$usr = 0) {
	global $DB,$settings,$user;

	if ($usr == 0) { $usr = $user['username']; }

	// MySQL Usage
	if ($object == 'mysql') {
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
		return $ADMDB->GetOne("SELECT COUNT(*) FROM db WHERE User = '".$usr."'");
	}

	// FTP Usage
	if ($object == 'ftp') {
		return $DB->GetOne("SELECT COUNT(*) FROM accounts_ftp WHERE owner='".$usr."'");
	}

	// Domains
	if ($object == 'domains') {
		return $DB->GetOne("SELECT COUNT(*) FROM domains WHERE parked!=1 AND masterdomain='' AND user='".$usr."'");
	}

	// Subdomains
	if ($object == 'subdomains') {
		return $DB->GetOne("SELECT COUNT(*) FROM domains WHERE parked!=1 AND masterdomain!='' AND user='".$usr."'");
	}

	// Parked Domains
	if ($object == 'parkeddomains') {
                return $DB->GetOne("SELECT COUNT(*) FROM domains WHERE parked=1 AND masterdomain='' AND user='".$usr."'");
        }

	// Space (only available for current user)
	if ($object == 'space') {
                $homedir = str_replace('/public_html','',$user['homedir']);
 
	        $bytes = array("B", "KB", "MB", "GB", "TB", "PB");
                $size = du($homedir);

                $i = 0;
                while ($size >= 1024) {
                        $size = $size/1024;
			$i++;
                }

                if ($i > 1) {
			$friendly = round($size,1)."&nbsp;".$bytes[$i];
		} else {
			$friendly = round($size,0)."&nbsp;".$bytes[$i];
		}

		return $friendly;
	}
}

// Function: Create VHosts
// Creation Date: 7/31/2005
// Alter Date: 7/31/2005 - KGA
// Usage: Creates the VirtualHost file located in the includes/ directory.
//        For this to work, there must be an "Include" in the httpd.conf
function CreateVH() {
        global $DB,$settings;

	$result = $DB->GetAll("SELECT * FROM domains");
        $vhosts = '';

        foreach ($result AS $dom) {
                if ($dom['parked'] == 0) {
                        $root = substr(UserInfo($dom['user'],'homedir'),0,-12);
                        $path = substr($dom['path'],0,-1);
                        $fullpath = $root.'/public_html'.$path;
                        $vhosts .= "<VirtualHost *:80>
    ServerName ".$dom['domain']."
    DocumentRoot \"$fullpath\"
    ErrorLog \"$root/logs/error.log\"
    CustomLog \"$root/logs/access.log\" combined
</VirtualHost>
";
                }else{
                        $fullpath = $settings['path'].'/parking';
                        $vhosts .= "<VirtualHost *:80>
    ServerName ".$dom['domain']."
    DocumentRoot \"$fullpath\"
</VirtualHost>
";
                }
        }

        // Create vh structure
        if (!file_exists($root.'/logs')) { shell_exec('mkdir '.$root.'/logs'); }

        $handle = fopen($settings['path'].'/../conf/vhosts.conf', 'w+');
        fwrite($handle, $vhosts);
        fclose($handle);

        shell_exec('service httpd restart');

}

// Function: User Details
// Creation Date: 7/29/2005
// Alter Date: 7/29/2005 - KGA
// Usage: Returns a certain column from the user table
function UserInfo($id,$col) {
        global $DB;

	$detail = $DB->GetOne("SELECT $col FROM accounts WHERE username='$id'");
        return $detail;
}

function LogFailure($user) {
	global $_SERVER,$DB;

	$timestamp = time();
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$visitor_host = @getHostByAddr( $ip );
	$referer_page = $_SERVER['HTTP_REFERER'];
	$requested_page = $_SERVER['REQUEST_URI'];
	$browser = $_SERVER['HTTP_USER_AGENT'];

	$details = addslashes("Possible intruder's details:\n
<b>IP Address:</b> $ip
<b>Hostname:</b> $visitor_host
<b>Referer:</b> $referer_page
<b>Requested Page:</b> $requested_page
<b>Browser:</b> $browser");

	$DB->Execute("INSERT INTO logs (type,timestamp,summary,details,user,ip) VALUES ('Warning','$timestamp','Failed login attempt.','$details','$user','$ip')");
}

?>
