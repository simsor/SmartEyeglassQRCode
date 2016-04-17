<?php class cleaner{
	//Classe de nettoyage des paramètres pour éviter injection de code (et éviter des failles de sécurité)
	
	//Nettoyer les URL 
	public static function cleanUrl($link)
	{
	   return filter_var($link,FILTER_SANITIZE_URL);
	}

	//Nettoyer les chaines de caractères
	public static function cleanString($string)
	{
		return filter_var($string,FILTER_SANITIZE_STRING);	
	}

	//Nettoyer les adresses Mail
	public static function cleanEmail($email)
	{
		return filter_var($email,FILTER_SANITIZE_EMAIL);	
	}

	//Nettoie les int
	public static function cleanInt($int)
	{
		return filter_var($int,FILTER_SANITIZE_NUMBER_INT);	
	}		


}