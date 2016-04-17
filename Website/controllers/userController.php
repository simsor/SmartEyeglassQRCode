<?php
abstract class userController{

	protected  $USER_ACTION	=array('home','getAllUsersJson','getAllScansJson','getAlltreasuresJson','validateemail');

	public function __construct($action='home'){
		if(in_array($action, $this->USER_ACTION)){
			$this->$action();
		}
		elseif (in_array($action, $this->SPECIFIC_ACTION ))
			$this->$action();
		else $this->error403();
	}

	protected function getAllUsersJson(){

		$myUserManager=UserManager::getInstance();
		echo $myUserManager->getAllUsersJson();
	}

	protected function getAlltreasuresJson(){

		$myTreasureManager=TreasureManager::getInstance();
		echo $myTreasureManager->getAlltreasuresJson();
	}

	protected function getAllScansJson(){

		$myScanManager=ScanManager::getInstance();
		echo $myScanManager->getAllScansJson();
	}


	protected function home(){
		global $rep, $view,$data;
		// echo $this -> getAllScansJson();
		// $mytrmana=TreasureManager::getInstance();
		// $mytrmana=ScanManager::getInstance();
		$mytrmana=UserManager::getInstance();
		// //$test=
		// $value = $mytrmana->getAllUsersJson();
		// // $value = $mytrmana->getAllScansJson();
		// // $value = $mytrmana->getTreasureByIdJson(1);
		// // $value = $mytrmana->getAllTreasuresJson();

		// // foreach($jsonstring as $value){
		// // 	echo json_decode($value);
		// // }
		// //var_dump($mytrmana->getAllTreasures());
		// var_dump($value);
		// var_dump($this->getAllUsersJson());
		// require_once ($view['home']);
		echo $mytrmana->getAllUsersJson();
		}

	

		protected function error403(){
			global $rep, $view;

			header($_SERVER["SERVER_PROTOCOL"]." 403 Forbidden access");
			$data[0]="We're sorry, something somewhere went wrong...";
			$data[1]="This is a 403";
			$data[2]="You must log in to access this page";
			require_once ($view['error']);
		}

	// protected function tags(){
	// 	global $rep, $view;
	// 	$myTagManager=TagManager::getInstance();
	// 	$data['tags']=$myTagManager->getAllTag();

	// 	require_once ($view['tags']);

	// }

	// protected function validateemail(){
		
	// 	global $rep, $view,$data;
	// 	$myUserManager=UserManager::getInstance();

	// 	$usernamehash=isset($_GET['arg1']) ? $_GET['arg1'] : '';
	// 	$hash=isset($_GET['arg2']) ? $_GET['arg2'] :'' ;
	// 	$usernamehash=cleaner::cleanString($usernamehash);
	// 	$hash=cleaner::cleanString($hash);

	// 	$users=$myUserManager->getAllUsers();
	// 	foreach ($users as $user) {
	// 		if(hash ( "md5",$user->getUsername())==$usernamehash){
	// 			if(!$user->isActive()){
	// 				if(hash ( "md5", $user->getUsername().$user->getPasswordHash().$user->getRole())==$hash){
	// 					try{
	// 						$myUserManager->activateUser($user->getUsername());
	// 						$data['info']="Email verified!";
	// 						break;
	// 					}
	// 					catch (Exception $e) {
	// 						$data[0]="We're sorry, something somewhere went wrong...";
	// 						$data[1]="Error while searching: please notice your admin";
	// 						$data[2]=$e->getMessage();
	// 						require_once ($view['error']);
	// 					}
	// 				}
	// 			}else {
	// 				$data['info']="Email already verified!";
	// 				break;
	// 			}
	// 		}
	// 	}
	// 	$this->home();
	// }

	// protected function showadventure($id_adv=NULL){
		// 	try{
		// 		global $rep, $view;
		// 		$myPostManager=PostManager::getInstance();
		// 		$id_adv = $id_adv!=NULL ? $id_adv : (isset($_REQUEST['arg1']) ? $_REQUEST['arg1'] : NULL );
		// 		$id_adv=cleaner::cleanInt($id_adv);//can get it via $_GET so clean it
		// 		$post = $myPostManager->getPostById($id_adv);
		// 		if($post==NULL){
		// 			header($_SERVER["SERVER_PROTOCOL"]." 404 Page not found");
		// 			$data[0]="We're sorry, something somewhere went wrong...";
		// 			$data[1]="The adventure you're looking for doesn't exist (anymore?)";
		// 			require_once ($view['error']);
		// 		}
		// 		else require_once($view['adventure']);
		// 	}
		// 	catch (Exception $e) {
		// 		$data[0]="We're sorry, something somewhere went wrong...";
		// 		$data[1]="Unknown Error: please notice your admin";
		// 		$data[2]=$e->getMessage();
		// 		require_once ($view['error']);
		// 	}

