<?php
	class Pages extends Controller{

		public function __construct(){
			//load model
			$this->pagesModel = $this->model('Page');
		}

		public function index(){
			//call model function
			//get posts
			$posts = $this->pagesModel->getPosts();

			$data = [
				'posts' => $posts
			];

			//pass to view
			$this->view('pages/index', $data);
		}
	}