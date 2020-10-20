<?php

class Post{
		private $db;

		public function __construct(){
			$this->db = new Database;
		}

		//Fetch all posts
		public function getPosts(){
			$this->db->query('SELECT * FROM books ORDER BY books_created_at DESC LIMIT 6');
			$results = $this->db->resultSet();
			return $results;
		}


		public function getResults($searchTermBits){
			$this->db->query('Select * FROM books WHERE ' .implode(' AND ', $searchTermBits) . 'ORDER BY title');
			// $this->db->bind(':id', $search);
			$results = $this->db->resultSet();
			return $results;
		}

		public function getPostById($search){

			$this->db->query('Select * FROM books WHERE id_books = :id');
			$this->db->bind(':id', $search);

			$results = $this->db->single();
			return $results;
		}

		public function getAllPostsFromUser(){
			$this->db->query('SELECT * FROM books WHERE books_user_id = :books_user_id ORDER BY books_user_id DESC');
			$this->db->bind(':books_user_id', $_SESSION['user_id']);
			$results = $this->db->resultSet();
			return $results;
		}

		public function addPost($data){
			$this->db->query('INSERT INTO books (books_user_id, title, author, description, book_condition, book_price, img_file_name)
							  VALUES (:books_user_id, :title, :author, :description, :book_condition, :book_price, :img_file_name)');
			//Bind values
			$this->db->bind(':books_user_id', $_SESSION['user_id']);
			$this->db->bind(':title', $data['title']);
			$this->db->bind(':author', $data['author']);
			$this->db->bind(':description', $data['description']);
			$this->db->bind(':book_condition', $data['condition']);
			$this->db->bind(':book_price', $data['price']);
			$this->db->bind(':img_file_name', $data['img']);

			// Execute
			if($this->db->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function updatePost($data){	
			if(empty($data['img'])){
				$this->db->query('UPDATE books 
							SET title = :title,
							  	author = :author,
							  	description = :description,
							  	book_condition = :book_condition,
							  	book_price = :book_price
							WHERE id_books = :id_books');
				//Bind values
				$this->db->bind(':id_books', $data['id_books']);
				$this->db->bind(':title', $data['title']);
				$this->db->bind(':author', $data['author']);
				$this->db->bind(':description', $data['description']);
				$this->db->bind(':book_condition', $data['condition']);
				$this->db->bind(':book_price', $data['price']);
			}else{
				$this->db->query('UPDATE books 
							SET title = :title,
							  	author = :author,
							  	description = :description,
							  	book_condition = :book_condition,
							  	book_price = :book_price,
							  	img_file_name = :img_file_name
							WHERE id_books = :id_books');
				//Bind values
				$this->db->bind(':id_books', $data['id_books']);
				$this->db->bind(':title', $data['title']);
				$this->db->bind(':author', $data['author']);
				$this->db->bind(':description', $data['description']);
				$this->db->bind(':book_condition', $data['condition']);
				$this->db->bind(':book_price', $data['price']);
				$this->db->bind(':img_file_name', $data['img']);
			}
			// Execute
			if($this->db->execute()){
				return true;
			}else{
				return false;
			}
		}

		public function deletePost($data){
			$this->db->query('DELETE from books WHERE id_books = :id_books');
			//bind values
			$this->db->bind(':id_books', $data);

			// Execute
			if($this->db->execute()){
				return true;
			}else{
				return false;
			}
		}
	}