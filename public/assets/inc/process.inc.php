<?php 
/*  * Enable sessions  */ 
session_start(); 

/*  * Include necessary files  */ 
include_once '../../../sys/config/db_cred.inc.php'; 
 //echo  $_POST['action'];
/*  * Define constants for config info  */ 
foreach ( $C as $name => $val ) { 
	define($name, $val); 
} 

$dsn='mysql:host='.DB_HOST.';dbname='.DB_NAME;

$db=new PDO($dsn,DB_USER,DB_PASS);


spl_autoload_register('my_autoloader');


//Get Ajax Post data
if(isset($_REQUEST["post_data"])){
	$post_data = json_decode($_REQUEST["post_data"], false);

	if ($post_data->action=='register_user'  && ($_SESSION['token']==$post_data->_token)) {
	
	
	$performAction=new Admin($db);
	$pin=$performAction->processRegister($post_data);
	if ($pin){      

	$message = [
			"status"=> "success",
			"message" => [
				"pin"=> $pin,
				
			],
		];
     echo(json_encode($message));
  			//echo " <p>Congrats, <strong>$post_data->username;</strong>! Your details has been successfully logged into our database</p>";
		 	
	}else {         
     // If an error occured, output it and end execution         
		die ( "Error Occurred. Message: ".gettype($pin) );     
	} 
}else if ($post_data->action=='find_user'  && ($_SESSION['token']==$post_data->_token)){

	$performAction=new Admin($db);
	$msg=$performAction->getUserDetails($post_data);
	
	if ($msg){      
		echo(json_encode([
			"status"=> "success",
			"message"=>$msg,
		]));
     	
	}else {         
		$message = [
			"status"=> "error",
			"message" => "Invalid pin supplied!",
		];
     echo(json_encode($message));
	} 

}


}else if( $_POST['action'] =='register_user'  && ($_SESSION['token']== $_POST['_token'])){


$performAction=new Admin($db);
$post_data = (object)$_POST;
$msg=$performAction->processRegister($post_data);
	if ($msg){      


			header("location: ../../success.php?user=$_POST[username]&action=reg-success&token=$_POST[_token]");         
     	
     	
	}else {         
     // If an error occured, output it and end execution         
		die ( "Error Occurred. Message: ".gettype($msg) );     
	} 


}else if ($_POST['action']=='user_login' && ($_SESSION['token']==$_POST['token'])) {
	$performAction=new Admin($db);

	if ( TRUE === $msg=$performAction->processLoginForm()){      

		header('location: ../../');         
		exit;     
	}else {         
     // If an error occured, output it and end execution   
        //header("location: ../../Success.php?user=$_POST[uname]&action=login-fail&token=$_POST[token]");  
        header("location: ../../find-user");  
        exit;      
		die ( $msg );     
	} 
}else if ($_POST['action']=='duplicate_user') {
	$performAction=new Admin($db);
	echo $performAction->processDuplicate();

}


function my_autoloader($class_name) {     
	$filename = '../../../sys/class/class.'. strtolower($class_name) . '.inc.php';     
	if ( file_exists($filename) ){         
		include_once $filename;     
	} 
} 
?>