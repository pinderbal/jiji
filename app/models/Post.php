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
	}