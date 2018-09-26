<?php
	# Filtra por nombre del grupo.
	#llamo model
	include "../model/alumnos.php";
	$alum = new Alumnos();
	$alumnos;
	if(isset($_POST["Name"])){
		$alumnos = $alum->byName($_POST["busqueda"], $_POST["curso"]);
	}
	elseif(isset($_POST["Grupo"])){
		$alumnos = $alum->byGroup($_POST["busqueda"], $_POST["curso"]);
	}
	elseif(isset($_POST["apellido"])){
		$alumnos = $alum->byApellido($_POST["busqueda"], $_POST["curso"]);
	}
	elseif(isset($_POST["Promedio"])){
		$alumnos = $alum->byProm($_POST["busqueda"], $_POST["curso"]);
	}
	else{
		@$alumnos = $alum->getAll($_POST["curso"]);
	}


?>