<?php

class User{
		private $db;

		public function __construct(){
			$this->db = new Database;
		}

		// register user
		public function register($data){
			$this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
			//Bind values
			$this->db->bind(':name', $data['name']);
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':password', $data['password']);

			// Execute
			if($this->db->execute()){
				return true;
			}else{
				return false;
			}
		}

		// login user
		public function login($email, $password){
			$row = $this->getUserByEmail($email);
			
			$hashed_password = $row->password;
			//verify if passwords match
			if(password_verify($password, $hashed_password)){
				//matched
				return $row;
			}else{
				return false;
			}
		}

		// get user by email, used to check if email already exists in database for registration
		public function getUserByEmail($email){
			$this->db->query('Select * FROM users WHERE email = :email');
			$this->db->bind(':email', $email);

			$row = $this->db->single();
			
			return $row;
		}
	}