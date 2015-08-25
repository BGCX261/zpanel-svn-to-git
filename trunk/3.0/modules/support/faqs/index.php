<?php
$mysql = new MySQL($db_host,$db_user,$db_pass,$db_name);
$query="SELECT * FROM faqs";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
$i=0;
while ($i < $num) {
$question=mysql_result($result,$i,"question");
$answer=mysql_result($result,$i,"answer");


echo "<p><b>Q: $question</b><br>A: $answer</p>";

$i++;
}

?>
