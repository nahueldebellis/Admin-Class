<!DOCTYPE html>
<html>
<head>
	<title>Grupos</title><link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
		<header>
			<h1>AClass</h1>
			<nav>
				<ul>
					<li><a href="index.php">Inicio</a></li>
					<li><a href="#j">Acerca de nosotros</a></li>
				</ul>
			</nav>
		</header>
<?php
	$alumnos = $_GET["CantAlumnos"];
	$curso = $_GET["curso"];
?>
	<form id="fr" action="../controller/registro.php?g=<?php echo $alumnos; ?>&c=<?php echo $curso; ?>" method="POST">
				<?php for($j=1; $j <= $alumnos; $j++){ ?>
					<input type="hidden" name="G<?php echo $j; ?>" value="none">
					<input type="checkbox" name="presencia<?php echo $j ?>" id="presencia" value="presente">
					<input type="text" name="GA<?php echo $j; ?>" id="GA" placeholder="Nombre Alumno"><br>
					<input type="text" name="AP<?php echo $j; ?>" id="GA" placeholder="Apellido Alumno"><br>
				<?php
				}
				echo "<br>";
		
		?>
		<button>registrar alumnos</button>
	</form>
</body>
</html>
