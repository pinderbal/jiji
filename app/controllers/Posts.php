<?php
	class Posts extends Controller{

		//load model
		public function __construct(){
			//load model
			$this->postModel = $this->model('Post');
		}

		public function index(){
		}

		public function search(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//Sanitize post
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$search = $_POST['title'];
				$posts = $this->postModel->getResults($search);
				$data = [
					'posts' => $posts
				];

				
				$this->view('posts/results', $data);
			}
		}

		public function show($id){
				$post = $this->postModel->getPostById($id);
				//$user = $this->userModel->getUserById($post->user_id);

				$data = [
					'post' => $post,
					//'user' => $user
				];

				$this->view('posts/show', $data);
		}
	}