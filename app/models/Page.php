<?php

class Page{
		private $db;

		public function __construct(){
			$this->db = new Database;
		}

		//Fetch all posts
		public function getPosts(){
			$this->db->query('SELECT * FROM books ORDER BY books_created_at DESC LIMIT 8');
			$results = $this->db->resultSet();
			return $results;
		}
	}