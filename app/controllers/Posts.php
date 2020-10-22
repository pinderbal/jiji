<?php
	class Posts extends Controller{

		// load model
		public function __construct(){
			//load model
			$this->postModel = $this->model('Post');
		}

		public function index(){
		}

		// search 
		public function search(){
			//check if GET request
			if($_SERVER['REQUEST_METHOD'] == 'GET'){
				// Sanitize post
				$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
				// Take the search and store into array.
				$search = explode(' ', $_GET['title']);
				$searchTermBits = array();
				// Store each term in a query array
				foreach ($search as $term) {
				    $term = trim($term);
				    if (!empty($term)) {
				        $searchTermBits[] = "title LIKE '%$term%'";
			    	}
			    }

				$posts = $this->postModel->getResults($searchTermBits);
				$data = [
					'posts' => $posts
				];

				
				$this->view('posts/results', $data);
			}
		}

		// show ad
		public function show($id){
			$post = $this->postModel->getPostById($id);

			$data = [
				'post' => $post,
			];

			$this->view('posts/show', $data);
		}

		// show listings
		public function listings(){
			// if user not logged in redirect to login
			if(!isset($_SESSION['user_id'])){
				redirect('users/login');
			}

			// if user is logged in fetch all posts by user form database
			$post = $this->postModel->getAllPostsFromUser();
			$data=[
				'post' => $post
			];

			$this->view('posts/listings', $data);
		}

		// create ad
		public function add(){
			// if user is not logged in redirect to login
			if(!isset($_SESSION['user_id'])){
				redirect('users/login');
			}

			// if user submits 
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				//sanitize
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'title' => $_POST['title'],
					'author' => $_POST['author'],
					'description' => $_POST['description'],
					'condition' => $_POST['condition'],
					'price' => $_POST['price'],
					'img' => '',
					'title_error' => '',
					'author_error' => '',
					'description_error' => '',
					'condition_error' => '',
					'price_error' => '',
					'img_error' => ''
				];

				// Image handling
				$target_dir = "img/";
				$target_file = $target_dir . time() . basename($_FILES['img-upload']['name']);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				
			if(!empty($_FILES['img-upload']['tmp_name'])){
				$check = getimagesize($_FILES["img-upload"]["tmp_name"]);
	
				if($check !== false) {
				    $uploadOk = 1;
				} else {
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["img-upload"]["size"] > 500000) {
				  $data['img_error'] = "Sorry, your image is too large.";
				  $uploadOk = 0;
				} 

				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				  $data['img_error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				  $uploadOk = 0;
				}
			}else{
				$data['img_error'] = "Please upload a picture";
			}
				$data['img'] = $target_file;

				// validation
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

				// Once there are no errors
				if (empty($data['title_error']) && empty($data['author_error']) & empty($data['description_error']) && empty($data['condition_error']) && empty($data['price_error']) && empty($data['img_error'])){

					if (move_uploaded_file($_FILES["img-upload"]["tmp_name"], $target_file)) {
					} else {
					   $data['img_error'] = "Sorry, there was an error uploading your file.";
					}

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
					'price_error' => '',
					'img_error' => ''
				]; 
				$this->view('posts/add', $data);
			}
		}

		// update an ad
		public function edit($id){
			// if user is not logged in
			if(!isset($_SESSION['user_id'])){
				redirect(users/login);
			}

			// check to see if user submits
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				// sanitize
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'id_books' => $id,
					'title' => $_POST['title'],
					'author' => $_POST['author'],
					'description' => $_POST['description'],
					'condition' => $_POST['condition'],
					'price' => $_POST['price'],
					'img' => '',
					'title_error' => '',
					'author_error' => '',
					'description_error' => '',
					'condition_error' => '',
					'price_error' => '',
					'img_error' => '',
				];

				// Image handling
				$target_dir = "img/";
				$target_file = $target_dir . time() . basename($_FILES['img-upload']['name']);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				
			if(!empty($_FILES['img-upload']['tmp_name'])){
					$check = getimagesize($_FILES["img-upload"]["tmp_name"]);
	
				if($check !== false) {
				    $uploadOk = 1;
				} else {
					$uploadOk = 0;
				}

				// Check file size
				if ($_FILES["img-upload"]["size"] > 500000) {
				  $data['img_error'] = "Sorry, your image is too large.";
				  $uploadOk = 0;
				} 

				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				  $data['img_error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				  $uploadOk = 0;
				}
			}else{
				
			}
				// Validation
				if(!empty($_FILES['img-upload']['tmp_name'])){
					$data['img'] = $target_file;
				}

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

				// Once there are no errors
				if (empty($data['title_error']) && empty($data['author_error']) & empty($data['description_error']) && empty($data['condition_error']) && empty($data['price_error']) && empty($data['img_error'])){
					
					if (!empty($_FILES['img-upload']['tmp_name'])){
						if (move_uploaded_file($_FILES["img-upload"]["tmp_name"], $target_file)) {
						} else {
						   $data['img_error'] = "Sorry, there was an error uploading your file.";
						}
					}

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

				// load view with proper data
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

		// delete ad
		public function delete($id){
			// check if user is logged in
			if(!isset($_SESSION['user_id'])){
				redirect(users/login);
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