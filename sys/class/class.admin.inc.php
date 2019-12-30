<?php

class Admin extends DB_Connect { 

	private $_saltLength = 7; 

	public function __construct($db=NULL, $saltLength=NULL){         
		parent::__construct($db); 
		if ( is_int($saltLength)){             
			$this->_saltLength = $saltLength;         
		}     
	} 




private function make_seed()
{
  list($usec, $sec) = explode(' ', microtime());
  return $sec + $usec * 1000000;
}

private function generateUserPIN()
{
    mt_srand($this->make_seed());
    $randval = mt_rand();

    $pin_factory=mt_rand().$randval;
    $customer_pin=substr($pin_factory,1,10);

    return $customer_pin;
}

public function processRegister($data){
   if ( $data->action!='register_user'){            
        return "Invalid action supplied for processRegister.";         
    }

        $pin = $this->generateUserPIN();
        $username = htmlentities($data->username, ENT_QUOTES);      
        $phone = htmlentities($data->phone, ENT_QUOTES);       
        $email = htmlentities($data->email, ENT_QUOTES);
        $created_at = date('Y-m-d H:s:i');


       

$sql="INSERT INTO `users`( `pin`, `username`, `phone`, `email`, `created_at`) VALUES (:pin, :username, :phone, :email, :created_at)";


       try {
            $stmt=$this->db->prepare($sql);

            $stmt->bindParam(':pin',$pin,PDO::PARAM_STR);
            $stmt->bindParam(':username',$username,PDO::PARAM_STR);
            $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
            $stmt->bindParam(':email',$email,PDO::PARAM_STR);
            $stmt->bindParam(':created_at',$created_at,PDO::PARAM_STR);
      
            $query_status=$stmt->execute();
          
     // echo var_dump($stmt);
            if ($query_status==true) {
               
                   $m_to = $email;
                   $m_subject = "Successful Registration";
                   $m_from = "no-reply@aitechma.faritetech.com";
                   $m_pin = $pin;
                 $this-> _sendEmail($m_to, $m_subject, $m_from,$m_pin,$data->username);
                 return $pin;
            }else{
                return FALSE;
            }

            $stmt->closeCursor();

           
        } catch (Exception $e) {
            die ( $e->getMessage() );   


}


}

public function getUserDetails($post_data){

return $this->_getUserDetails($post_data);
}

private function _getUserDetails($post_data){

 /*          
        * Escapes the user input for security          
        */         
        $pin = htmlentities($post_data->pin, ENT_QUOTES);         

        /*          
        * Retrieves the matching info from the DB if it exists          
        */         
        $sql = "SELECT `id`, `pin`, `username`, `phone`, `email`, `created_at` FROM `users` WHERE `pin`= :pin LIMIT 1";         

        try{             
            $stmt = $this->db->prepare($sql);             
            $stmt->bindParam(':pin', $pin, PDO::PARAM_STR);             
            $stmt->execute();             
            //$user = array_shift($stmt->fetchAll());  
            $result=  $stmt->fetch(PDO::FETCH_ASSOC);  
           
            $stmt->closeCursor();   


            if ($result) {
              
               return $result;       
            }else{
                return false;
            }      
        }catch ( Exception $e ) {            
            die ( $e->getMessage() );         

        } 



}

private function _sendEmail($m_to, $m_subject, $m_from,$m_pin,$username){
    $to = $m_to;
    $subject = $m_subject;
    $from = $m_from;
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$m_from."\r\n".
    'Reply-To: '.$m_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><body style="color:#888888;">';
$message .= '<h4 style="color:#665544;">Dear, '. $username.'</h4>';
$message .= '<p>Your registration was successful.<br> ';
$message .='<span style="color:#1883D7;"> <strong>PIN: '.$m_pin.'</strong></span>';
$message .='<br> Login URL: https://aitechma.faritetech.com/find-user';
$message .= '</body></html>';
 
// Sending email
/*if(mail($to, $subject, $message, $headers)){
    echo 'Your mail has been sent successfully.';
} else{
    echo 'Unable to send email. Please try again.';
}*/

//echo $message;
mail($to, $subject, $message, $headers);
}




 


} 




?>