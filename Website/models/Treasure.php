<?php
	class Treasure{

		private $treasure_id;
		private $description;
		private $next_hint;

		function __construct($treasure_id, $description, $next_hint)
		{
			$this->treasure_id=$treasure_id;
			$this->description=$description;
			$this->next_hint=$next_hint;
		}

		/* Getter */
		public function getTreasure_id(){
			return $this->treasure_id;
		}
		public function getDescription(){
			return $this->description;
		}
		public function getNext_hint(){
			return $this->next_hint;
		}


		/* Setter */
		public function setTreasure_id($post_id){
			$this->treasure_id = $treasure_id;
		}
		public function setDescriptione($username){
			$this->description = $description;
		}
		public function setNext_hint($post_title){
			$this->next_hint = $next_hint;
		}
		

	}
?>