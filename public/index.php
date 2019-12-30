<?php

include_once '../sys/core/init.inc.php'; 

$css_files=array('main.css','nav.css');
$page_title = "Aitechma Test"; 
include 'assets/common/header.inc.php';

?>




<main>
	<!-- Home Section -->





	<!-- Services Section -->
<section class="services">
	<!-- <h4>Register</h4> -->
	<div class="hero-image-services">
  <div class="hero-text">
    <h3>Complete The Form Below</h3>

<div class="form-container" id="login-content">&nbsp;
	  <form method="POST" action="/process-form" >
    	<div class="form-group">
    		<input id="username" type="text" name="username" placeholder="Username">
    	</div>

    	<div class="form-group">
    		<input id="phone" type="text" name="phone" placeholder="Mobile Phone">
    	</div>

    	<div class="form-group">
    		<input id="email" type="text" name="email" placeholder="Email">
    	</div>

    	<div class="form-group">
    		  <input type="submit" id="register_user_btn" name="" value="Submit" >
    
    	</div>




    	<input id="action" type="hidden" name="action" value="register_user">
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