<?php
	include "../model/alumnos.php";
	$a = new Alumnos();

	$max = $_GET["g"];
	$curso = $_GET["c"];
	$id = $a->insertCurso($curso);
	$alumnos = array();
	$idGrupos = array();
	for($j=1; $j <= $max; $j++){
		if(isset($_POST["presencia".$j])){
			$b = 1;
		}
		else{
			$b = 0;
		}
		$alumno = $_POST["GA".$j];
		$apellido = $_POST["AP".$j];

		$idGrupos[$j] = $_POST["G".$j];
		$a->insertAlumno($b, $alumno, $apellido, $id["id"]);
	}
	$a->closeConn();

	header("Location: ../view/index.php");
?>