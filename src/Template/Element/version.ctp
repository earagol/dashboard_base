<?php 
$command = "git describe";
echo "<p>Versión ".exec('git describe')."</p>";

?>