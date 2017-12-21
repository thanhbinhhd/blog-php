<?php 
	include_once 'Models/Connection.php';
	class Model{
		public $table="";
		public $primaryKey="";
		public $dbconn=null;
		public function __construct()
		{
			$connection = new Connection();
			$this->dbconn = $connection->conn;
		}

		public function All()
			{
				$data = array();
				$query = "SELECT * FROM ".$this->table;
				$result = $this->dbconn->query($query);
				while ($row = $result->fetch_assoc()) {
					$data[]=$row;
				}
				return $data;
			}
	}
 ?>