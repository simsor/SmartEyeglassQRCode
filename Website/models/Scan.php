<?php
	class Scan{

		private $treasure_id;
		private $username;
		private $scan_id;
		private $date_scan;
		private $treasure;

		function __construct($scan_id, $treasure_id, $username, $date_scan)
		{

			$myTreasureManager=TreasureManager::getInstance();
			$this->treasure_id=$treasure_id;
			$this->username=$username;
			$this->scan_id=$scan_id;
			$this->date_scan=$date_scan;
			$this->treasure=$myTreasureManager->getTreasureById($treasure_id);
		}

		/* Getter */
		public function getTreasure_id(){
			return $this->treasure_id;
		}
		public function getTreasure(){
			return $this->treasure;
		}
		public function getScan_id(){
			return $this->scan_id;
		}
		public function getDate_scan(){
			return $this->date_scan;
		}
		public function getUsername(){
			return $this->username;
		}


		/* Setter */
		public function setTreasure_id($post_id){
			$this->treasure_id = $treasure_id;
		}
		public function setScan_id($username){
			$this->scan_id = $scan_id;
		}
		public function setDate_scan($post_title){
			$this->date_scan = $date_scan;
		}
		public function setUsername($post_title){
			$this->username = $username;
		}
		

	}
?>