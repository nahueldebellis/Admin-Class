<!-- llamo al php para obtener a los alumnos que busca -->
<?php include "../controller/busqueda.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Random</title>
</head>
<body>
	<form method="POST">
		<div>
			<div>Busqueda: (Elija uno)</div>
			<label>Por Grupo: </label>
			<input type="checkbox" name="Grupo"><br>
			<label>Por Nombre: </label>
			<input type="checkbox" name="Name"><br>
			<label>Por Promedio: </label>
			<input type="checkbox" name="Promedio"><br>

			<input type="text" name="busqueda" id="group">
			<button>Buscar</button>
		</div>
		<?php  
		echo "$es <br><br>";
		foreach($alumnos as &$a){
			foreach ($a as $key => $value) {
			?>
				<label><?php echo "$key --> $value"; ?></label><br>
				<?php
			}
			echo "<br>";
			
		}
			?>
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
