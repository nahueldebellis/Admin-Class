<?php include "../controller/grupos.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<h1>AClass</h1>
		<nav>
			<ul>
				<li><a href="index.php">Inicio</a></li>
			</ul>
		</nav>
	</header>
	
	<?php  
		foreach($grupos as $key => $grupo){
			$key++;
			foreach ($grupo as $k => $value) {
				echo "Grupo $key: ".$value."<br>";
			}	
		}
	?>

	<button>Guradar grupos</button>
</body>
</html>