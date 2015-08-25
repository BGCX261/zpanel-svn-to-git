<?php
# TO DEBUG THE APP
# change this to 'on' (default: 'off')
ini_set('display_errors','on');

# Include vital runtime files
include ('includes/hub.php');

$template['path'] = 'templates/zpanelv3';

echo eval(CreatePage());
?>
