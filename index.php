<?php 
  session_start();
  include('alert.php');
  if(isset($_SESSION["Login"])){
    header("Location: Home.php");
  }
?>


<!DOCTYPE html> 
<html> 
  
<head> 
  
    <title>OCR INDIA</title>
   
    <link rel="stylesheet" href="media/css/main/styles.css">

    <style>
     
    </style>
</head> 
  
<?php include('navbar.php'); ?>
<body>
 <div style="position: absolute; width:100%; height:100%;">
   <img  src="crime(1).jpg"  class="image1" >
   <img  src=" police.png"   class="image2" >
  
    <div class="text">       
          <h4>MAHARASHTRA POLICE DEPARTMENT</h4> 
          <h4>ONLINE CRIME</h4>
          <h4> REPORTING</h4>
          
         <a href="http://mahapolice.gov.in/">www.mahapolice.gov.in</a>

          <!-- <div class="button"> 
            <button type="button" onclick="window.location.href='Login.php'">Log in</button>
             <button type="button" onclick="window.location.href='signup.php'">Register</button>
             <button type="button" onclick="window.location.href='contactus.php'" class="but"> contact us  </button>
             <button type="button" onclick="window.location.href='aboutus.php'" class="butt">about us</button>
          


          </div> -->
    </div>
  </div> 
</body>

</html>