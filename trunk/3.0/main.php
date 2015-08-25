<p class="welcome">Welcome to {company}'s ZPanel. Use the options below to take control of your hosting!</p>
<?php
// Get modules
$path = $zpaneldirectory.'/modules';
$coldisplay = 6; // This is how many columns to display per row. It could be put in the config.php doc

$dir = opendir($path);
echo '<div id="mainnav">'."\n";
while($file = readdir($dir)) {
	$colcount = 1;
	//echo $path.'/'.$file.'<br>';
	if (is_dir($path.'/'.$file)) {
		//echo '&nbsp;&nbsp;&nbsp; Directory<br />';
		if (file_exists($path.'/'.$file.'/catinfo.zp.php')) {
		//echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Has catinfo file<br />';
			# This is a category, read the catinfo
			require_once($path.'/'.$file.'/catinfo.zp.php');
			
			# Verify category
			if (isset($thiscat['title'])) {
				// It's valid, send it to the screen.
				echo "<a name=\"".$file."\"></a><h3>".$thiscat['title']."</h3>\n";
				
				# Get modules
				$moddir = opendir($path.'/'.$file);
				while($modfile = readdir($moddir)) {
					if (is_dir($path.'/'.$file.'/'.$modfile)) {
						if (file_exists($path.'/'.$file.'/'.$modfile.'/modinfo.zp.php')) {
							# This is a module, read the modinfo
							require_once($path.'/'.$file.'/'.$modfile.'/modinfo.zp.php');
							//echo $path.'/'.$file.'/'.$modfile.'/modinfo.zp.php<br />';

							# Verify module
							if ((isset($thismod['title'])) && (isset($thismod['icon']))) {
								// It's valid, send it to the screen.
								if ($colcount == 1) {
									# Start the table
									echo "<table>\n  <tr>\n";
								}
								
								echo "    <td><a href=\"?cat=$file&page=$modfile\"><img src=\"modules/$file/$modfile/".$thismod['icon']."\" border=\"0\" /></a><br /><a href=\"?cat=$file&page=$modfile\">".$thismod['title']."</a></td>\n";
								
								if ($colcount == $coldisplay) {
									$colcount = 1;
									$tableopen = 0;
									echo "  </tr>\n</table>\n";
								}else{
									$colcount = $colcount + 1;
									$tableopen = 1;
								}
							}
						}
						
					}
				}
			if ($tableopen) {
				echo "  </tr>\n</table>\n";
			}
			} #end verify category
		} # end file_exists
	} # end is_dir
}
echo "</div>\n";
?>
<br /><br />
