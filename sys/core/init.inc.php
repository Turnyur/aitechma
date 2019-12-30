<?php

session_start();

if (!isset($_SESSION['token'])) {
	$_SESSION['token']=sha1(uniqid(mt_rand(),TRUE));
}
/*  
* Include the necessary configuration info  
*/ 

include_once '../sys/config/db_cred.inc.php'; 



/*  
* Define constants for configuration info  
*/ 
foreach ($C as $name => $value) {
	# code...
		define($name, $value);
}

/*  
* Create a PDO object  
*/ 

$dsn='mysql:host='.DB_HOST.';dbname='.DB_NAME;
$dbo=new PDO($dsn,DB_USER,DB_PASS);


spl_autoload_register('my_autoloader');

function my_autoloader($class){
	$filename="../sys/class/class.".$class.".inc.php";
	if(file_exists($filename)){

		include_once $filename;


	}



}



?>