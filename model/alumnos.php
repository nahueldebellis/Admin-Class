<?php
	# Filtra por nombre.
	# Falta crear por clases la busqueda a la base de datos

	class alumnos{
		private $server = "localhost";
		private $user = "root";
		private $pass = "";
		private $db = "Grupos";

		private $conn = new mysqli($server, $user, $pass, $db);

		public function byName($name){
			$res = array();
			$i = 0;
			$sql = "select * from groups where nombre=$name";
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
			$sql = "select * from groups where grupo=$group";
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