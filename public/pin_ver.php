<?php

include_once '../sys/core/init.inc.php'; 

$css_files=array('main.css','nav.css');
$page_title = "Aitechma Test |Find User via PIN"; 
include 'assets/common/header.inc.php';

?>




<main>
	<!-- Home Section -->





	<!-- Services Section -->
<section class="services">
	<!-- <h4>Register</h4> -->
	<div class="hero-image-services">
  <div class="hero-text">
    <h3>Please Enter Your 10-Digit PIN To Continue</h3>

<div class="form-container" id="login-content">&nbsp;
	  <form method="POST" action="/process-form" >
    	<div class="form-group">
    		<input id="pin" type="text" name="pin" placeholder="Enter PIN">
    	</div>

    	

    	<div class="form-group">
    		  <input id="find_user_btn" type="submit" name="" value="Continue">
    
    	</div>

        <input id="action" type="hidden" name="action" value="find_user">
         <input id="_token" type="hidden" name="_token" value="<?=$_SESSION['token']; ?>">
    </form>
</div>
  
  
  </div>
</div>

</section>



 <script src="assets/js/aitechma.js"></script>






<?php

include 'assets/common/footer.inc.php';
?>