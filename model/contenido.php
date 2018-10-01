<?php 
	class Contenido{
		private $server = "localhost";
		private $user = "root";
		private $pass = "";
		private $db = "administracion";
		private $conn;
		function __construct(){
			$this->conn = new mysqli($this->server, $this->user, $this->pass, $this->db);
		}
		public function getContents($curso){
			$i = 0;
			$res = array();
			$sql = "SELECT o.nombre AS tema FROM contenido o INNER JOIN curso c ON o.id_curso=c.id WHERE c.nombre='$curso'";
			$result = $this->conn->query($sql);
			while($row = $result->fetch_assoc()){
				$res[$i] = $row;
				$i++;
			}
			return $res;
		}

		public function insertContents($curso, $nombre){
			$sql = "SELECT id FROM curso WHERE nombre='$curso'";
			$result = $this->conn->query($sql);
			$row = $result->fetch_assoc();
			$id = $row["id"];

			$sql = "INSERT INTO contenido (nombre, id_curso) values('$nombre', $id)";
			$this->conn->query($sql);
		}
	}


?>