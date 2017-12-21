<?php 
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
					include_once 'Views/index/single.php';
					break;
				default:
					# code...
					break;
				}
			break;
		case 'users':
			switch ($act) {
				case 'login':
					require_once 'Views/user/login.php';
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