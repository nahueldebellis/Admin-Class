<?php include "../controller/estadistica.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<title>Estadistica</title>
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
	<script>
	 	google.charts.load("current", {packages:["corechart"]});
    	google.charts.setOnLoadCallback(drawChart);
	    function drawChart() {
		    var data = google.visualization.arrayToDataTable([
			        ["Element", "Density", { role: "style" } ],
			        <?php foreach($alumnos as &$value){
			        	echo "['".$value["nombre"]."', ".$value["Promedio"].", '#b87333'],";
			        }?>
		      	]);

		    var view = new google.visualization.DataView(data);

		    view.setColumns([0, 1,{ calc: "stringify",
		                         sourceColumn: 1,
		                         type: "string",
		                         role: "annotation" },2]);

		      var options = {
		        title: "Notas de los alumnos",
		        width: 600,
		        height: 400,
		        bar: {groupWidth: "95%"},
		        legend: { position: "none" },
		      };
		      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
		      chart.draw(view, options);
	  	}
  </script>
<div id="barchart_values" style="width: 900px; height: 300px;"></div>
</body>
</html>