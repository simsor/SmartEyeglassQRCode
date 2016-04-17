<?php

	class User{
		private $username;
		private $displayname;
		private $scans;
		private $password_hash;
		private $role;


		function __construct($username,$displayname,$password_hash,$role,$scans){
			$this->username = $username;
			$this->displayname = $displayname;
			$this->password_hash=$password_hash;
			$this->role = $role;
			$this->scans =$scans;
		}


		/* Getter */
		public function getUsername(){
			return $this->username;
		}
		public function getPasswordHash(){
			return $this->password_hash;
		}
		public function getDisplayname(){
			return $this->displayname;
		}
		public function getRole(){
			return $this->role;
		}
		public function getScans(){
			return $this->scans;
		}
	}
?>