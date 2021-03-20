<?php 
    include('config/database.php');
    include('config/Sendsms.php');
    include('alert.php');
    $show="false";
    function otpview($status){
        if($status=="true"){
           global $show;
           $show="true"; 
        }            
    }
    if(isset($_POST['Forgot_sub'])){
        $Check_phone = $con->prepare("SELECT Police_email,Police_Phone FROM police WHERE Police_Phone=?");
        $phone=$_POST['PhoneNo'];
        $Check_phone->bind_param("i",$phone);
        $Check_phone->execute();
        $Check_phone->bind_result($Victim_email,$Victim_Phoneno);
        $Check_phone->store_result();
        $Check_phone->fetch();
        // echo $Check_phone->num_rows; 
        if($Check_phone->num_rows > 0){
            $generatedotp = rand(000000, 999999);
            // echo"generated otp : ".$generatedotp;
            $phone1=substr($phone,0,5);
            $phone2=substr($phone,5,10);
            $hashgeneratedotp = hash('sha1',"$phone1$generatedotp$phone2");
            // echo $hashgeneratedotp;
            $cookie_name = "crime_report";
            $cookie_value = $hashgeneratedotp.",".$phone.",".$Victim_email;
            setcookie($cookie_name, $cookie_value, time() + (350 * 1), "/");
            $msg="Your OTP for password reset is : ".$generatedotp;
            send_sms($msg,$phone);
            otpview("true");
        }else{
            alert("Invalid Phone Number !!!");
            otpview("false");
        }
    }

    if(isset($_POST['subotp'])){
		$user_data=explode(",",$_COOKIE["crime_report"]);
		$otp=$_POST['OTP'];
		$hashgeneratedotp=$user_data['0'];
		$phone1=substr($user_data['1'],0,5);
		$phone2=substr($user_data['1'],5,10);
		$USEROTP=hash('sha1',"$phone1$otp$phone2");
		// echo $USEROTP;
		if($hashgeneratedotp==$USEROTP){
            $show="reset";
			// password_reset();
		}else{
            $show="true";
			alert("Invalid OTP !!!!");
			
		}
    }
    
    if(isset($_POST['reset'])){
        if($_POST['pass']==$_POST['confirmpass']){
          $confirmpass=$_POST['confirmpass'];
          $user_data=explode(",",$_COOKIE["crime_report"]);
          $phone=$user_data['1'];
          $email=$user_data['2'];
          $pass_enc=hash('sha1',"$phone$confirmpass$email");
                $query="UPDATE police SET Police_password = ? WHERE Police_Phone = ?";
                $userdata = $con->prepare($query);
                $userdata->bind_param("si",$pass_enc,$phone);
                if($userdata->execute()){
                    alert("Password Reset Successfully !!!!!!!!");
                    echo "<script>window.location.href='crime_admin_panel.php'</script>";
                }else{
                    alert("Failed to Reset Password !!!!");
                    // echo $userdata->error;
                }
        }else{
                $show="reset";
                alert("Password mismatch !!!");
          
        }
	  }
?>

<head>
    <link rel="stylesheet" type = "text/css" href = "media/css/main/otp_modal.css"/>
   
</head>
<button id="myBtn" style="display:none;"></button>

<!-- The Modal -->
<div id="myModal" class="modal" style="display: block;">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Forgot Password</h2>
        <?php 
            if($show=="reset"){ ?>
            <div class="container" id="resetpass">
                <form action="admin_forgotpass.php" method="post" style="border:1px solid #ccc">
                    <label><b>Reset Password</b></label>
                    <input type="password" placeholder="Enter Password" name="pass" required>
                    <input type="password" placeholder="Repeat Password" name="confirmpass" required>
                    <div class="clearfix">
                        <input type="submit" class="signupbtn" name="reset" value="Reset">
                    </div>
                </form>
            </div>  
        <?php } 
            elseif($show=="true"){
        ?>
        <div class="container" id="enterotp">
            <form action="admin_forgotpass.php" method="post" style="border:1px solid #ccc"><label><b>Enter OTP</b></label>
                <input type="tel" pattern="[0-9]{6}" placeholder="Enter 6 Digit OTP" name="OTP" required>
                <div class="clearfix">
                    <input type="submit" class="signupbtn" name="subotp" value="Submit OTP">
                </div>
            </form>
        </div>
        <?php } elseif("false"){ ?>
        <div class="container" id="enterphone">
            <form action="admin_forgotpass.php" method="post" style="border:1px solid #ccc">
                <label><b>Phone Number</b></label>
                <input type="tel" pattern="[0-9]{10}" placeholder="Enter Phone Number" name="PhoneNo" required>
                <div class="clearfix">
                    <input type="submit" class="signupbtn" name="Forgot_sub" value="Get OTP">
                </div>
            </form>
        </div>   

        <?php } ?>
  </div>

</div>
<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
    modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        window.location.href="crime_admin_panel.php";
    }

</script>
