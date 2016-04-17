<?php
class frontController{


	function __construct() {


		global $rep, $view,$actions;


		session_start();


			try{
				$action=isset($_REQUEST['action']) ? $_REQUEST['action'] : 'home' ;

				$action=cleaner::cleanString($action);

				if(in_array($action, $actions)){
					$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'unregisteredUser' ;
					$controller=$role.'Controller';
					$cont=new $controller($action);
				}
				else $this->error404();

			}catch (Exception $e) {
				$data[0]="We're sorry, something somewhere went wrong...";
				$data[1]="Unknown Error: please notice your admin";
				$data[2]=$e->getMessage();
				require_once ($view['error']);
			}



		}
		private function error404(){

			global $rep, $view,$actions;

			header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
			$data[0]="We're sorry, something somewhere went wrong...";
			$data[1]="This is a 404";
			$data[2]="Page not found";
			require_once ($view['error']);
		}

	}
	?>