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

		public function count()
		{
			$query = "SELECT count(*) as count FROM posts WHERE status=1";
			return $this->dbconn->query($query)->fetch_assoc()['count'];
		}
		public function index($start,$num)
		{
			$data = array();
			$query = "SELECT posts.*,users.name FROM posts INNER JOIN users ON posts.user_id=users.id  WHERE status = 1 limit $start,$num";
			$result = $this->dbconn->query($query);
			while ($row = $result->fetch_assoc()) {
				$data[]=$row;
			}
			return $data;
		}

		public function new_posts()
		{
			$data = array();
			$query = "SELECT * FROM posts WHERE status = 1 ORDER BY (created_at) DESC limit 3";
			$result = $this->dbconn->query($query);
			while ($row = $result->fetch_assoc()) {
				$data[]=$row;
			}
			return $data;
		}

		public function admin()
		{
			$data = array();
			$query = "SELECT * FROM users WHERE privilege=1";
			$result = $this->dbconn->query($query);
			while ($row = $result->fetch_assoc()) {
				$data[]=$row;
			}
			return $data;
		}
	}
 ?>