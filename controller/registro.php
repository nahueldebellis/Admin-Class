<?php
	$max = $_GET["g"];
	$al = $_GET["a"];
	$alumnos = array();
	$idGrupos = array();

	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "Grupos";
	$connexion = new mysqli($server, $user, $password, $db);

	for($i=1; $i <= $max; $i++){
		for($j=1; $j <= $al; $j++){
			if(isset($_POST["presencia".$i.$j])){
				$b = 1;
			}
			else{
				$b = 0;
			}
			$group = $_POST["G".$i."A".$j];
			$alumnos[$group] = $_POST["G".$i];
			$idGrupos[$i] = $_POST["G".$i];

			$sql = "insert into groups values ('$b', '$group', '".$_POST["G".$i]."')";
			if(!$connexion->query($sql)){
				echo "<br>".$connexion->error."<br>";
			}
		}
	}
	$connexion->close();
	
?>