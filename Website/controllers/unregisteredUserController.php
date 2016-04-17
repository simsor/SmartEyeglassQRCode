<?php
class unregisteredUserController extends userController{
	protected  $SPECIFIC_ACTION=array('login');

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





}
?>