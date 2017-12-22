<?php 
	include_once 'Models/Model.php';
	class User extends Model
	{
		public $connUser;
		public $table="users";
		public $primaryKey="id";
		public function __construct()
		{
			parent::__construct();
		}

		public function find_log($email)
		{
			$query = "SELECT * FROM users WHERE email='$email'";
			return $this->dbconn->query($query)->fetch_assoc();
		}
	}
 ?>