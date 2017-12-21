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
			$count = count($this->model->All());
			$num_page=ceil($count/$num);
			$start = $num*($page-1);
			$data = $this->model->index($start,$num);
			$num_element = count($data);
			// echo "<pre>";
			// 	print_r($data);
			// echo "</pre>";
			require_once 'Views/index/index.php';
		}
	}
 ?>