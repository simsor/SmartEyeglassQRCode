<?php
class checkData{
	static function checkBothPassword($pwd1,$pwd2)
	{
		return $pwd1==$pwd2;
	}

	static function checkPasswordRegex($pwd)
	{
		$pattern = '((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%]).{6,20})';
		return preg_match ($pattern, $pwd);
	}


}

?>