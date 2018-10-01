<?php  
	include "../model/alumnos.php";
	$a = new Alumnos();
	$cursos = $a->cantCursos();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Main</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<h1>AClass</h1>
		<nav>
			<ul>
				<?php for($i = 0; $i < sizeof($cursos); $i++){
					$x = $cursos[$i] ?>
					<li><a href="busqueda.php?q=<?php  echo $x["nombre"]; ?>"> <?php echo $x["nombre"]; ?> </a></li>
				<?php } ?>
			</ul>
			<br>
			<ul>
				<li><a onclick="h()" href="#h">Registro de Curso</a></li>
			</ul>
		</nav>
	</header>
	<div id="visible" style="display:none;">
		<form method="GET" action="registro.php">
			<label>Ingrese el nombre del curso: </label>
			<input type="text" name="curso" placeholder="Curso" autocomplete="off"><br>
			<label>Ingrese la cantidad de alumnos: </label>
			<input type="text" name="CantAlumnos" id="CantAlumnos" placeholder="Cantidad de alumnos" autocomplete="off"><br>
			<button class="center">Registrar</button>
		</form>
	</div>

	<script type="text/javascript">
			function h(){
				let v = document.getElementById("visible");
				v.style.display = "block";
			}

			/*function grupos(){
				let arr = [];
				let grupo = [];
				let max = document.getElementById("CantAlumnos").value;
				for(let i = 1; i <= max; i++){
					arr.push(i);
				}
				for(let i = 0; i < 5; i++){
					grupo = [];
					while(grupo.length <= 4){
						let random = Math.floor(Math.random() * (max-1) + 1);
						if(arr[random] != 0){
							grupo.push(arr[random]);
							arr[random] = 0;
						}
					}
				}
			}*/
		
	</script>
</body>
</html>