		// }

	// protected function search(){
	// 	global $rep, $view;
	// 	$research_types=array('keyword','author','tag');
	// 	$myPostManager=PostManager::getInstance();

	// 	// if(isset($_POST['search']))
	// 	// {
	// 	// 	$researchtype=isset($_POST['searchtype']) ? $_POST['searchtype'] : 'keyword' ;
	// 	// 	$researchtag=isset($_POST['searchtags']) ? $_POST['searchtags'] : '' ;
	// 	// 	$researchtag=cleaner::cleanString($researchtag);

	// 	// 	$host  = $_SERVER['HTTP_HOST'];
	// 	// 	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	// 	// 	$extra = 'search/'.$researchtype."/".$researchtag;

	// 	// 	header("Location: http://$host$uri/$extra");
	// 	// }
	// 	// else
	// 	// {
	// 	$researchtype=isset($_GET['arg1']) ? $_GET['arg1'] : (isset($_POST['searchtype']) ? $_POST['searchtype'] : 'keyword') ;
	// 	$researchtag=isset($_GET['arg2']) ? $_GET['arg2'] :(isset($_POST['searchtags']) ? $_POST['searchtags'] : '') ;
	// 	$orderby=isset($_POST['orderby']) ? $_POST['orderby'] : 'dateasc' ;
	// 	$researchtag=cleaner::cleanString($researchtag);
	// 	$researchtype=cleaner::cleanString($researchtype);
	// 	$orderby=cleaner::cleanString($orderby);
	// 	try{
	// 		if(in_array($researchtype, $research_types)){
	// 			switch($researchtype){
	// 				case 'author' :
	// 				if($researchtag=='') $data['data']=$myPostManager->getAllposts();
	// 				else{
	// 					$data['data']=$myPostManager->getPostsByUsername($researchtag);
	// 				}
	// 				// require_once ($view['search']);
	// 				break;
	// 				case 'keyword' :
	// 				if($researchtag=='') $data['data']=$myPostManager->getAllposts();
	// 				else{
	// 					$data['data']=$myPostManager->getPostsByKeyword($researchtag);
	// 				}
	// 				//require_once ($view['search']);
	// 				break;
	// 				case 'tag':							
	// 				if($researchtag=='') $data['data']=$myPostManager->getAllposts();
	// 				else{
	// 					$data['data']=$myPostManager->getAllPostForTag($researchtag);
	// 					$myPostManager->getTop5Posts();
	// 				}
	// 				//require_once ($view['search']);
	// 				break;
	// 				default:					
	// 				if($researchtag=='') $data['data']=$myPostManager->getAllposts();
	// 				else{
	// 					$data['data']=$myPostManager->getPostsByKeyword($researchtag);
	// 				}
	// 				break;
	// 			}
	// 		}
	// 	}catch (Exception $e) {
	// 		$data[0]="We're sorry, something somewhere went wrong...";
	// 		$data[1]="Error while searching: please notice your admin";
	// 		$data[2]=$e->getMessage();
	// 		require_once ($view['error']);
	// 	}
	// 	switch($orderby){
	// 		case 'dateasc' :
	// 		usort($data['data'],function($a, $b)
	// 		{
	// 			if ($a->getDateTimePosted() ==$b->getDateTimePosted()) {
	// 				return 0;
	// 			}
	// 			return ($a->getDateTimePosted() < $b->getDateTimePosted()) ? 1 : -1;
	// 		}
	// 		);
	// 		break;
	// 		case 'datedes' :
	// 		usort($data['data'],function($a, $b)
	// 		{
	// 			if ($a->getDateTimePosted() ==$b->getDateTimePosted()) {
	// 				return 0;
	// 			}
	// 			return ($a->getDateTimePosted() > $b->getDateTimePosted()) ? 1 : -1;
	// 		}
	// 		);
	// 		break;
	// 		case 'voteasc' :			
	// 		usort($data['data'],function($a, $b)
	// 		{
	// 			if (count($a->getVotes()) ==count($b->getVotes())) {
	// 				return 0;
	// 			}
	// 			return (count($a->getVotes()) < count($b->getVotes())) ? 1 : -1;
	// 		}
	// 		);
	// 		break;
	// 		case 'votedec' :
	// 		usort($data['data'],function($a, $b)
	// 		{
	// 			if (count($a->getVotes()) ==count($b->getVotes())) {
	// 				return 0;
	// 			}
	// 			return (count($a->getVotes()) > count($b->getVotes())) ? 1 : -1;
	// 		}
	// 		);
	// 		break;
	// 	}
	// 			// }
	// 	require_once ($view['search']);
	// }		

	}
	?>