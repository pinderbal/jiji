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

		public function listings(){
			if(!isset($_SESSION['user_id'])){
				redirect('index');
			}

			$post = $this->postModel->getAllPostsFromUser();
			$data=[
				'post' => $post
			];

			$this->view('posts/listings', $data);
		}

		public function add(){
			if(!isset($_SESSION['user_id'])){
				redirect('index');
			}

			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'title' => $_POST['title'],
					'author' => $_POST['author'],
					'description' => $_POST['description'],
					'condition' => $_POST['condition'],
					'price' => $_POST['price'],
					'title_error' => '',
					'author_error' => '',
					'description_error' => '',
					'condition_error' => '',
					'price_error' => ''
				];

				if (empty($data['title'])){
					$data['title_error'] = 'Please enter a title.';
				}elseif(strlen($data['title']) < 6) {
					$data['title_error'] = 'Title must be greater than 6 characters';
				}

				if (empty($data['author'])){
					$data['author_error'] = 'Please enter an author.';
				}elseif(strlen($data['author']) < 4) {
					$data['author_error'] = 'Password must be greater than 4 characters';
				}

				if (empty($data['description'])){
					$data['description_error'] = 'Please enter a description.';
				}elseif(strlen($data['description']) < 6) {
					$data['description_error'] = 'Password must be greater than 6 characters';
				}

				if (empty($data['condition'])){
					$data['condition_error'] = 'Please select book condition.';
				}

				if (empty($data['price'])){
					$data['price_error'] = 'Please enter a price';
				}

				if (empty($data['title_error']) && empty($data['author_error']) & empty($data['description_error']) && empty($data['condition_error']) && empty($data['price_error'])){
					if($this->postModel->addPost($data)){
						redirect('/posts/listings');
					}else{
						die('Something went wrong');
					}

				}else{
					$this->view('posts/add', $data);
				}
			}else{
				$data = [
					'title' => '',
					'author' => '',
					'description' => '',
					'condition' => '',
					'price' => '',
					'title_error' => '',
					'author_error' => '',
					'description_error' => '',
					'price_error' => ''
				]; 
				$this->view('posts/add', $data);
			}
		}

		public function edit($id){
			if(!isset($_SESSION['user_id'])){
				redirect(URLROOT);
			}
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'id_books' => $id,
					'title' => $_POST['title'],
					'author' => $_POST['author'],
					'description' => $_POST['description'],
					'condition' => $_POST['condition'],
					'price' => $_POST['price'],
					'title_error' => '',
					'author_error' => '',
					'description_error' => '',
					'condition_error' => '',
					'price_error' => ''
				];

				if (empty($data['title'])){
					$data['title_error'] = 'Please enter a title.';
				}elseif(strlen($data['title']) < 6) {
					$data['title_error'] = 'Title must be greater than 6 characters';
				}

				if (empty($data['author'])){
					$data['author_error'] = 'Please enter an author.';
				}elseif(strlen($data['author']) < 4) {
					$data['author_error'] = 'Password must be greater than 4 characters';
				}

				if (empty($data['description'])){
					$data['description_error'] = 'Please enter a description.';
				}elseif(strlen($data['description']) < 6) {
					$data['description_error'] = 'Password must be greater than 6 characters';
				}

				if (empty($data['condition'])){
					$data['condition_error'] = 'Please select book condition.';
				}

				if (empty($data['price'])){
					$data['price_error'] = 'Please enter a price';
				}

				if (empty($data['title_error']) && empty($data['author_error']) & empty($data['description_error']) && empty($data['condition_error']) && empty($data['price_error'])){
					if($this->postModel->updatePost($data)){
						redirect('/posts/listings');
					}else{
						die('Something went wrong');
					}

				}else{
					$this->view('posts/edit', $data);
				}
			}else{
				$post = $this->postModel->getPostById($id);

				//check if user is same as post author
				if($post->books_user_id != $_SESSION['user_id']){
					redirect('index');
				}

				$data = [
					'id_books' => $post->id_books,
					'title' => $post->title,
					'author' => $post->author,
					'description' => $post->description,
					'condition' => $post->book_condition,
					'price' => $post->book_price,
					'title_error' => '',
					'author_error' => '',
					'description_error' => '',
					'price_error' => ''
				]; 
				$this->view('posts/edit', $data);
			}
		}

		public function delete($id){
			if(!isset($_SESSION['user_id'])){
				redirect(URLROOT);
			}
			if($_SERVER['REQUEST_METHOD'] == 'POST'){

				//fetch existing post from model
				$post = $this->postModel->getPostById($id);

				if($this->postModel->deletePost($id)){
					redirect('posts/listings');
				}else{
					die('Something went wrong.');
				}
			}else{
				redirect('listings');
			}
		}
	}