<?php
class adminController extends registeredUserController{
	public $ADMIN_ACTION=array('moderateuser','moderatepost','moderateposts','dashboard');

	public function __construct($action){
		$this->SPECIFIC_ACTION=array_merge ($this->SPECIFIC_ACTION,$this->ADMIN_ACTION);
		parent::__construct($action);
	}

		protected function dashboard(){//$post

			global $rep, $view;
			$data=array();
			$myUserManager=UserManager::getInstance();
			try{
				$data['users']=$myUserManager->getAllUsers();
			}
			catch (Exception $e) {
				$data[0]="We're sorry, something somewhere went wrong...";
				$data[1]="Unknown Error: please notice your admin";
				$data[2]=$e->getMessage();
				require_once ($view['error']);
			}
			require_once($view['admindashboard']);

		}


		protected function moderateposts(){
			global $rep, $view;
			$myPostManager=PostManager::getInstance();
			try{
				$data['stories']=$myPostManager->getAllPosts();
			}
			catch (Exception $e) {
				$data[0]="We're sorry, something somewhere went wrong...";
				$data[1]="Unknown Error: please notice your admin";
				$data[2]=$e->getMessage();
				require_once ($view['error']);
			}
			require_once($view['moderateposts']);
		}

		protected function moderatepost(){

			global $rep, $view;
			$data=array();
			$myPostManager=PostManager::getInstance();
			$myImageManager=ImageManager::getInstance();
			$myCommentManager=CommentManager::getInstance();

			try{
				if(isset($_POST['moderatepost'])){//we edit
					switch ($_POST['moderatepost']) {
						case 'deleteimg':
						$post_Id=isset($_POST['post_id']) ? $_POST['post_id'] : NULL ;
						$img_id=isset($_POST['img_id']) ? $_POST['img_id'] : NULL ;

						$myImageManager->deleteImageById($img_id);
					//	$_GET['arg1'])=$post_Id;
						// $host  = $_SERVER['HTTP_HOST'];
						// $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
						// $extra = 'moderatepost/'.$post_Id;
						// header("Location: http://$host$uri/$extra");
						$post=$myPostManager->getPostById($post_Id);
						require_once ($view['moderatepost']);
						
						break;
						case 'deletepost':
						$post_Id=isset($_POST['post_id']) ? $_POST['post_id'] : NULL ;
						if($myPostManager->getPostById($post_Id)==NULL){
							$data=array();
							$data[0]="We're sorry, something somewhere went wrong...";
							$data[1]="The comment you're trying to remove doesn't exist!";
							require_once ($view['error']);
						}else{
							$myPostManager->deletePost($post_Id);
							$this->moderatePosts();
							break;
						}
						break;
						case 'deletecomment':

						$comment_id=isset($_REQUEST['comment_id']) ? $_REQUEST['comment_id'] : NULL ;

						$post_Id=isset($_POST['post_id']) ? $_POST['post_id'] : NULL ;

						if($myCommentManager->getComment($comment_id)==NULL){
							$data=array();
							$data[0]="We're sorry, something somewhere went wrong...";
							$data[1]="The comment you're trying to remove doesn't exist!";
							require_once ($view['error']);
							break;
						}
						else{
							$post_Id=isset($_POST['post_id']) ? $_POST['post_id'] : NULL ;

							$myCommentManager->deleteComment($comment_id);
							// $host  = $_SERVER['HTTP_HOST'];
							// $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
							// $extra = 'moderatepost/'.$post_Id;
							// header("Location: http://$host$uri/$extra");
							$post=$myPostManager->getPostById($post_Id);
							require_once ($view['moderatepost']);
							break;

						}
						break;
						default:
						break;
					}
				}else{
							//otherwise we show the post
					$postId=isset($_GET['arg1']) ? $_GET['arg1'] : NULL ;
					if($postId==NULL){
						$data=array();
						$data[0]="We're sorry, something somewhere went wrong...";
						$data[1]="Please tell us which post you want to edit first.";
						require_once ($view['error']);
					}
					elseif($myPostManager->getPostById($postId)==NULL){
						$data=array();
						$data[0]="We're sorry, something somewhere went wrong...";
						$data[1]="The post you're trying to edit doesn't exist!";
						require_once ($view['error']);
					}
					else{
						$post=$myPostManager->getPostById($postId);
						require_once ($view['moderatepost']);
					}
				}
			}
			catch (Exception $e) {
				$data[0]="We're sorry, something somewhere went wrong...";
				$data[1]="Unknown Error: please notice your admin";
				$data[2]=$e->getMessage();
				require_once ($view['error']);
			}



			
			//$data['stories']=$myPostManager->getAllPosts();
			//require_once($view['moderatepost']);
		}


