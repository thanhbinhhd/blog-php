<?php 
	session_start();
	if(!isset($_SESSION['login']))
	{
		$mod='users';
		if(isset($_GET['act']) && $_GET['act']=='access')
			$act='access';
		else $act='login';
	}
	else
	{
		if(isset($_GET['mod']))
		{
			$mod=$_GET['mod'];
			if(isset($_GET['act']))
				$act=$_GET['act'];
			else $act='index';
		}
		else
		{
			$mod='users';
			$act='index';
		}
	}
	switch ($mod) {
		case 'users':
			include_once 'Controllers/UserController.php';
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
				case 'index':
					$controller->index();
					break;
				case 'store':
					$controller->store();
					break;
				case 'delete':
					$controller->delete();
					break;
				case 'edit':
					$controller->edit();
					break;
				case 'update':
					$controller->update();
					break;
				case 'detail':
					$controller->detail();
					break;
				default:
					# code...
					break;
			}
			break;
		case 'posts':
			include_once 'Controllers/PostController.php';
			$controller = new PostController();
			switch ($act) {
				case 'index':
					$controller->index();
					break;
				case 'store':
					$controller->store();
					break;
				case 'delete':
					$controller->delete();
					break;
				case 'edit':
					$controller->edit();
					break;
				case 'update':
					$controller->update();
					break;
				case 'detail':
					$controller->detail();
					break;
				default:
					# code...
					break;
			}
			break;
		case 'tags':
			include_once 'Controllers/TagController.php';
			$controller = new TagController();
			switch ($act) {
				case 'index':
					$controller->index();
					break;
				case 'store':
					$controller->store();
					break;
				case 'edit':
					$controller->edit();
					break;
				case 'update':
					$controller->update();
					break;
				case 'delete':
					$controller->delete();
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