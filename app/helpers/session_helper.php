<?php 
	session_start();
	
	function isLoggedIn(){
		if(isset($_SESSION['user_id'])){
			//is logged in
			return true;
		}else{
			return false;
		}
	}