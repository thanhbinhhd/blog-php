<?php 
	include_once 'Models/User.php';
	class UserController{
		private $model;
		public function __construct()
		{
			$this->model = new User();
		}

		public function login()
		{
			require_once 'Views/User/login.php';
		}

		public function access()
		{
			$email = $_POST['email'];
			$password = $_POST['password'];
			if(!$user=$this->model->find_log($email))
				{
					setcookie('error','Your Login Name or Password is invalid!',time()+10);
					header('Location: ?mod=users&act=login');
				}
				else if($user['password']!=$password)
				{
					setcookie('error','Your Login Name or Password is invalid!',time()+10);
					header('Location: ?mod=users&act=login');
				}
				else{
					session_start();
					$_SESSION['login']=$user;
					header('Location: ?');
				}
		}

		public function logout()
		{
			unset($_SESSION['login']);
			header('Location: ?');
		}
		public function index()
		{
			$data=$this->model->All();
			require_once 'Views/user/index.php';
		}
		public function store(){
	      $data = $_POST;
	      $data = $this->model->insert($data);
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

	    public function delete(){
		      $id = $_GET['id'];
		      $status = $this->model->delete($id);
		      echo json_encode([
		        'data' => null,
		        'status' => $status,
		      ]);
		 }

		public function edit()
		 {
		 	$id = $_GET['id'];
		    $data = $this->model->find($id);

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