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
					<li><a href="estadistica.php?q=<?php echo $_GET["q"] ?>">Estadistica</a></li>
				</ul>
			</nav>
		</header>
		
				
			<div class="busqueda">
				<form method="POST">
					<input type="hidden" value="<?php echo $_GET["q"] ?>" name="curso">
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
				</form>
			</div>

			<div class="contenido">
				<h1 align="center">Contenidos</h1>
				<?php 
					include "../controller/contenido.php";
					foreach ($res as &$value) {
						foreach ($value as $key => $value) {
							echo "$key ----> $value ";
						}
						echo "<br>";
					}
				?>
				<form method="POST" action="../controller/contenido.php">
					<input type="hidden" value="<?php echo $_GET["q"] ?>" name="curso">
					<input type="text" name="nombre" autocomplete="off" placeholder="Nombre del Tema">
					<button>Agregar</button>
				</form>
			</div>
		
			<div style="float:right;">
				<form method="POST" action="grupos.php">
					<input type="hidden" value="<?php echo $_GET["q"] ?>" name="curso">
					<div>Armar grupos (Elija uno)</div><br>
					<label>Por promedios: </label>
					<input type="checkbox" name="byProm"><br>
					<label>Random: </label>
					<input type="checkbox" name="random"><br>
					<input type="text" name="cGrupos" placeholder="Cantidad de grupos">
					<input type="text" name="cAlumnos" placeholder="Cantidad de alumnos"><br>

					<button>Armar grupos</button>
				</form>
				<form method="POST" action="../controller/grupos.php">
					<input type="hidden" value="<?php echo $_GET["q"] ?>" name="curso">
					<label>Nuevo grupo</label>
					<input type="text" name="Ngrupo" placeholder="Nombre del grupo">
					<button>Agregar Grupo</button>
				</form>
			</div>
			<br>
			<table style="float:left;" border="1">
				<?php  
				foreach($alumnos as &$a){
					foreach ($a as $key => $value) {
						$id = $a["id"];#id alumno
						if(!($key == "id"))
							echo "<th>$key</th>";
					}
					echo "<th></th><th></th><tr>";
					foreach ($a as $key => $value) {
						if(!($key == "id")){
					?>
							<td><a onclick="cambio('<?php echo "$key"; ?>', <?php echo "$id"; ?>)"><?php echo "$value"; ?></a></td>
						<?php
						}
					}
					echo "<td><a onclick='agregarNota($id)'>Agregar nota</a></td>";
					echo "<td><a onclick='cambiarGrupo($id)'>Cambiar nombre grupo</a></td>";
					echo "</tr>";
					
				}
					?>
			</table>		
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

		function cambiarGrupo(id){
			let change = prompt("Ingrese el nuevo nombre del grupo: ");
			let ajax = new XMLHttpRequest();
			ajax.onreadystatechange = function(){
				if(this.Status === 200 && this.readyState === 4){
					let r = this.responseText;
				}
			}
			ajax.open("POST", `../controller/actualizacion.php`, true); ///id alumno
			ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			ajax.send(`q=grupos&id=${id}&c=${change}`);
			location.reload(true);
		}

		
	</script>
</html>