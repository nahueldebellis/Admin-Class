<?php
	# Filtra por nombre.
	# Falta crear por clases la busqueda a la base de datos

	class Alumnos{
		public $server = "localhost";
		public $user = "root";
		public $pass = "";
		public $db = "Grupos";


		public $conn;

		public function __construct(){
			 $this->conn = new mysqli($this->server, $this->user, $this->pass, $this->db);
		}

		public function insert($b, $group, $alumno){
			$sql = "insert into groups values ('$b', '$alumno', '$group')";
			if(!$this->conn->query($sql)){
				echo "<br>".$conn->error."<br>";
			}
		}

		public function byName($name){
			$res = array();
			$i = 0;
			$sql = "select * from groups where nombre='$name'";
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
			$sql = "select * from groups where grupo='$group'";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){
				$res[$i] = $row;
				$i++;
			}
			$this->closeConn();
			return $res;
		}

		private function closeConn(){
			$this->conn->close();
		}

	}

?>