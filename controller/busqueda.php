<?php
	# Filtra por nombre del grupo.
	#llamo model
	include "../model/alumnos.php";
	$alum = new Alumnos();
	$alumnos;
	if(isset($_POST["Name"])){
		$alumnos = $alum->byName($_POST["busqueda"]);
	}
	elseif(isset($_POST["Grupo"])){
		$alumnos = $alum->byGroup($_POST["busqueda"]);
	}
	elseif(isset($_POST["Promedio"])){
		$alumnos = $alum->byProm($_POST["busqueda"]);
	}
	else{
		$alumnos = $alum->getAll();
	}


?>