<?php
	class Pages extends Controller{

		//load model
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

		public function about(){
			$data = [
				'title' => 'About Us'
			];
			$this->view('pages/about', $data);
		}
	}