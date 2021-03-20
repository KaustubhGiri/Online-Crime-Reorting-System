<?php 
    include('config/database.php');
    include('config/Sendsms.php');
    include('alert.php');
    if(isset($_POST['login'])){
        header('location:Login.php');
    }
    $otp="";
    
    
    function check_inputs($Fullname,$email,$phone,$pass1,$pass2){
        if (preg_match('/^[a-zA-Z ]*$/',$Fullname)){ 
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                if(preg_match('/^\d{10,10}$/',$phone)){
                    if(preg_match('/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',$pass1,$pass2)){
                        return True;
                    }else{
                        alert("Password not satisfying criteria !!!");
                        return False;
                    }
                }else{
                    alert("Phone Number Incorrect !!!");
                    return False;
                }
            }else{
                alert("Email Format Incorrect !!!");
                return False;
            }
        }
        else{
            alert("Full Name must contain only Characters !!!");
            return False;
            
            // error_msg("Only Characters Allowed !!!!");
        }
    }

    function setotp(){
        ?> 
        <head>
            <link rel="stylesheet" type = "text/css" href = "media/css/main/otp_modal.css"/>
        </head>
        <div id="myModal" class="modal" style="display: block; background-color:grey;">

          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
                <form action="signup.php" method="post" style="border:1px solid #ccc"><label><b>Enter OTP</b></label>
                    <input type="tel" pattern="[0-9]{6}" placeholder="Enter 6 Digit OTP" name="otp" required>
                    <div class="clearfix">
                        <input type="submit" class="signupbtn" name="subotp" value="Submit OTP">
                    </div>
                </form>
          </div>
        </div>
                <!-- <form action="" class="form-otp" method="POST" style="display: block;">
                    <input type="tel" pattern="[0-9]{6}" id="otp" class="form-control" name="otp" placeholder="Enter The OTP" required="" autofocus="">
                    <button name="subotp" class="btn btn-md btn-block submit" type="submit"><i class="fas fa-user-plus"></i>Submit</button>
                </form> -->

                <?php
    }

    if(isset($_POST['signup'])){
        // alert("inside if");

        $Fullname=$_POST['Fullname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $pass1=$_POST['pass'];
        $pass2=$_POST['confirmpass'];
        
        if(check_inputs($Fullname,$email,$phone,$pass1,$pass2)){
            $Check_phone = $con->prepare("SELECT Victim_email,Victim_Phoneno FROM victim WHERE Victim_Phoneno=? and Victim_email=?");
            $Check_phone->bind_param("is",$phone,$email);
            $Check_phone->execute();
            $Check_phone->bind_result($Victim_email,$Victim_pass);
            $Check_phone->store_result();
            // echo "rows : ".$Check_phone->num_rows;
            if($Check_phone->num_rows > 0){
                alert("Email and Phone Number used !!!");
            }else{
               if($pass1==$pass2){
                $otp = rand(100000, 999999);

                $hashotp=hash('sha1',"$phone$otp$email");
                // $_SESSION['session_otp']=$otp;
                // echo $hashotp; 
                $cookie_name = "crimereport";
                $cookie_value = $hashotp.",".$Fullname.",".$email.",".$phone.",".$pass2;
                setcookie($cookie_name, $cookie_value, time() + (350 * 1), "/"); // 
                
                $msg="YOUR OTP FOR CRIME REPORT REGISTRATION IS : ".$otp;   
                send_sms($msg,$phone); 
                setotp();

                }else{
                    alert("Password mismatch");
                }
            }    

            
        }
    }

    if(isset($_POST['subotp'])){
        // echo"inside isset";
        $victimid="";
        $userotp=$_POST['otp'];
        // echo "USER OTP".$userotp;
        $user_info=explode(",",$_COOKIE["crimereport"]);
        $otp=$user_info[0];
        $Fullname=$user_info[1];
        $email=$user_info[2];
        $phone=$user_info[3];
        $pass2=$user_info[4];
        if(hash('sha1',"$phone$userotp$email")==$otp){
            $salt1=$phone;
            $salt2=$email;
            $pass_enc=hash('sha1', "$salt1$pass2$salt2");
            $query="INSERT INTO victim VALUES (?,?,?,?,?)";
            $userdata = $con->prepare($query);
            $userdata->bind_param("isiss",$victimid,$email,$phone,$pass_enc,$Fullname);
            if($userdata->execute()){
                alert("Registered Successfull !!!!!!!!");
            }else{
                alert("Failed to Register");
                 echo $userdata->error;
            }
              
        }else{
            alert("Invalid Otp !!!!!");
        }
    }
 

?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<style type="text/css">
body{
  height: 100vh;
  background-color:#9400D3;
}
h2{
  font-size: 46px;
  font-style: italic;
  margin-left: 100px;
  margin-top: 200px;
  margin-bottom: 200px;
  width:75%;
  color: white;
  margin-right: 0;
}

form{
  background-color: white;
  margin-top: 70px;
  width: 100%;
  margin-left: 5px;
  margin-right: 40px;
}
.input-container {
  display: -ms-flexbox; 
  display: flex;
  width: 100%;
  margin-top: 1em;
  margin-bottom: 15px;
  padding-left: 5em;
}

.flex-container {
  display: flex;
}
.icon {
  padding: 10px;
  background: #1A1A1A;
  color: white;
  min-width: 40px;
  text-align: center;
}

.input-field {
  width: 55%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}

/* Set a style for the submit button */
#signbtn{
  background-color: #1A1A1A;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 29.5%;
  opacity: 0.9;
  margin-bottom: 20px;
}

