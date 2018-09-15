<!DOCTYPE html>
<html>
<head>
	<title>Grupos</title>
</head>
<body>
<?php
	# Vista para el registro de alumnos y grupos
	$max = $_GET["CantGrupos"];
	$alumnos = $_GET["CantAlumnos"];
?>
	<form id="fr">
		<?php
			for($i=1; $i <= $max; $i++){
				?>
				<label>Grupo <?php echo $i; ?></label>
				<input type="text" name="G<?php echo $i; ?>" placeholder="Nombre del grupo"><br>
				<?php for($j=1; $j <= $alumnos; $j++){ ?>
					<input type="checkbox" name="presencia<?php echo $i; echo $j ?>" id="presencia" value="presente">
					<input type="text" name="G<?php echo $i; ?>A<?php echo $j; ?>" id="G<?php echo $i; ?>A<?php echo $j; ?>" placeholder="Nombre Alumno"><br>
				<?php
				}
				echo "<br>";
			}
		?>
	</form>
	<button onclick="a()">registrar alumnos</button>

	<script type="text/javascript">
		function a(){
			document.getElementById("fr").method = "POST";
			document.getElementById("fr").action="../controller/registro.php?g=<?php echo $max; ?>&a=<?php echo $alumnos;?>";
			document.getElementById("fr").submit();
			
		}
	</script>
</body>
</html>
