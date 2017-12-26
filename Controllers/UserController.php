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

		function send_email($email_recive,$name,$contents,$subject ){
	        //https://www.google.com/settings/security/lesssecureapps
	        // Khai báo thư viên phpmailer
	        require "phpmailer/PHPMailerAutoload.php";
	        require "phpmailer/class.phpmailer.php";
	        // Khai báo tạo PHPMailer
	        $mail = new PHPMailer();
	        //Khai báo gửi mail bằng SMTP
	        $mail->IsSMTP();
	        //Tắt mở kiểm tra lỗi trả về, chấp nhận các giá trị 0 1 2
	        // 0 = off không thông báo bất kì gì, tốt nhất nên dùng khi đã hoàn thành.
	        // 1 = Thông báo lỗi ở client
	        // 2 = Thông báo lỗi cả client và lỗi ở server
	        // To load the French version
	        $mail->setLanguage('vi', '/optional/path/to/language/directory/');
	        $mail->SMTPDebug  = 0;
	        $mail->CharSet="UTF-8";
	        $mail->Debugoutput = "html"; // Lỗi trả về hiển thị với cấu trúc HTML
	        $mail->Host       = "smtp.gmail.com"; //host smtp để gửi mail
	        $mail->Port       = 587; // cổng để gửi mail
	        $mail->SMTPSecure = "tls"; //Phương thức mã hóa thư - ssl hoặc tls
	        $mail->SMTPAuth   = true; //Xác thực SMTP
	        $mail->Username   = "thanhbinhtestmail@gmail.com"; // Tên đăng nhập tài khoản Gmail
	        $mail->Password   = "15021997"; //Mật khẩu của gmail
	        $mail->SetFrom("thanhbinhtestmail@gmail.com", "Lê Thanh Bình"); // Thông tin người gửi
	        $mail->AddReplyTo("thanhbinhtestmail@gmail.com","Thanh Bình");// Ấn định email sẽ nhận khi người dùng reply lại.
	        $mail->AddAddress($email_recive, $name);//Email của người nhận
	        $mail->Subject = $subject; //Tiêu đề của thư
	        $mail->MsgHTML($contents); //Nội dung của bức thư.
	        // $mail->MsgHTML(file_get_contents("email-template.html"), dirname(__FILE__));
	        // Gửi thư với tập tin html
	        $mail->AltBody = "Nội dung thư";//Nội dung rút gọn hiển thị bên ngoài thư mục thư.
	        //$mail->AddAttachment("images/attact-tui.gif");//Tập tin cần attach
	         
	        //Tiến hành gửi email và kiểm tra lỗi
	        if(!$mail->Send()) {
	         // echo "Có lỗi khi gửi mail: " . $mail->ErrorInfo;
	            return false;
	        } else {
	            return true;
	          //echo "Đã gửi thư thành công!";
	        }
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

		public function register()
		{
			 //lấy dữ liệu được post lên
		    $site_key_post    = $_POST['g-recaptcha-response'];
		      
		    //lấy IP của khach
		    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		        $remoteip = $_SERVER['HTTP_CLIENT_IP'];
		    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		        $remoteip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		    } else {
		        $remoteip = $_SERVER['REMOTE_ADDR'];
		    }
	        $api_url=$_SESSION['recaptcha']['api_url'];
    		$site_key=$_SESSION['recaptcha']['site_key'];
   			$secret_key=$_SESSION['recaptcha']['secret_key'];
		    //tạo link kết nối
		    $api_url = $api_url.'?secret='.$secret_key.'&response='.$site_key_post.'&remoteip='.$remoteip;
		    //lấy kết quả trả về từ google
		    $response = file_get_contents($api_url);
		    //dữ liệu trả về dạng json
		    $response = json_decode($response);
		    if(!isset($response->success))
		    {
		        setcookie('error',"Please check captcha again!",time()+10);
		        header('Location: ?mod=users&act=login');
		    }
		    if($response->success == true)
		    {
		    	$name = $_POST['name'];
		        $email = $_POST['email'];
				$password = $_POST['password'];
				$rpassword = $_POST['confirm-password'];
				if($password!=$rpassword)
				{
					setcookie('error',"Please check confirm password!",time()+10);
		        	header('Location: ?mod=users&act=login');
				}
				else
				{
					$this->model->register($name,$email,$password);
					$msg="sign up a successfully!<br>"
			            ."<br>Name: ".$name
			            ."<br>Email: ".$email
			            ."<br>password: ".$password
			            ."<br>Please click this link to accept: http://thanhbinh.com";
			        $subject="Eva Blog require email";
			        $this->send_email($email,$name,$msg,$subject);
					setcookie('successfully','Please check your email to accept!',time()+10);
					header('Location: ?');
				}
		    }
		    else
		    {
		        setcookie('error',"Please check captcha again!",time()+10);
		        header('Location: ?mod=users&act=login');
		    }
		}

		public function logout()
		{
			unset($_SESSION['login']);
			header('Location: ?');
		}
		public function index()
		{
			$data=$this->model->All("");
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
			$user=$this->model->find($id);
			$user['rank'] = ($user['privilege']==1)?"System admin":"Member";
			require_once 'Views/user/detail.php';
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