#signbtn:hover {
  opacity: 1;
}

@media only screen and (max-width: 680px) {
  h2{
    /* font-size: 36px; */
    font-style: italic;
    margin-left: 45px;
    margin-top: 10px;
    margin-bottom: 5px;
    margin-right:40px;
    width:70%;
    color: white;
   
  }

form{
  background-color: white;
  margin-top: 40px;
  width: 386px;
  margin-left: 60px;
  margin-right: 20px;
  margin-bottom:40px;
}

.flex-container {
  display: flex;
  flex-direction: column;
 
}


.icon {
  padding: 10px;
  background: #1A1A1A;
  color: white;
  min-width: 40px;
  text-align: center;
}

.input-field {
  width: 55%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid dodgerblue;
}
}


@media only screen and (min-width: 681px) and (max-width: 1260px){
    h2{
      /* font-size: 40px; */
      font-style: italic;
      margin-left: 20px;
      margin-top: 20px;
      margin-bottom: 5px;
      margin-right:15px;
      width:60%;
      color: white;
    
    }

    form{
      /*max-width:540px;*/ 
      background-color: white;
      margin-top: 20px;
      width: 386px;
      margin-left: 10px;
      margin-right: 30px;
    }

   
}




</style>
<script type="text/javascript">
    // Get the modal
    var modal = document.getElementById("myModal");

    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

   

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        window.location.href="signup.php";
    }


  function validate_reg_form(){
      var full_name,phno,email,pass,confirmpass,atposition,dotposition,pattern;
      full_name=document.reg_form.Fullname.value;
      phno=document.reg_form.phone.value;
      email=document.reg_form.email.value;
      pass=document.reg_form.pass.value;
      confirmpass=document.reg_form.confirmpass.value;
      atposition=email.indexOf("@");  
      dotposition=email.lastIndexOf(".");
      pattern=/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
      if(full_name==null || full_name==""){  
        alert("Fullname can't be blank !!"); 
        return false; 
      }else if(isNaN(phno) || phno.length!=10){
        alert("Phone Number should be in proper format !!!"); 
        return false; 
      }
      else if (atposition<1 || dotposition<atposition+2 || dotposition+2>=email.length){  
        alert("Please enter a valid e-mail address !!!");
        return false;  
      }  
      else if(pass!=confirmpass){
        alert("Password Mismatch !!!");
        return false;
      }else if(!pattern.test(confirmpass)){
        alert("Password must be at least 8 characters long and should contain : \n1.One Uppercase letter \n2.One lowercase letter \n3.One Numerical Value \n4.One Special Symbol.");
        return false;
      }
  }
</script>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="flex-container">
          <div style="width:840px; font-size:5vw; ">
              <h2>ONLINE CRIME REPORTING SYSTEM</h2>  
          </div>        
      <div>
     <!--  <form action="signup.php" method="post" name="reg_form" onsubmit="return validate_reg_form();"> -->
      <form action="signup.php" method="post" name="reg_form">
      <center><h3 style="color:black; font-size: 30px; font-weight: bold; padding-top:20px;">REGISTER<hr width="90%"></h3></center>
      
      <div class="input-container">
        <i class="fa fa-user icon"></i>
        <input class="input-field" type="text" placeholder="Full Name" name="Fullname">
      </div>

      <div class="input-container">
        <i class="fa fa-phone icon"></i>
        <input class="input-field" type="tel" placeholder="Contact no." name="phone">
      </div>

      <div class="input-container">
        <i class="fa fa-envelope icon"></i>
        <input class="input-field" type="text" placeholder="Email" name="email">
      </div>

      <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Password" name="pass">
      </div>
      
      <div class="input-container">
        <i class="fa fa-key icon"></i>
        <input class="input-field" type="password" placeholder="Confirm Password" name="confirmpass">
      </div>

      <center>
        <button type="submit" name="signup" class="btn" id="signbtn">Register</button>
        <div style="font-size: 18px; ">Already a User ? <a style="color: black;" href="Login.php">Login</a>
        </div>
      </center><br>
    </form>         
      </div>
       

          
</div>

</body>
</html>
