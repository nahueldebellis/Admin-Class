<!-- llamo al php para obtener a los alumnos que busca -->
<!DOCTYPE html>
<html>
<head>
	<title>Random</title>
</head>
<body>
	<form method="POST" action="../presencia.php">
		<?php  
		$i=0;
		foreach ($alumnos as $key => $value) {
		?>
			<label>Presencia: </label>
			
			<label>Alumno: <?php echo $key; ?></label>
			<label>Grupo: <?php echo $value; ?></label><br>
			<?php
			$i++;
		}
			?>
			<input type="text" name="group" id="group">
			<button>Buscar Grupo</button>
	</form>

	<button onclick="Pase()">Random Group</button>
	
</body>
	<script type="text/javascript">
		var rand;
		function Pase(){
			let max = <?php echo "$max"; ?>;
			rand = Math.floor(Math.random()*(max-1) + 1);
			alert("Grupo "+rand);
		}
	</script>
</html>
