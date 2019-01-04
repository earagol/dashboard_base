<?php 
$command = "git describe";
$ex = exec($command,$output,$salida);
echo "<p>Versión ".$salida."</p>";

?>