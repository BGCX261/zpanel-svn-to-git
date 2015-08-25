<?php
include('includes/hub.php');
$_SESSION = array();
session_destroy();
?>
<script language="javascript">window.location = "index.php";</script>
You are now logged out. <a href="index.php">Click here</a> to log back in.
