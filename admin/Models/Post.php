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
		}
	 ?>