<?php
	include "../model/alumnos.php";
	$a = new Alumnos();

	$max = $_GET["g"];
	$alumnos = array();
	$idGrupos = array();
		for($j=1; $j <= $max; $j++){
			if(isset($_POST["presencia".$j])){
				$b = 1;
			}
			else{
				$b = 0;
			}
			$group = $_POST["G".$j];
			$alumno = $_POST["GA".$j];#grupo

			$idGrupos[$j] = $_POST["G".$j];

			$a->insert($b, $group, $alumno);
		}
	

	
?>