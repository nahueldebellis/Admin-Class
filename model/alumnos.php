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
			$sql = "INSERT INTO alumnos (presencia, nombre, apellido, id_curso, id_grupo) VALUES ($b, '$nombre', '$apellido', $curso, 1)";
			if(!$this->conn->query($sql)){
				echo "<br>".$this->conn->error."<br>";
			}
			$sql = "SELECT id FROM alumnos WHERE nombre='$nombre' AND apellido='$apellido' AND id_curso=$curso";
			$result = $this->conn->query($sql);
			$row = $result->fetch_assoc();
			$res = $row["id"];
			$sql = "INSERT INTO notas (nota, id_alumno) VALUES (0, $res)";
			if(!$this->conn->query($sql)){
				echo "<br>".$this->conn->error."<br>";
			}
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
			
			return $res;
		}

		public function getAll($curso){
			$res = array();
			$i = 0;
			$sql = "SELECT GROUP_CONCAT(n.nota ORDER BY n.nota) as notas, a.id, a.presencia, a.nombre, a.apellido, g.nombre as grupo FROM notas n 
					INNER JOIN alumnos a ON a.id=n.id_alumno 
					INNER JOIN grupos g ON a.id_grupo=g.id
					INNER JOIN curso c ON a.id_curso=c.id
					WHERE c.nombre='$curso'
					GROUP BY a.id, a.presencia, a.nombre, a.apellido, g.nombre";

			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){
				$res[$i] = $row;
				$i++;
			}
			$this->closeConn();
			return $res;
		}


		public function byApellido($name, $curso){
			$res = array();
			$i = 0;
			$sql = "SELECT GROUP_CONCAT(n.nota ORDER BY n.nota) as notas, a.id, a.presencia, a.nombre, a.apellido, g.nombre as grupo FROM notas n 
					INNER JOIN alumnos a ON a.id=n.id_alumno
					INNER JOIN curso c ON a.id_curso=c.id
					INNER JOIN grupos g ON a.id_grupo=g.id
					WHERE a.apellido='$name' AND c.nombre='$curso'
					GROUP BY a.id, a.presencia, a.nombre, a.apellido, g.nombre";
					#"SELECT a.id, a.nombre, a.apellido FROM alumnos a WHERE nombre='$name'";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){ # $result->fetch_assoc() retorna array
				$res[$i] = $row;
				$i++;
			}
			#$this->closeConn();
			return $res;
		}

		public function byName($name, $curso){
			$res = array();
			$i = 0;
			$sql = "SELECT GROUP_CONCAT(n.nota ORDER BY n.nota) as notas, a.id, a.presencia, a.nombre, a.apellido, g.nombre as grupo FROM notas n 
					INNER JOIN alumnos a ON a.id=n.id_alumno
					INNER JOIN curso c ON a.id_curso=c.id
					INNER JOIN grupos g ON a.id_grupo=g.id
					WHERE a.nombre='$name' AND c.nombre='$curso'
					GROUP BY a.id, a.presencia, a.nombre, a.apellido, g.nombre";
					#"SELECT a.id, a.nombre, a.apellido FROM alumnos a WHERE nombre='$name'";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){ # $result->fetch_assoc() retorna array
				$res[$i] = $row;
				$i++;
			}
			#$this->closeConn();
			return $res;
		}

		public function byGroup($group, $curso){
			$res = array();
			$i = 0;
			$sql = "SELECT GROUP_CONCAT(n.nota ORDER BY n.nota) as notas, a.id, a.presencia, a.nombre, a.apellido, g.nombre AS grupo FROM alumnos a 
					INNER JOIN grupos g ON a.id_grupo=g.id
					LEFT JOIN notas n ON a.id=n.id_alumno
					INNER JOIN curso c ON a.id_curso=c.id
					WHERE g.nombre='$group' AND c.nombre='$curso'
					GROUP BY a.id, a.presencia, a.nombre, a.apellido, g.nombre";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){
				$res[$i] = $row;
				$i++;
			}
			$this->closeConn();
			return $res;
		}

		public function byProm($val, $curso){
			$res = array();
			$i = 0;
			$sql = "SELECT a.id, a.presencia, a.nombre, a.apellido, AVG(n.nota) AS Promedio FROM notas n
					INNER JOIN alumnos a ON a.id=n.id_alumno
					INNER JOIN curso c ON a.id_curso=c.id
					WHERE c.nombre='$curso'
					GROUP BY a.id, a.presencia, a.nombre, a.apellido HAVING Promedio >= $val";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){
				$res[$i] = $row;
				$i++;
			}
			$this->closeConn();
			return $res;
		}

		public function aGrupo($id, $value){
			$sql = "UPDATE grupos g
					INNER JOIN alumnos a ON g.id=a.id_grupo
					SET g.nombre='$value'
					WHERE a.id=$id";
			if(!$this->conn->query($sql)){
				echo $this->conn->error;
			}
			$this->closeConn();
		}

		public function actualizar($key, $id, $valor){
			$sql = "UPDATE alumnos a
					SET $key='$valor'
					WHERE a.id=$id";
			if(!$this->conn->query($sql)){
				echo $this->conn->error;
			}
			$this->closeConn();
		}

		public function aNotas($id, $cambio){
			$i = 0;
			$sql = "SELECT n.id FROM notas n INNER JOIN alumnos a ON n.id_alumno=a.id WHERE a.id=$id";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){
				$res[$i] = $row;
				$i++;
			}

			$i=0;
			foreach($res as &$r){
				$notaId = $r["id"];
				$n = (int)$cambio[$i];
				$i++;
				$sql = "UPDATE notas n 
						SET nota=$n
						WHERE n.id=$notaId";
					
				if(!$this->conn->query($sql)){
					echo $this->conn->error;
				}
			}

			$this->closeConn();
		}

		public function cantCursos(){
			$i = 0;
			$sql = "SELECT c.nombre FROM curso c";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){
				$res[$i] = $row;
				$i++;
			}
			return $res;
		}

		public function agregarNota($id, $nota){
			$sql = "INSERT INTO notas (nota, id_alumno) VALUES ($nota, $id)";
			if(!$this->conn->query($sql)){
				echo "<br>".$this->conn->error."<br>";
			}
		}

		public function closeConn(){
			$this->conn->close();
		}

	}

?>