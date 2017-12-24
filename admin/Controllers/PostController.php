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
			$data=$this->model->All();
			require_once 'Views/post/index.php';
		}

		public function store()
		{
			$data=$_POST;
			$data=$this->model->insert($data);
			if($data!=null)
			{
				echo json_encode([
					'data'=>$data,
					'status'=>true,
				]);
			}
			else
			{
				echo json_encode([
					'data'=>null,
					'status'=>false,
				]);
			}
		}

		public function delete()
		{
			$id=$_GET['id'];
			$status=$this->model->delete($id);
			echo json_encode([
		        'data' => null,
		        'status' => $status,
		      ]);
		}

		public function edit()
		{
			$id=$_GET['id'];
			$data=$this->model->find($id);
			if($data != null){
		        echo json_encode([
		          'data' => $data,
		          'status' => true,
		        ]);
		    }else{
		   	    echo json_encode([
		          'data' => null,
		          'status' => false,
		        ]);
		    }
		}

		public function update()
		{
			$data=$_POST;
			$data = $this->model->update($_POST);
			if($data != null){
		        echo json_encode([
		          'data' => $data,
		          'status' => true,
		        ]);
		      }else{
		        echo json_encode([
		          'data' => null,
		          'status' => false,
		        ]);
		      }
		}

		public function detail()
		{
			$id=$_GET['id'];
			$post=$this->model->find($id);
			require 'Views/post/detail.php';
		}
	}
 ?>