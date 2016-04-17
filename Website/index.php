<?php 
	//chargement autoloader pour autochargement des classes
	require_once('config/autoload.php');
	require_once('vendor/autoload.php');
	require_once('config/config.php');
	Autoload::load();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);


	//Lancement du front controller
	$cont = new frontController();
?>
	

