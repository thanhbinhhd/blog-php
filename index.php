<?php 
	session_start();
	if(isset($_GET['mod']))
	{
		$mod=$_GET['mod'];
		if(isset($_GET['act']))
			$act=$_GET['act'];
		else $act = 'index';
	}
	else
	{
		$mod='index';
		$act='index';
	}

	switch ($mod) {
		case 'index':
			include_once 'Controllers/PostController.php';
			$controller = new PostController();
			switch ($act) {
				case 'index':
					$controller->index();
					break;
				case 'about':
					$controller->about();
					break;
				case 'contact':
					include_once 'Views/index/contact.php';
					break;
				case 'read':
					$controller->read();
					break;
				case 'list_of_author':
					$controller->list_of_author();
					break;
				case 'list_of_tag':
					$controller->list_of_tag();
					break;
				default:
					# code...
					break;
				}
			break;
		case 'users':
			require_once 'Controllers/UserController.php';
			$controller = new UserController();
			switch ($act) {
				case 'login':
					$controller->login();
					break;
				case 'access':
					$controller->access();
					break;
				case 'logout':
					$controller->logout();
					break;
				case 'register':
					$controller->register();
					break;
				case 'detail':
					$controller->detail();
					break;
				case 'edit':
					$controller->edit();
					break;
				case 'update':
					$controller->update();
					break;
				case 'store':
					$controller->store();
					break;
				case 'delete':
					$controller->delete();
					break;
				default:
					# code...
					break;
			}
			break;
		case 'posts':
			require_once 'Controllers/PostController.php';
			$controller=new PostController();
			switch ($act) {
				case 'index':
					$controller->list();
					break;
				case 'edit':
					$controller->edit();
					break;
				case 'store':
					$controller->store();
					break;
				case 'delete':
					$controller->delete();
					break;
				case 'update':
					$controller->update();
					break;
				default:
					# code...
					break;
			}
			break;
		default:
			# code...
			break;
	}
 ?>