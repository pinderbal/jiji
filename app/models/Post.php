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

		public function getResults($search){
			$this->db->query('Select * FROM books WHERE id_books = :id');
			$this->db->bind(':id', $search);

			$results = $this->db->resultSet();
			return $results;
		}

		public function getPostById($search){
			$this->db->query('Select * FROM books WHERE id_books = :id');
			$this->db->bind(':id', $search);

			$results = $this->db->single();
			return $results;
		}

		public function addPost($data){
			$this->db->query('INSERT INTO books (books_user_id, title, author, description, book_condition, book_price)
							  VALUES (:books_user_id, :title, :author, :description, :book_condition, :book_price)');
			//Bind values
			$this->db->bind(':books_user_id', $_SESSION['user_id']);
			$this->db->bind(':title', $data['title']);
			$this->db->bind(':author', $data['author']);
			$this->db->bind(':description', $data['description']);
			$this->db->bind(':book_condition', $data['condition']);
			$this->db->bind(':book_price', $data['price']);

			// Execute
			if($this->db->execute()){
				return true;
			}else{
				return false;
			}
		}
	}