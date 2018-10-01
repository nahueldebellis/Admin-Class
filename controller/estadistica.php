<?php 
	include "../model/alumnos.php";
	$a = new Alumnos();
	$alumnos = $a->getAlumnosProm($_GET["q"]);
?>
