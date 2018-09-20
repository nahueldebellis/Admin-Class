<?php
	# Filtra por nombre.
	# Falta crear por clases la busqueda a la base de datos

	class Alumnos{
		private $server = "localhost";
		private $user = "root";
		private $pass = "";
		private $db = "administracion";


		private $conn;

		public function __construct(){
			 $this->conn = new mysqli($this->server, $this->user, $this->pass, $this->db);
		}

		public function insertAlumno($b, $nombre, $apellido, $curso){

			$sql = "INSERT INTO alumnos (presencia, nombre, apellido, id_curso, id_grupo) VALUES (1, '$nombre', '$apellido', 1, 1)";
			if(!$this->conn->query($sql)){
				echo "<br>".$this->conn->error."<br>";
			}

			$this->closeConn();
		}

		public function insertCurso($nombre){
			$sql = "insert into curso (nombre) values ('$nombre')";
			if(!$this->conn->query($sql)){
				echo "<br>".$this->conn->error."<br>";
			}
			$sql = "SELECT id FROM curso WHERE nombre='$nombre'";

			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){
				$res = $row;
			}
			$this->closeConn();
			return $res;
		}

		public function getAll(){
			$res = array();
			$i = 0;
			$sql = "SELECT GROUP_CONCAT(n.nota ORDER BY n.nota) as notas, a.id, a.presencia, a.nombre, a.apellido, g.nombre as grupo FROM notas n 
					INNER JOIN alumnos a ON a.id=n.id_alumno 
					INNER JOIN grupos g ON a.id_grupo=g.id
					GROUP BY a.id, a.presencia, a.nombre, a.apellido, g.nombre";

			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){
				$res[$i] = $row;
				$i++;
			}
			$this->closeConn();
			return $res;
		}

		public function byName($name){
			$res = array();
			$i = 0;
			$sql = "SELECT a.id, a.nombre, a.apellido FROM alumnos a WHERE nombre='$name'";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){ # $result->fetch_assoc() retorna array
				$res[$i] = $row;
				$i++;
			}
			$this->closeConn();
			return $res;
		}

		public function byGroup($group){
			$res = array();
			$i = 0;
			$sql = "SELECT a.id, a.presencia, a.nombre, a.apellido, g.nombre AS grupo FROM alumnos a 
					INNER JOIN grupos g ON a.id_grupo=g.id
					WHERE g.nombre='$group'
					GROUP BY a.id, a.presencia, a.nombre, a.apellido, g.nombre";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){
				$res[$i] = $row;
				$i++;
			}
			$this->closeConn();
			return $res;
		}

		public function byProm($val){
			$res = array();
			$i = 0;
			$sql = "SELECT a.id, a.presencia, a.nombre, a.apellido, AVG(n.nota) AS Promedio FROM notas n
					INNER JOIN alumnos a ON a.id=n.id_alumno
					GROUP BY a.id, a.presencia, a.nombre, a.apellido HAVING Promedio >= $val";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){
				$res[$i] = $row;
				$i++;
			}
			$this->closeConn();
			return $res;
		}

		public function modNotas($key, $value){
			$res = array();
			$sql = "";
		}

		private function closeConn(){
			$this->conn->close();
		}

	}

?>