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
			<br>
			<table border="1">
				<th>Presencia</th>
				<th>Nombre</th>
				<th>Grupo</th>
				<th></th>

				<?php  
				foreach($alumnos as &$a){
					echo "<tr>";
					foreach ($a as $key => $value) {
					?>
							<td><?php echo "$value"; ?></td>
						<?php
					}
					echo "<td><a href='#'>Cambiar</a></td>";
					echo "</tr>";
					
				}
					?>
			</table>
		</form>

		<button>Random Group</button>
		
	</body>
	<script type="text/javascript">
		
		
	</script>
</html>
