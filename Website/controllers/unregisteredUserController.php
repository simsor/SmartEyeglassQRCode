<?php
class unregisteredUserController extends userController{
	protected  $SPECIFIC_ACTION=array('login', "validateTreasure");

	protected function login(){

		global $rep, $view;
		$myUserManager=UserManager::getInstance();

		$login = isset($_POST['username']) ? $_POST['username'] : '';
		$pwd = isset($_POST['password']) ? $_POST['password'] : '';//récupération des variables
		$login=cleaner::cleanString($login);
		$pwd=cleaner::cleanString($pwd);
		try{
			$user=$myUserManager->getUserWithPassword($login,$pwd);	
		}catch (Exception $e) {
			$data[0]="We're sorry, something somewhere went wrong...";
			$data[1]="Unknown Error: please notice your admin";
			$data[2]=$e->getMessage();
			require_once ($view['error']);
		}
		if(isset($user)&&$user!=NULL){
			$_SESSION['username'] = $user->getUsername();
			$_SESSION['displayname'] = $user->getDisplayname();
			$_SESSION['role'] = $user->getRole();
			$_SESSION['logged'] = true;
			$this->home();
			// $host  = $_SERVER['HTTP_HOST'];
			// $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			// $extra = 'index.php';
			// header("Location: http://$host$uri/$extra");
		}
		else {
			$data=array();
			$data[0]="We're sorry, something somewhere went wrong...";
			$data[1]="Username or password wrong";
			require_once ($view['error']);
		}
	}

	protected function validateTreasure() {
		$playerUsername = $_GET["username"];
		$treasureId = $_GET["treasure_id"];

		$userManager = UserManager::getInstance();
		$treasureManager = TreasureManager::getInstance();
		$scanManager = ScanManager::getInstance();

		$player = $userManager->getUserByUsername($playerUsername);
		$treasure = $treasureManager->getTreasureById($treasureId);

		$highestTreasureId = 0;
		$scans = $player->getScans();
		foreach ($scans as $scan) {
			if ($scan->getTreasure_id() > $highestTreasureId)  	{
				$highestTreasureId = $scan->getTreasure_id();
			}
		}
		if (($highestTreasureId+1) == $treasure->getTreasure_id()) {
			// Then this is the next treasure to find
			$hint = $treasure->getNext_hint();
			$scanManager->addScan($playerUsername, $treasureId);

			echo Json_encode(array(
				"state" => "success",
				"hint" => $hint
				));
		} else {
			echo "{state: 'error', error: 'You tried to skip a treasure'}";
		}
	}



}
?>