		protected function moderateuser(){//$username
			
			global $rep, $view;
			$data=array();
			$myUserManager=UserManager::getInstance();

			try{

				if(isset($_POST['moderateuser'])){

					if($_POST['moderateuser']=='banuser'){


						$username=isset($_POST['username']) ? $_POST['username'] : NULL ;
						if($myUserManager->getUserByUsername($username)!=NULL){
							$myUserManager->deleteUserByUsername($username);
							$data['users']=$myUserManager->getAllUsers();

							require_once($view['userslist']);

						}else{
							$data=array();
							$data[0]="We're sorry, something somewhere went wrong...";
							$data[1]="The user you want to kick doesn't exist!";
							require_once ($view['error']);
						}

					}		
					if($_POST['moderateuser']=='activateuser'){


						$username=isset($_POST['username']) ? $_POST['username'] : NULL ;
						// $data=array();
						// $data[0]="We're sorry, something somewhere went wrong...";
						// $data[1]="This feature isn't available yet";
						// require_once ($view['error']);
						if($myUserManager->getUserByUsername($username)!=NULL){
							try{
								if(!$myUserManager->getUserByUsername($username)->isActive()){
									$myUserManager->activateUser($username);//activate user

									$data['users']=$myUserManager->getAllUsers();

									require_once($view['userslist']);
								}else{	
									$data=array();
									$data[0]="We're sorry, something somewhere went wrong...";
									$data[1]="The user is already active";
									require_once ($view['error']);
								}
							}
							catch (Exception $e) {
								$data[0]="We're sorry, something somewhere went wrong...";
								$data[1]="Unknown Error: please notice your admin";
								$data[2]=$e->getMessage();
								require_once ($view['error']);
							}
							
						}else{
							$data=array();
							$data[0]="We're sorry, something somewhere went wrong...";
							$data[1]="The user you want to kick doesn't exist!";
							require_once ($view['error']);
						}

					}				
					if($_POST['moderateuser']=='desactivateuser'){


						$username=isset($_POST['username']) ? $_POST['username'] : NULL ;

						if($myUserManager->getUserByUsername($username)!=NULL){
							try{
								if($myUserManager->getUserByUsername($username)->isActive()){
									$myUserManager->desactivateUser($username);//activate user
									$data['users']=$myUserManager->getAllUsers();
									require_once($view['userslist']);
								}else{	
									$data=array();
									$data[0]="We're sorry, something somewhere went wrong...";
									$data[1]="The user is already inactive";
									require_once ($view['error']);
								}
							}
							catch (Exception $e) {
								$data[0]="We're sorry, something somewhere went wrong...";
								$data[1]="Unknown Error: please notice your admin";
								$data[2]=$e->getMessage();
								require_once ($view['error']);
							}
							
						}else{
							$data=array();
							$data[0]="We're sorry, something somewhere went wrong...";
							$data[1]="The user you want to kick doesn't exist!";
							require_once ($view['error']);
						}

						// $data=array();
						// $data[0]="We're sorry, something somewhere went wrong...";
						// $data[1]="This feature isn't available yet";
						// require_once ($view['error']);
					}
				}else{
					$data['users']=$myUserManager->getAllUsers();

					require_once($view['userslist']);
				}	
			}
			catch (Exception $e) {
				$data[0]="We're sorry, something somewhere went wrong...";
				$data[1]="Unknown Error: please notice your admin";
				$data[2]=$e->getMessage();
				require_once ($view['error']);
			}


		}

		protected function deletepost(){//$post
			global $rep, $view;
			$myPostManager=PostManager::getInstance();

			try{
				if(isset($_POST['delete'])){


					$post_id=isset($_REQUEST['post_id']) ? $_REQUEST['post_id'] : NULL ;


					if($myPostManager->getPostById($post_id)==NULL){
						$data=array();
						$data[0]="We're sorry, something somewhere went wrong...";
						$data[1]="The comment you're trying to remove doesn't exist!";
						require_once ($view['error']);
					}else{
						$post_Id=isset($_POST['post_id']) ? $_POST['post_id'] : NULL ;
						$myPostManager->deletePost($post_Id);
						$this->home();
					}
				}
				$data['stories']=$myPostManager->getAllPosts();
			}	
			catch (Exception $e) {
				$data[0]="We're sorry, something somewhere went wrong...";
				$data[1]="Unknown Error: please notice your admin";
				$data[2]=$e->getMessage();
				require_once ($view['error']);
			}
			require_once($view['moderateposts']);

		}
		
		protected function deletecomment(){
			global $rep, $view;
			$myPostManager=PostManager::getInstance();
			$myCommentManager=CommentManager::getInstance();

			try{
				if(isset($_POST['delete'])){//we edit

					$comment_id=isset($_REQUEST['comment_id']) ? $_REQUEST['comment_id'] : NULL ;
					$username=isset($_SESSION['username']) ? $_SESSION['username'] : NULL ;


					if($myCommentManager->getComment($comment_id)==NULL){
						$data=array();
						$data[0]="We're sorry, something somewhere went wrong...";
						$data[1]="The comment you're trying to remove doesn't exist!";
						require_once ($view['error']);
					}
					elseif ($username==NULL) {
						$data=array();
						$data[0]="We're sorry, something somewhere went wrong...";
						$data[1]="Please login first";
						require_once ($view['error']);
					}
					else{

					//comment the vote

						$myCommentManager->deleteComment($comment_id);
						$this->showadventure();

					}
				}
				else{
					$this->showadventure();
				} 
			}		
			catch (Exception $e) {
				$data[0]="We're sorry, something somewhere went wrong...";
				$data[1]="Unknown Error: please notice your admin";
				$data[2]=$e->getMessage();
				require_once ($view['error']);
			}
		}


	}
	?>