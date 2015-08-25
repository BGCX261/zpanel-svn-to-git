<p>This page allows you to view the status of certain services which may influence your hosting with us.</p>
<?php
ini_set('display_errors','0'); 
$OS = strtolower(PHP_OS);

// Server Addresses
$httpd = "localhost";
$ftpd = "localhost";
$smtp = "localhost";
$pop = "localhost";
$mysql = $settings['zp_host'];
$zpanel = "localhost";

function lookup_ports($hport,$hdomain) {
         $fp = fsockopen($hdomain, $hport,$errno,$errstr, 4);
         if (!$fp){
             $data = "<td width=50px>down</td><td width=20px><img src=modules/webserver/serverstatus/red-status.gif></td>";
         } else {
             $data = "<td width=50px>up</td><td width=20px><img src=modules/webserver/serverstatus/green-status.gif></td>";
             fclose($fp);
         }
         return $data;
}
echo "<table align=center border=0 width=80%>";
echo "<tr><td>http (".$_SERVER["SERVER_SOFTWARE"].")</td>".lookup_ports("80", $httpd)."</td></tr>\n";
echo "<tr><td>ftp</td>".lookup_ports("21", $ftpd)."</td></tr>\n";
echo "<tr><td>smtp</td>".lookup_ports("25", $smtp)."</td></tr>\n";
echo "<tr><td>pop</td>".lookup_ports("110", $pop)."</td></tr>\n";
echo "<tr><td>mysql</td>".lookup_ports("3306", $mysql)."</td></tr>\n";
echo "<tr><td>ZPanel</td>".lookup_ports("1818", $zpanel)."</td></tr>\n";

if($OS == "linux"){
//Load and Uptime (Linux)
$data = shell_exec('uptime');
$uptime = explode(' up ', $data);
$uptime = explode(',', $uptime[1]);
$uptime = $uptime[0].', '.$uptime[1];
$loadavg_array = explode(" ", exec("cat /proc/loadavg"));
$loadavg = $loadavg_array[2];

echo "<tr><td>Server Load</td><td colspan=2>".$loadavg."<img src=modules/webserver/serverstatus/spacer.gif height=20px width=1px></td></td></tr>\n";
echo "<tr><td colspan=3 valign=center><center>Server Uptime ".$uptime."<img src=modules/webserver/serverstatus/spacer.gif height=20px width=1px></center></td></tr>\n";
} elseif ($OS == "winnt"){
//Uptime (Windows)
$pagefile = 'c:\pagefile.sys'; // Path to system pagefile. Default is c:\\pagefile.sys
function ifif ($value, $true, $false)
{
    if ($value == 0)
    {
        return $false;
    }
    else
    {
        return $true;
    }
}
$upsince = filemtime($pagefile);
$gettime = (time() - filemtime($pagefile));
$days = floor($gettime / (24 * 3600));
$gettime = $gettime - ($days * (24 * 3600));
$hours = floor($gettime / (3600));
$gettime = $gettime - ($hours * (3600));
$minutes = floor($gettime / (60));
$gettime = $gettime - ($minutes * 60);
$seconds = $gettime;
$days   = ifif($days != 1, $days . ' days', $hours . ' day');
$hours   = ifif($hours != 1, $hours . ' hours', $hours . ' hour');
$minutes = ifif($minutes != 1, $minutes . ' minutes', $minutes . ' minute');
$seconds = ifif($seconds != 1, $seconds . ' seconds', $seconds . ' second'); 

echo "<tr><td colspan=3 valign=center><center>Server Uptime ".$days." ".$hours." ".$minutes." ".$seconds;
echo "<br /> Up since: ".date('l. F jS, Y. h:i a', $upsince); 
echo "</center></td></tr>\n";
} else{
echo "<!-- Unable to show uptime/load: Unsupported Operating System -->";
}
echo "</table>";
?>

