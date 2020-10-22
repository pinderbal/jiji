<?php
	class Users extends Controller{

		public function __construct(){
			//load model
			$this->userModel = $this->model('User');
		}

		// register user
		public function register(){
			// check if user submits
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//sanitize 
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				//store data
				$data = [
					'name' => $_POST['name'],
					'email' => $_POST['email'],
					'password' => $_POST['password'],
					'confirm_password' => $_POST['confirm_password'],
					'name_error' => '',
					'email_error' => '',
					'password_error' => '',
					'confirm_password_error' => ''
				];

				//validation
				if (empty($data['name'])){
					$data['name_error'] = 'Please enter your name.';
				}

				if (empty($data['email'])){
					$data['email_error'] = 'Please enter your email.';
				}else{
					if($this->userModel->getUserByEmail($data['email'])){
						$data['email_error'] = 'Email is already taken';
					}
				}

				if (empty($data['password'])){
					$data['password_error'] = 'Please enter your password.';
				}elseif(strlen($data['password']) < 6) {
					$data['password_error'] = 'Password must be greater than 6 characters';
				}

				if (empty($data['confirm_password'])){
					$data['confirm_password_error'] = 'Please confirm your password.';
				}elseif($data['password'] !=  $data['confirm_password']){
					$data['confirm_password_error'] = 'Passwords do not match';
				}

				//if no errors register
				if (empty($data['name_error']) && empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])){
					$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
					if($this->userModel->register($data)){
						redirect('users/login');
					}else{
						die('Something went wrong');
					}
				}else{
					//if there are erros load view with errors
					$this->view('users/register', $data);
				}
			}else{
				// Init data
				$data = [
					'name' => '',
					'email' => '',
					'password' => '',
					'confirm_password' => '',
					'name_error' => '',
					'email_error' => '',
					'password_error' => '',
					'confirm_password_error' => ''
				];

				//Load view
				$this->view('users/register', $data);
			}
		}

		// user login
		public function login(){
			// check if user submits
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// sanititze
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'email' => $_POST['email'],
					'password' => $_POST['password'],
					'email_error' => '',
					'password_error' => '',
				];


				//validation
				if(empty($data['email'])){
					$data['email_error'] = "Please enter your email.";
				}

				// Check for user/email
				if($this->userModel->getUserByEmail($data['email'])){
					//user found
				}else{
					$data['password_error'] = "Email or password is incorrect.";
				}

				if(empty($data['password'])){
					$data['password_error'] = "Please enter your password";
				}

				if(empty($data['email_error']) && empty($data['password_error'])){
					//if login succesful
					$loggedInUser = $this->userModel->login($data['email'], $data['password']);
					if($loggedInUser){
						$this->createUserSession($loggedInUser);
					}else{
						$data['password_error'] = 'Email or password is incorrect';

						$this->view('users/login', $data);
					}
				}else{
					$this->view('users/login', $data);
				}

			}else{
			$data = [
					'email' => '',
					'password' => '',
					'email_error' => '',
					'password_error' => '',
				];

				//Load view
				$this->view('users/login', $data);
			}
		}

		// create session
		public function createUserSession($user){
			$_SESSION['user_id'] = $user->id_users;
			$_SESSION['user_name'] = $user->name;
			$_SESSION['user_email'] = $user->email;
			redirect('pages');
		}

		// logout user
		public function logout(){
			unset($_SESSION['user_id']);
			unset($_SESSION['user_name']);
			unset($_SESSION['user_email']);
			session_destroy();
			redirect('users/login');
		}
	}