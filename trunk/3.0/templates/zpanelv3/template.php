<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>{company} &bull; Control Panel</title>
		<link rel="stylesheet" type="text/css" href="{templatepath}/style.css" title="Default">
		<link rel="stylesheet" type="text/css" href="{templatepath}/modules.css" title="Default">
		{zpanelheader}
	</head>

	<body>
		<div id="topbar"></div>
		<div id="container">
			<div id="navcontainer">
				<div id="nav">
					<a href="?">Home</a>
					<a href="?cat=support&page=ticket_center">Support</a>
					<a href="?page=privatemessages">Inbox (0)</a>
					<a href="logout.php">Logout</a>					
				</div>
				<div id="logo"></div>
			</div>
			
			<div id="infocontainer">
				<table>
					<tr>
						<td>Username</td>
						<td>{user:username}</td>
					</tr>
					<tr>
						<td>Hosting Plan</td>
						<td>{package:name}</td>
					</tr>
					<tr>
						<td>Contact Email</td>
						<td><a href="?cat=accountinfo&page=my_account">Click to Update</a></td>
					</tr>
					<tr>
						<td>Domains</td>
						<td>{usage:domains} / {package:maxdomains}</td>
					</tr>
					<tr>
						<td>Subdomains</td>
						<td>{usage:subdomains} / {package:maxsubs}</td>
					</tr>
					<tr>
						<td>Parked Domains</td>
						<td>{usage:parked} / {package:maxparked}</td>
					</tr>
					<tr>
						<td>Databases</td>
						<td>{usage:sql} / {package:maxsql}</td>
					</tr>
					<tr>
						<td>Disk Usage</td>
						<td>{usage:space} / {package:quota} MB</td>
					</tr>
					<tr>
						<td>FTP Accounts</td>
						<td>{usage:ftp} / {package:maxftp}</td>
					</tr>
				</table>
				<table>
					<tr>
						<td>Operating System</td>
						<td>{operatingsystem}</td>
					</tr>
					<tr>
						<td>Service Status</td>
						<td><a href="?cat=webserver&page=serverstatus">Click to View</a></td>
					</tr>
{if:linux}
					<tr>
						<td>Kernel Version</td>
						<td>{kernelver}</td>
					</tr>
{/if}
					<tr>
						<td>PHP Version</td>
						<td>{phpver}</td>
					</tr>
					<tr>
						<td>PHP Info</td>
						<td><a href="?cat=webserver&page=phpinfo">Click to View</a></td>
					</tr>
					<tr>
                                                <td>MySQL Version</td>
                                                <td>{mysqlver}</td>
                                        </tr>
				</table>
			</div>
			<div id="contentcontainer">
				{content}
			</div>
		</div>
	</body>
</html>
