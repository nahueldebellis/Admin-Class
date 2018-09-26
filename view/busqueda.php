<!-- llamo al php para obtener a los alumnos que busca -->
<?php include "../controller/busqueda.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Random</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<header>
			<h1>AClass</h1>
			<nav>
				<ul>
					<li><a href="index.php">Inicio</a></li>
					<li><a href="#estadistica">Estadistica</a></li>
				</ul>
			</nav>
		</header>
		<form method="POST">
				<input type="hidden" value="<?php echo $_GET["q"] ?>" name="curso">
			<div>
				<div>Busqueda: (Elija uno)</div><br>
				<label>Por Grupo: </label>
				<input type="checkbox" name="Grupo"><br>
				<label>Por Nombre: </label>
				<input type="checkbox" name="Name"><br>
				<label>Por Apellido: </label>
				<input type="checkbox" name="apellido" placeholder="Apellido"><br>
				<label>Por Promedio: </label>
				<input type="checkbox" name="Promedio"><br>

				<input type="text" autocomplete="off" name="busqueda" id="group">
				<button>Buscar</button>
			</div>
			<br>
			<table border="1">

				<?php  
				foreach($alumnos as &$a){
					foreach ($a as $key => $value) {
						$id = $a["id"];#id alumno
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
		
	</body>
	<script type="text/javascript">
		function cambio(strCambio, id){
			let change;
			if(strCambio != "notas"){
				change = prompt("Ingrese el cambio: ");
				let ajax = new XMLHttpRequest();
				ajax.onreadystatechange = function(){
					if(this.status === 200 && this.readyState === 4){
						let r = this.responseText;
					}
				}
				ajax.open("POST", `../controller/actualizacion.php?q=${strCambio}&id=${id}&c=${change}`, true); /// id alumno
				ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				ajax.send("q="+strCambio+"&id="+id+"&c="+change);
				location.reload(true);
			}
			else{
				change = prompt("Ingrese las notas actuales y modificadas separadas en espacios: ");
				change = change.split(" ");
				json = JSON.stringify(change);
				let ajax = new XMLHttpRequest();
				ajax.onreadystatechange = function(){
					if(this.status === 200 && this.readyState === 4){
						let r = this.responseText;
					}
				}
				ajax.open("POST", `../controller/actualizacion.php`, true); /// id alumno
				ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				ajax.send(`q=${strCambio}&id=${id}&c=${json}`);
				location.reload(true);
			}
			location.reload(true);
		}

		function agregarNota(id){
			let change = prompt("Nueva nota: ");
			let ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function(){
				if(this.status === 200 && this.readyState === 4){
					let r = this.responseText;
				}
			}
			ajax.open("POST", `../controller/actualizacion.php`, true); ///id alumno
			ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajax.send(`q=nnotas&id=${id}&c=${change}`);
			location.reload(true);
		}		

		
	</script>
</html>