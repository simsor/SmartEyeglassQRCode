<?php

//Définition du repertoire de travail courrant
$rep=realpath(dirname(__FILE__)).'/../';


		//DB localhost
// $user="root";
// $password = "";
// $base = "somethingcorp_db";
// $host = "localhost";
// //DB amen.fr
$user="root";
$password = "197969roger";
$base = "SmartEyeglassQRCode";
$host = "localhost";

	// coniguration of the ORM connection 
	ORM::configure('mysql:host='.$host.';dbname='.$base);
	ORM::configure('username',$user);
	ORM::configure('password',$password);
	ORM::configure('return_result_sets', true); // returns result sets

	// Set what Idiorm have to take as primary key name 
	//from our database for each table
	ORM::configure('id_column_overrides', array(
	    'User' => 'username',
	    'Treasure' =>'treasure_id',
	    'scan' => 'scan_id'
	));


//Liste des vues
$view['home']='views/home.php';
$view['error']='views/error.php';


$role=array('user','admin','player');

$actions=array('home','login','logout','getAllUsersJson','getAlltreasuresJson','getAllScansJson',
				'add_user','start_game','stop_game', "validateTreasure" );

?>