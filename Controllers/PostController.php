<?php 
	include_once 'Models/Post.php';
	class PostController{
		private $model;
		public function __construct()
		{
			$this->model = new Post();
		}

		public function index()
		{
			$num=6;
			if(isset($_GET['page']))
				$page=$_GET['page'];
			else $page=1;
			$count = $this->model->count();
			$num_page=ceil($count/$num);
			$start = $num*($page-1);
			$data = $this->model->index($start,$num);
			$new_post = $this->model->new_posts();
			$num_element = count($data);
			$all=$this->model->All();
			require_once 'Views/index/index.php';
		}

		public function about()
		{
			$admin=$this->model->admin();
			require_once 'Views/index/about.php';
		}

		public function read()
		{
			$slug=$_GET['slug'];
			$post=$this->model->find($slug);
			$author = $this->model->get_author($post['user_id']);
			$tags = $this->model->get_tags($post['id']);
			require_once 'Views/index/single.php';
		}

		public function list_of_author()
		{
			
		}
	}
 ?>