<?php
	include "../model/alumnos.php";
	$a = new Alumnos();

	$cambiar = $_POST["q"];
	$id = $_POST["id"];
	$cambio = $_POST["c"];
	if($cambiar=="notas"){
		$j = json_decode($cambio);
		$a->aNotas($id, $j);
	}
	elseif ($cambiar == "grupo") {
		$a->aGrupo($id, $cambio);
	}
	elseif($cambiar == "nnotas"){
		$a->agregarNota($id, $cambio);
	}
	else
		$a->actualizar($cambiar, $id, $cambio);

?>