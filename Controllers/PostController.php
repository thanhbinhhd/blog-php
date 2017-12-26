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
			$all=$this->model->All(" ");
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
			$post=$this->model->find_slug($slug);
			$author = $this->model->get_author($post['user_id']);
			$tags = $this->model->get_tags($post['id']);
			require_once 'Views/index/single.php';
		}

		public function list()
		{
			$condition=" WHERE user_id='".$_SESSION['login']['id']."'";
			$data=$this->model->All($condition);
			require_once 'Views/post/index.php';
		}

		public function list_of_author()
		{
			$id=$_GET['id'];
			$table='users';
			$condition = " WHERE user_id='$id' and users.id=user_id";
			$data = $this->model->list_of($table,$condition);
			include_once  'Views/index/list_of.php';
		}
		public function list_of_tag()
		{
			$id=$_GET['id'];
			$table='tags';
			$condition = " WHERE tags.id='$id' and posts.id=post_id";
			$data = $this->model->list_of($table,$condition);
			require_once 'Views/index/list_of.php';
		}


		public function store()
		{
			$_POST['slug']=str_replace(' ', '-', $_POST['title']);
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
	}
 ?>