<?php
	# Filtra por nombre del grupo
	$g = $_POST["group"];
	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "Grupos";
	$conn = new mysqli($server, $user, $password, $db);
	$sql = "Select * from groups where grupo='$g'";
	$resul = $conn->query($sql);
	while($row = $resul->fetch_assoc()){
		echo $row["presencia"]." ".$row["nombre"]." ".$row["grupo"]."<br>";
	}

?>