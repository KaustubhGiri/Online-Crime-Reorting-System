<?php
session_start();
include('config/database.php');
include('alert.php');

if (!isset($_SESSION["Login"])){
    header("Location: Login.php");
}
if (isset($_POST["logout"])){ 
	//session_destroy();
	unset($_SESSION["Login"]);
	header("Location: Login.php");
}
					
?>
	<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
  <style type="text/css">
  	a:hover{
      color : blue;
  }
  a{
    color:#770000; 
    font-size: 20px;
  }
  h2{
    color: white;
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
<body style="background-color: #770000;" onload="hide_div();">

	<script>
		function hide_div(){
			
			document.getElementById("divothers").style.display="none";
			document.getElementById("images").style.display="none";
			document.getElementById("videos").style.display="none";	
		}
	
		  
		function casetype(){
			var val=document.getElementById("type").value;
			console.log(val);
			var divothers=document.getElementById("divothers");
			if(val == 6){
				divothers.style.display="";
				divothers.setAttribute("required","");
				
			}else{
				divothers.style.display="none";
			}
		}  

		function proof_type(){
			var prof_type=document.getElementById("Proof").value;
			if(prof_type==1){
				document.getElementById("videos").style.display="none";
				document.getElementById("images").style.display="";
			}else if(prof_type==2){
				document.getElementById("images").style.display="none";
				document.getElementById("videos").style.display="";
			}else if(prof_type==3){
				document.getElementById("images").style.display="";
				document.getElementById("videos").style.display="";
			}
			
		}
		

	  	$(document).ready(function(){
	  		// alert();
	  		var query="";
			load_data(query);
			$('#Searchinput').keyup(function(){
			var value=$(this).val();
			// console.log(value);
			if(value != ''){
				$('#casetable').html('');
				   load_data(value);
			}else{
				// alert("hello");
				  load_data(query);
			}
			});
		});
									
									
		function load_data(query){
			var userid = $("#userid").val();
			var user="normal";
			//alert(userid);
			  $.ajax({
			   url:"fetchcases.php",
			   method:"POST",
			   data:{query:query,userid:userid,from:user},
			   success:function(data)
			   {
			    $('#casetable').html(data);
			    
			   }
			  });
		 }
		
	  
		
	</script>

	<div class="container"> 
              <h1 style="color: white; font-size: 50px;">Online Crime Reporting</h1>      
    </div><br>
    <div class="container">
        <div class="row">
        	<input type="hidden" id="userid" value="<?php echo $_SESSION["User_id"]?>">
          <div class=”col-xs-6 col-md-4”>
            <ul class="nav nav-tabs nav-justified" style="background-color: white;">
              <li class="active"><a data-toggle="tab" href="#home">HOME</a></li>
              <li><a data-toggle="tab" href="#Complaint" >FILE CASE</a></li>
              <li><a data-toggle="tab" href="#mycases" >MY CASES</a></li>
              <li><a data-toggle="tab" href="#changepasswd">PASSWORD</a></li>
              <li><center><form method="post"><input type="submit" class="btn btn-primary" name="logout" value="LOGOUT" /></form></center></li>
            </ul> 
          </div> 
        </div>
      </div><br>	


    <div class="container" style="border:5px solid white;">
	 	<div class="tab-content">
	 		<div id="home" class="tab-pane fade in active">

	 			<div class="row">
	 				<img src="media/images/crime2.jpg" width="100%" height="400">
	 				<div class=”col-xs-6 col-md-4”>
		            	<ul class="nav nav-tabs nav-justified" style="background-color: white;">
			              <li class="active"><a data-toggle="tab" href="#Missing">Missing</a></li>
			              <li><a data-toggle="tab" href="#News" >News</a></li>
			              <li><a data-toggle="tab" href="#MostWanted" >MOST WANTED</a></li>
			              
		            	</ul> 
		          	</div> 
	 			</div>

	 			<div class="tab-content">
	 				<div id="Missing" class="tab-pane fade in active" style="padding-top:20px;">
	 					<?php include('Missing.php'); ?>
	 				</div>

	 				<div id="News" class="tab-pane fade" style="padding-top:20px;">
	 					<?php include('noticelist.php'); ?>
	 				</div>

	 				<div id="MostWanted" class="tab-pane fade" style="padding-top:20px;">
	 					<?php include('Most_wanted_list.php'); ?>
	 				</div>
	 			</div>

	 		</div>

		
	 		<div id="Complaint" class="tab-pane fade">
	 			<div class="row">
	 				<img src="media/images/crime3.png" width="100%" height="400">
	 			</div>
	 			
	 			<div class="row" style="background-color: #EAEAEA;">
	 			<div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="FileCase.php" method="post" enctype="multipart/form-data">
                            <h3 class="text-center text-info">Register Case</h3>
                             	
	                            <div class="form-group">
	                                <label for="title" class="text-info">Case Title:</label><br>
	                                <input type="text" name="c_title" id="c_title" class="form-control" required="" autofocus="">
	                            </div>

	                            <div class="form-group">
	                                <label for="type" class="text-info">Case Type:</label><br>
	                                <div class="form-group">
      									<select name="type" class="form-control" id="type" onclick="casetype();">
      										<option >Select</option>
									        <option value="1" id="Murder">Murder</option>
									        <option value="2" id="Missing">Missing</option>
									        <option value="3" id="CyberCrime">Cyber Crime</option>
									        <option value="4" id="ChildAbuse">Child Abuse</option>
									        <option value="5" id="Robbery">Robbery</option>
									        <option value="6" id="others">Others</option>
									    </select> 
									</div>
								</div>
								
								<div class="form-group" id="divothers">
	                                <label class='text-info'>Specify Case Type : </label><br>
	                                <input type='text' name='others' id='c_others' class='form-control'>
	                            </div>
	                            
	                            <div class="form-group">
	                                <label for="Description" class="text-info">Case Description:</label><br>
	                                <textarea class="form-control" name="C_description" rows="4" required="" autofocus=""></textarea>
	                            </div>

	                            <div class="form-group">
	                                <label for="Address" class="text-info">Case Address:</label><br>
	                                <textarea class="form-control" name="C_address" rows="4" required="" autofocus=""></textarea>
	                            </div>

	                            <div class="form-group">
	                                <label for="type" class="text-info">Proof Type:</label><br>
	                                <div class="form-group">
      									<select name="Proof" class="form-control" id="Proof" onclick="proof_type()">
      										<option >Select</option>
									        <option value="1" id="img">Image</option>
									        <option value="2" id="vid">Video</option>
									        <option value="3" id="both">Both</option>
									        
									    </select> 
									</div>
								</div>

	                            
	                            <div class="form-group" id="images" style="display:none;">
	                            	<div class='form-group'>
	                            			<label class='text-info'>Choose Images</label>
	                            			<input type='file' name='image1' class='custom-file-input' id='inputGroupFile01'>
	                            			<input type='file' name='image2'class='custom-file-input' id='inputGroupFile02'>
	                            		
	                            	</div>
	                            </div>

								<div class="form-group" id="videos" style="display:none;">
									<div class='form-group'><label class='text-info'>Choose Video</label>
										<input type='file' name='video' class='custom-file-input' id='inputVideoFile'>
									</div>
	                            </div>

	                            <div class="form-group">
	                                <div class="text-center">
	                                    <input type="submit" name="submitcase" class="btn btn-info btn-md" value="Submit">
	                                </div>
	                            </div> 
                        	</form>
                    	</div>
                	</div>

					<div id="login-column" class="col-md-6">
		 				<h2 class="text-center text-info">Instructions</h2><br><br>
						 <h2 class="text-info">1) Select the Case type or you can also specify your own</h2><br><br>
						<h2 class="text-info">2) Image Size must be less than or equal to 1 MB.</h2><br><br>
						<h2 class="text-info">3) Video Size must be less than or equal to 5 MB.</h2><br><br>
					</div>
	 				</div>
	 				</div>
			</div>

			<div id="mycases" class="tab-pane fade">
				<h3 class="text-info" style="font-size: 25px; color:white;">Cases</h3>
				<div class="input-group">
				    <input type="text" class="form-control" id="Searchinput" placeholder="Enter Case Name">
				    <div class="input-group-btn">
				      <button class="btn btn-default" type="submit">
				        <i class="glyphicon glyphicon-search"></i>
				      </button>
				    </div>
				 </div><br>

	 			<div class="row" id="casetable" style="margin:5px;">
	 			</div>	

	 		</div>	
	 						
			<div id="Views" class="tab-pane fade">
	 			<br>
	 			<a  data-toggle="tab" href="#mycases"><button  class="btn btn-secondary">Go To Cases</button></a><br>
	 			<table class="table" id="casess">
		  			<tbody>
			    		
		  			</tbody>
				</table>
	 		</div>				        
	 		
	 		

	 		


	 		<div id="changepasswd" class="tab-pane fade">
	 			<div class="row">
	 				<div id="login-row" class="row justify-content-center align-items-center">
                		<div id="login-column" class="col-md-6">
                    		<div id="login-box" class="col-md-12">
				 				<form id="login-form" class="form" action="changepass.php" method="post">
			                            <h3 class="text-center text-info">Change Password</h3>
			                            <div class="form-group">
						                    <label for="password" class="text-info">Current Password:</label><br>
						                    <input type="password" name="oldpass" id="pass" class="form-control" required="" autofocus="">
					                	</div>
			                            <div class="form-group">
						                    <label for="password" class="text-info">New Password:</label><br>
						                    <input type="password" name="newpass" id="pass" class="form-control" required="" autofocus="">
					                	</div>
						                <div class="form-group">
						                    <label for="password" class="text-info">Confirm Password:</label><br>
						                    <input type="password" name="confirmnewpass" id="confirmpass" class="form-control" required="" autofocus="">
						                    <input type="hidden" name="cha" value="0">
						                </div>
						                <div class="form-group">
						                    <div class="text-center">
						                        <input type="submit" name="changepasswd" class="btn btn-info btn-md" value="Change Password">
						                    </div>
						                </div>
			                    </form>
			                </div>
			            </div>
			        </div>    
	 			</div>
	 		</div>

		</div>		
 	</div>
</body>
</html>




