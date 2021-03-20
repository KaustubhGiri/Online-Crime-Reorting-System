<?php
  session_start();
  include('config/database.php');
  include('config/Sendsms.php');
  include('alert.php');
  if(isset($_SESSION["Login"])){
    header("Location: Home.php");
  }
  if(isset($_POST['Login_sub'])){
             
              $user_pass="";
              $phoneno=$_POST['PhoneNo'];
              $pass=$_POST['pass'];
              if(preg_match('/^\d{10,10}$/',$phoneno)){
                  if(preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',$pass)){
                      $userlogin = $con->prepare("SELECT Victim_id,Victim_email,Victim_pass FROM victim WHERE Victim_Phoneno=?");
                      $userlogin->bind_param("i",$phoneno);
                      $userlogin->execute();
                      $userlogin->bind_result($Victim_id,$Victim_email,$Victim_pass);
                      $userlogin->store_result();
                      
                      if($userlogin->num_rows > 0){
                           
                          $userlogin->fetch();
                          $hashpass=hash('sha1',"$phoneno$pass$Victim_email");
                          if($Victim_pass==$hashpass){
                            $_SESSION["Login"] = "true";
                            $_SESSION["User_id"] = $Victim_id;
                            $_SESSION["Phone"]=$phoneno;
                              header("Location: Home.php");
                          }else{
                              alert("Invalid Phone number or password !!!");
                          }
                      }else{
                          alert("Invalid user !!!!!!");
                      }
                  }else{
                      alert("Invalid Credentials");
                  }

              }else{
                  alert("Plz Provide Proper Input !!!!!!");
              }
      }
        
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link rel="stylesheet" href="media/css/main/login.css" />

<script type="text/javascript">
  function validateform(){
  var phno=document.login_form.PhoneNo.value;  
  var password=document.login_form.pass.value;  
  var pattern=/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  if(isNaN(phno) || phno.length!=10){  
    alert("Plz Provide proper Phone no !!!!");  
    return false;  
  }else if(!pattern.test(password)){  
    alert("Password must be at least 8 characters long and should contain : \n1.One Uppercase letter \n2.One lowercase letter \n3.One Numerical Value \n4.One Special Symbol.");  
    return false;  
  }  
  
  }

  function forgot_pass(){
    window.location.href="https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_popup";
   
  }

</script>

</head>
<body>
  <?php include('navbar.php'); ?>

  <div class="bg">
    <form action="Login.php" method="post" name="login_form" style="max-width:500px;" onsubmit="return validateform();">
        <center><i class='fas fa-user-circle' id="faceicon"></i></center>
        <div class="input-container">
          <i class="fa fa-user icon"></i>
          <input class="input-field" type="tel" pattern="[0-9]{10}" placeholder="Phone Number" name="PhoneNo">
        </div>
        
        <div class="input-container">
          <i class="fa fa-key icon"></i>
          <input class="input-field" type="password" placeholder="Password" name="pass">
        </div>

        <button type="submit" name="Login_sub" class="btn" id="logbut">Login</button>
        <div style="text-align: center; font-size: 18px; "><a style="color: white;" href="forgot_pass.php" >Forget Password</a><br><br>
          <a style="color: white;" href="signup.php">Create Account</a>
        </div>
    </form>
  </div>
</body>
</html>
