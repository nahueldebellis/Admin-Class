<?php
	include "../model/alumnos.php";
	$a = new Alumnos();

	$max = $_GET["g"];
	$al = $_GET["a"];
	$alumnos = array();
	$idGrupos = array();

	for($i=1; $i <= $max; $i++){
		for($j=1; $j <= $al; $j++){
			if(isset($_POST["presencia".$i.$j])){
				$b = 1;
			}
			else{
				$b = 0;
			}
			$group = $_POST["G".$i."A".$j];
			$alumno = $_POST["G".$i];#grupo

			$idGrupos[$i] = $_POST["G".$i];
			$a->insert($b, $alumno, $group);
		}
	}

	
?>