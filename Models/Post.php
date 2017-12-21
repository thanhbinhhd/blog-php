 <?php 
	include_once 'Models/Model.php';
	class Post extends Model
	{
		public $connPost;
		public $table="posts";
		public $primaryKey="id";
		public function __construct()
		{
			parent::__construct();
		}

		public function index($start,$num)
		{
			$query = "SELECT posts.*,users.name FROM posts INNER JOIN users ON posts.user_id=users.id  WHERE status = 1 limit $start,$num";
			$result = $this->dbconn->query($query);
			while ($row = $result->fetch_assoc()) {
				$data[]=$row;
			}
			return $data;
		}
	}
 ?>