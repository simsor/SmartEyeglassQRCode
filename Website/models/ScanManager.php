<?php
class ScanManager
{


private static $instance;

public static function getInstance(){
	if(!isset(self::$instance)){
		self::$instance = new ScanManager();
	}
	return self::$instance;
}

public function addScan($username,$treasure_id){
	try{ 
		$scan = ORM::for_table('scan')->create();

				//the current date
		$dateTime = new DateTime("now", new DateTimeZone('Europe/London'));
		$mysqldate = $dateTime->format("Y-m-d H:i:s");

		$scan->username = $username;
		$scan->treasure_id = $treasure_id;
		$scan->date_scan = $mysqldate;


		$scan->save();


		return $scan->scan_id();

	}
	catch(PDOException $ex)
	{
		throw $ex;
	}
}






		public function getScanById($scan_id){
			$scanORM = ORM::for_table('scan')->find_one($scan_id);

			if(!$scanORM)
				return null;

			return self::createScanFromORMObject($scanORM);	
		}


		public function getScanByIdJson($scan_id){
			$scan=$this->getScanById($scan_id);

			$myTreasureManager = TreasureManager::getInstance();
			$scanjson =array(
		    	// 'treasure_id' => $myTreasureManager->getTreasureByIdJson($scan->getTreasure_id()),
		    	'username' => $scan->getUsername(),
		    	'scan_id' => $scan->getScan_id(),
		    	'date_scan' => $scan->getDate_scan()
		    );

		    return Json_encode($scanjson);
		}

		public function getAllScans()
		{
			$setOfScanORM = ORM::for_table('scan')->find_many();
			$scanArray = array();
			
			$data = self::createScanFromORMSet($setOfScanORM);

			return $data;
		}

		public function getAllScansByUsername($username)
		{
			$setOfScanORM = ORM::for_table('scan')->where(array(
				'username'=> $username))
				->find_many();

			$scanArray = array();
			
			$data = self::createScanFromORMSet($setOfScanORM);
			// var_dump($data);
			return $data;
		}		

		public function getAllScansByUsernameJson($username)
		{
		
			$myTreasureManager = TreasureManager::getInstance();

			$scanArray = $this->getAllScansByUsername($username);
			
			
			$datajson = array();
			foreach($scanArray as $scan){
				
				array_push($datajson, 	array(
		    	// 'treasure_id' => $myTreasureManager->getTreasureByIdJson($scan->treasure_id),
				'treasure' => $getTreasureByIdJson($scan->getTreasure_id()),
		    	'username' => $scan->getUsername(),
		    	'scan_id' => $scan->getScan_id(),
		    	'date_scan' => $scan->getDate_scan()
			    ));
			}

		    $datajson= Json_encode($datajson);
			return $datajson;
		}		

		public function getAllScansJson()
		{
			
			$myTreasureManager = TreasureManager::getInstance();

			$scanArray = $this->getAllScans();


			$datajson = array();
			foreach($scanArray as $scan){
				array_push($datajson, 	array(
		    	// 'treasure_id' => $myTreasureManager->getTreasureByIdJson($scan->treasure_id),
				'treasure' => $scan->getTreasure(),
		    	'username' => $scan->getUsername(),
		    	'scan_id' => $scan->getScan_id(),
		    	'date_scan' => $scan->getDate_scan()
			    ));
			}

		    $datajson= Json_encode($datajson);
			return $datajson;
		}

		private function createScanFromORMObject($scanORM){
	
			$myTreasureManager = TreasureManager::getInstance();

			return new Scan(
				(int)$scanORM->scan_id,
				$myTreasureManager->getTreasureById($scanORM->treasure_id),
				$scanORM->username,
				$scanORM->date_scan	);
		}


		private function createScanFromORMSet($scanORM){

			$myTreasureManager = TreasureManager::getInstance();
	
			$scanArray = array();
			foreach($scanORM as $value){
				array_push($scanArray, new  Scan(
					(int)$value->scan_id,
					$value->treasure_id,
					$value->username,
					$value->date_scan	));
			}
			return $scanArray;
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

	}
	?>