<?php
	session_start();
	include('config/database.php');
	// include('config/Sendsms.php');
	include('alert.php');
	if(isset($_SESSION["Admin_Login"])){
    	header("Location: AdminHome.php");
    }
    // $clem_Phone="8108740530";
    // $pass="Clemen123@";
	if(isset($_POST["admin_sub"])){
		$PhoneNo=$_POST["PhoneNo"];
		$password=$_POST["pass"];
		if(!empty($PhoneNo) && !empty($password)){
			$userlogin = $con->prepare("SELECT Police_id,Police_email,Police_password FROM police WHERE Police_Phone=?");
	                    $userlogin->bind_param("i",$PhoneNo);
	                    $userlogin->execute();
	                    $userlogin->bind_result($Police_id,$Police_email,$Police_password);
	                    $userlogin->store_result();
	                    if($userlogin->num_rows > 0){
	                        $userlogin->fetch();
	                       
	                        $hashpass=hash('sha1',"$PhoneNo$password$Police_email");
	                        if($Police_password==$hashpass){
	                        	$_SESSION["Admin_Login"] = "true";
	                        	$_SESSION["Admin_id"]=$Police_id;
	                            // alert("Login Successfull !!!");

	                            header("Location: AdminHome.php");
	                        }else{
	                            alert("Invalid Phone number or password !!!");
	                        }
	                    }
		}else{
			alert("Plz Enter Phone and Password !!!!!!!!!!!");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
  	h1,label{
  		color: white;
  	}
  	.col-xs-6{
  		margin-left: 20px;
  	}
  	 #login .container #login-row #login-column #login-box {
	  margin-top: 90px;
	  max-width: 600px;
	  height: 320px;
	  border: 1px solid #9C9C9C;
	  background-color: #EAEAEA;
  }
    #login .container #login-row #login-column #login-box #login-form {
	  padding: 20px;
	}
	#login .container #login-row #login-column #login-box #login-form #register-link {
	  margin-top: -85px;
	}
  </style>
</head>
<body style="background-color: #770000;">
	<div class="container"> 
              <h1 style="color: white; font-size: 50px;">Online Crime Reporting</h1>      
    </div><br>
    <!-- background-image: url('media/images/crime4.jpg'); background-size: 1170px 460px;"  
	for container
    -->
    <div class="container" style="border:5px solid white; padding: 25px 20px 25px 50px;">
    		<div id="login-row" class="row">
                <img src="media/images/police1.png" class="pull-left" width="350" height="400"/><br><br>
                <div id="login-column" class="col-xs-6" >
                    <div id="login-box" class="col-md-15">
                        <form id="login-form" class="form" action="" method="post">
				    		<form method="post" action="">
				    			<h1 class="text-center">Login</h1>
	                            <div class="form-group">
	                                <label for="username">Phone Number:</label><br>
	                                <input type="tel" pattern="[0-9]{10}" name="PhoneNo" id="PhoneNo" class="form-control" required="" autofocus="">
	                            </div>
	                            <div class="form-group">
	                                <label for="password">Password:</label><br>
	                                <input type="password" name="pass" id="password" class="form-control" required="" autofocus="">
	                            </div>
	                            <div class="form-group">
	                                <!-- <label for="remember-me" class="text-info"><span>Remember me</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br> -->
	                                <div class="text-center">
									<a href="admin_forgotpass.php">Forgot Password</a>
	                                </div><br>
	                                <div class="text-center">
	                                	<input type="submit" name="admin_sub" class="btn btn-info btn-md" value="Login">	
	                                </div>
	                                
	                                
								</div>
								
								

				    		</form>
				    	</div>
				    </div>
				</div>
	</div>
 
</body>