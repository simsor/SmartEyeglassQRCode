<?php 
	class UserManager{
	
/*
create table if not exists user (
  username varchar(20) not null,
  password_hash char(60) not null,
  display_name varchar(40) not null,
  role enum('reader', 'writer', 'administrator') not null,
  profil_pic varchar(260),
  primary key (username)
);
*/
		private static $instance;

		public static function getInstance(){
			if(!isset(self::$instance)){
				self::$instance = new UserManager();
			}
			return self::$instance;
		}
		
		// give a md5 hashed password
		public function addUser($username,$displayname,$password,$roleUser)
		{
			//in the config file
			global $role; 

			// Check if the role is possible 
			if(!in_array($roleUser, $role)){
				throw new Exception ('Impossible to add this user, incorrect role');
				return;
			}
			try
			{
				$user = ORM::for_table('User')->create();

				$user->username = $username;
				$user->displayname = $displayname;
				$user->password_hash = $password;
				$user->role = $roleUser;


				$user->save();
			}
			catch(PDOException $ex)
    		{
        		ORM::get_db()->rollBack();
        		throw $ex;
    		}
		}


		public function getUserByUsername($username)
		{
			$myScanManager = ScanManager::getInstance();
			$scansUser=$myScanManager->getAllScansByUsername($username);
			$userORM = ORM::for_table('User')->find_one($username);
			if(!$userORM)
				return null;
			return new User($userORM->username,$userORM->displayname,$userORM->password_hash,$userORM->role,$scansUser);

		}

		public function getUserByUsernameJson($username)
		{
			$user = $this -> getUserByUsername($username);
			$scans=array();
			foreach($user->getScans() as $scan){
				array_push($scans,array( 
					'scan_id' => $scan->getScan_id(),
					'date_scan' => $scan->getDate_scan(),
					'treasure_id' => $scan->getTreasure_id(),
					'username' => $scan->getUsername()
					));
			}

			$data =array(
		    	'username' => $user->getUsername(),
		    	'password_hash' => $user->getPasswordHash(),
		    	'displayname' => $user->getDisplayname(),
		    	'role' => $user->getRole(),
		    	'scans' => $scans

		    );
		    $datajson= Json_encode($data);
			return $datajson;

		}

		public function getUserWithPassword($username,$pwd)
		{
			$pwd_hash=hash ( "md5", $pwd);
			$userORM = ORM::for_table('User')->where(array(
				'username'=> $username,
				'password_hash'=> $pwd_hash))
				->find_one();
				//var_dump($userORM);
			return new User($userORM->username,$userORM->displayname,$userORM->password_hash,$userORM->role);
			return NULL;
		}

		public function getAllUsers()
		{

			$myScanManager = ScanManager::getInstance();
			$usersORM = ORM::for_table('User')->find_many();
			$users=Array();
			foreach($usersORM as $userORM){
				$scansUser=$myScanManager->getAllScansByUsername($userORM->username);
				array_push($users,new  User($userORM->username,$userORM->displayname,$userORM->password_hash,$userORM->role,$scansUser));
			}
			return $users;
		}			

	
		public function getAllUsersJson()
		{
			$users= $this -> getAllUsers();

			

			$datajson = array();
			foreach($users as $user){
				$scans=array();
				foreach($user->getScans() as $scan){
					array_push($scans,array( 
						'scan_id' => $scan->getScan_id(),
						'date_scan' => $scan->getDate_scan(),
						'treasure' => $scan->getTreasure(),
						'username' => $scan->getUsername()
						));
				}
				array_push($datajson, array(	
			    	'username' => $user->getUsername(),
			    	'password_hash' => $user->getPasswordHash(),
			    	'displayname' => $user->getDisplayname(),
			    	'role' => $user->getRole(),
			    	'scans' => $scans
			    ));
			}

		    $datajson= Json_encode($datajson);
			return $datajson;
		}			

			

	
	}




		


?>

