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

				<?php  
				foreach($alumnos as &$a){
					foreach ($a as $key => $value) {
						$id = $a["id"];
						if(!($key == "id"))
							echo "<th>$key</th>";
					}
					echo "<th></th><tr>";
					foreach ($a as $key => $value) {
						if(!($key == "id")){
					?>
							<td><a onclick="cambio('<?php echo "$key"; ?>', <?php echo "$id"; ?>)"><?php echo "$value"; ?></a></td>
						<?php
						}
					}
					echo "<td><a onclick='agregarNota($id)'>Agregar nota</a></td>";
					echo "</tr>";
					
				}
					?>
			</table>
		</form>

		<button>Random Group</button>
		
	</body>
	<script type="text/javascript">
		function cambio(strCambio, id){
			if(strCambio != "notas"){
				let change = prompt("Ingrese el cambio: ");
			}
			else{
				let change = prompt("Ingrese las notas separadas por espacios: ");
			}
			let ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function(){
				if(this.status === 200 && this.readyState === 4){
					let r = this.responseText;
				}
			}
			ajax.open("GET", "/jaja.php", true);
			ajax.send("q=${strCambio}&id=${id}&c=${change}");
		}

		function agregarNota(strId){
			let change = prompt("Nueva nota: ");
			let ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function(){
				if(this.status === 200 && this.readyState === 4){
					let r = this.responseText;
				}
			}
			ajax.open("GET", "/jaja.php", true);
			ajax.send("q=nota&id=${strId}&c=${change}");
		}
		
	</script>
</html>