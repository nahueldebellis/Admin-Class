<?php 
	include "../model/contenido.php";
	$content = new Contenido();
	if(isset($_POST["nombre"])){
		$curso = $_POST["curso"];
		$tema = $_POST["nombre"];
		$content->insertContents($curso, $tema);
		header("Location: ../view/busqueda.php?q=$curso");
	}
	else{
		$curso = $_GET["q"];
		$res = $content->getContents($curso);
	}
?>