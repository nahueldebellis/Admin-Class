<!DOCTYPE html>
<html>
<head>
	<title>Grupos</title>
</head>
<body>
<?php
	$alumnos = $_GET["CantAlumnos"];
?>
	<form id="fr" action="../controller/registro.php?g=<?php echo $alumnos; ?>" method="POST">
				<?php for($j=1; $j <= $alumnos; $j++){ ?>
					<input type="hidden" name="G<?php echo $j; ?>" value="none">
					<input type="checkbox" name="presencia<?php echo $j ?>" id="presencia" value="presente">
					<input type="text" name="GA<?php echo $j; ?>" id="GA" placeholder="Nombre Alumno"><br>
				<?php
				}
				echo "<br>";
		
		?>
		<button>registrar alumnos</button>
	</form>
</body>
</html>
