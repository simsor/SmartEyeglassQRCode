<?php
class playerController extends registeredUserController{
	public $ADMIN_ACTION=array('moderateuser','moderatepost','moderateposts','dashboard');

	public function __construct($action){
		$this->SPECIFIC_ACTION=array_merge ($this->SPECIFIC_ACTION,$this->ADMIN_ACTION);
		parent::__construct($action);
	}

		protected function scan_code(){//$post

			global $rep, $view;
			$code=isset($_REQUEST['scan_code']) ? $_REQUEST['scan_code'] : '' ;
			$code=cleaner::cleanInt($code);

//do something
			
			// $data=array();
			// $myUserManager=UserManager::getInstance();
			// try{
			// 	$data['users']=$myUserManager->getAllUsers();
			// }
			// catch (Exception $e) {
			// 	$data[0]="We're sorry, something somewhere went wrong...";
			// 	$data[1]="Unknown Error: please notice your admin";
			// 	$data[2]=$e->getMessage();
			// 	require_once ($view['error']);
			// }
			// require_once($view['admindashboard']);

		}



	}
	?>