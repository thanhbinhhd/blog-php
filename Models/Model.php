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

		
		public function find($primaryKey)
		{
			$query = "SELECT * FROM ".$this->table." WHERE ".$this->primaryKey." ='$primaryKey'";
			return $this->dbconn->query($query)->fetch_assoc();
		}

		public function insert($data){

			$fields = "";
			$values = "";

			foreach ($data as $key => $value) {
				$fields .= ",$key";
				$values .= ",'".$value."'";
			}

			$fields = trim($fields,",");
			$values = trim($values,",");
			$sql = "INSERT INTO ".$this->table."(".$fields.") VALUES (".$values.")";
			$status = $this->dbconn->query($sql);
			$last_id = $this->dbconn->insert_id;

			$data = $this->find($last_id);
			return $data;
		}

		public function delete($primaryKey)
		{
			$query = "DELETE FROM ".$this->table." WHERE ".$this->primaryKey." = '$primaryKey'";
			return $this->dbconn->query($query);
		}

		public function update($data){
			$sql = "";

			foreach ($data as $key => $value) {
				$sql .= ",$key = '".$value."'";
			}

			$sql = trim($sql,',');

			$query = "UPDATE ".$this->table." SET ".$sql." WHERE ".$this->primaryKey."=".$data['id'];

			$status = $this->dbconn->query($query);

			$data = $this->find($data['id']);

			return $data;
		}
	}
 ?>