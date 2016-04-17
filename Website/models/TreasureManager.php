<?php
class TreasureManager
{


private static $instance;

public static function getInstance(){
	if(!isset(self::$instance)){
		self::$instance = new TreasureManager();
	}
	return self::$instance;
}

public function addTreasure($description,$next_hint){
	try{ 
		$treasure = ORM::for_table('Treasure')->create();

				//the current date
		//$dateTime = new DateTime("now", new DateTimeZone('Europe/London'));
		//$mysqldate = $dateTime->format("Y-m-d H:i:s");

		$treasure->description = $description;
		$treasure->next_hint = $next_hint;


		$treasure->save();


		return $treasure->id();

	}
	catch(PDOException $ex)
	{
		throw $ex;
	}
}


// public function deleteTreasure($treasure_id){
// 			//delete img
// 			//first get the post
// 			$treasure=self::getPostById($post_id); // return null if no post

// 			if(!$post){
// 				return false;
// 			}
// 			//post->getImg

// 			//foreach img delete img in the DB 
// 			$imgtmp=$post->getImages();
// 			if(!empty($imgtmp)){
// 				foreach ($post->getImages() as $image) {
// 					$imageManager = ImageManager::getInstance();
// 					$imageManager->deleteImageById($image->getImgId());
// 				}
// 				//then in the files (somthing like rmdir /images/posts/$postid -R) !!!this section might rise errors...
// 				$dir='images/posts/'.$post->getPostId();
// 				$files = array_diff(scandir($dir), array('.','..')); 
// 				foreach ($files as $file) { 
// 					(is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
// 				} 
// 				rmdir($dir); 
// 			}

// 			//foreach vote, unset it
// 			$votestmp=$post->getVotes();
// 			if(!empty($votestmp)){
// 				foreach ($post->getVotes() as $vote) {
// 					$voteManager = VotePostManager::getInstance();
// 					$voteManager->deleteVote($post->getPostId(),$post->getUsername());
// 				}
// 			}


// 			//foreach comment, unset it
// 			$commentstmp=$post->getComments();
// 			if(!empty($commentstmp)){
// 				foreach ($post->getComments() as $comment) {
// 					$commentManager = CommentManager::getInstance();
// 					$commentManager->deleteComment($comment->getCommentId());				
// 				}
// 			}
// 			$postORM = ORM::for_table('post')->find_one($post_id);
// 			if(isset($postORM)){
// 				//echo"test";
// 			}
// 			$postORM->delete();
// 		}




		public function getTreasureById($treasure_id){
			$treasureORM = ORM::for_table('Treasure')->find_one($treasure_id);

			if(!$treasureORM)
				return null;

			return self::createTreasureFromORMObject($treasureORM);	
		}


		public function getTreasureByIdJson($treasure_id){
			$treasureORM = ORM::for_table('Treasure')->find_one($treasure_id);

			if(!$treasureORM)
				return null;

			$treasure = self::createTreasureFromORMObject($treasureORM);	
			
			$data =array(
		    	'treasure_id' => $treasure->getTreasure_id(),
		    	'description' => $treasure->getDescription(),
		    	'next_hint' => $treasure->getNext_hint()
		    );
		    $datajson= Json_encode($data);
			return $datajson;
		}




		public function getAlltreasures()
		{
			$setOfTreasureORM = ORM::for_table('Treasure')->find_many();
			$treasureArray = array();
			
			$data = self::createTreasureFromORMSet($setOfTreasureORM);

			return $data;
		}


		public function getAlltreasuresJson()
		{
			$setOfTreasureORM = ORM::for_table('Treasure')->find_many();
			$treasureArray = $this->getAlltreasures() ;
			

			$datajson = array();
			foreach($treasureArray as $value){
				array_push($datajson, array(
			    	'treasure_id' => $value->getTreasure_id(),
			    	'description' => $value->getDescription(),
			    	'next_hint' => $value->getNext_hint()
			    ));
			}
			
		    $datajson= Json_encode($datajson);
			return $datajson;
		}



		private function createTreasureFromORMSet($setOfTreasureORM){
	
			$treasureArray = array();
			foreach($setOfTreasureORM as $value){
				array_push($treasureArray, new Treasure(
				(int)$value->treasure_id,
				$value->description,
				$value->next_hint));
			}
			return $treasureArray;
		}


		private function createTreasureFromORMObject($treasureORM){
	
		
			return new Treasure(
				(int)$treasureORM->treasure_id,
				$treasureORM->description,
				$treasureORM->next_hint);
		}

	}
	?>