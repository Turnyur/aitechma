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
    <h3>Registration Successful!</h3>

<div class="form-container" id="login-content">&nbsp;
	 <p>Congrats, <strong><?=$_GET['user']; ?></strong>! Your details has been successfully logged into our database</p>
</div>
  
  
  </div>
</div>

</section>










<?php

include 'assets/common/footer.inc.php';
?>