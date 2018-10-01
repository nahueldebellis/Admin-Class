<?php
	include "../model/alumnos.php";
	$a = new Alumnos();
	if(isset($_POST["random"])){
		$curso = $_POST["curso"];
		$cGrupos = $_POST["cGrupos"];
		$alumnos = $_POST["cAlumnos"];
		$cAlumnos = $a->cantAlumnos($curso);
		$res = $a->getAlumnos($curso);
		$arr = array();
		$ids = array();
		for($j = 1; $j <= $cAlumnos; $j++){
			$r = $res[$j-1];
			$ids[$j] = $a->getIdAlumno($r["nombre"], $r["apellido"]);
			$arr[$j] = $r["nombre"]." ".$r["apellido"];
		}
		for($i = 0; $i < $cGrupos; $i++){
			$a->newGrupo($i);
			$grupo = array();
			while(sizeof($grupo) < $alumnos){
				$ran = rand(1, $cAlumnos);
				if($arr[$ran] != '0'){
					$id = $ids[$ran];
					$a->cambiarGrupo($id, $i);
					array_push($grupo, $arr[$ran]);
					$arr[$ran] = '0';
				}
			}
			$grupos[$i] = $grupo;
		}
		
	}
	elseif (isset($_POST["byProm"])) {
		$curso = $_POST["curso"];
		$cGrupos = $_POST["cGrupos"];
		$alumnos = $_POST["cAlumnos"];
		$cAlumnos = $a->cantAlumnos($curso);
		$res = $a->getAlumnosProm($curso);
		$arr = array();
		$ids = array();
		$grupos = [];
		for($j = 1; $j <= $cAlumnos; $j++){
			$r = $res[$j-1];
			$ids[$j] = $a->getIdAlumno($r["nombre"], $r["apellido"]);
			$arr[$j] = $r["nombre"]." ".$r["apellido"];
		}
		$h = 1;
		for($i = 0; $i < $cGrupos; $i++){
			$a->newGrupo($i);
			$grupo = array();
			for($j = $h; $j <= $cAlumnos; $j++){
				$id = $ids[$j];
				$a->cambiarGrupo($id, $i);
				array_push($grupo, $arr[$j]);
				if(sizeof($grupo) == $alumnos){
					$h = $j+1;
					$grupos[$i] = $grupo;
				}
			}
		}
	}
?>