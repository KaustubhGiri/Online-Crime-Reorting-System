<?php
session_start();
include('config/database.php');
include('Add_admin.php'); 
include('add_notice.php'); 
include("mostwanted.php");

if (!isset($_SESSION["Admin_Login"])){ 
	header("Location: crime_admin_panel.php");
}
if (isset($_POST["logout"])){ 
	unset($_SESSION['Admin_Login']);      
	header("Location: crime_admin_panel.php");
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
  <!-- <link rel="stylesheet" type = "text/css" href = "media/css/login.css"/> -->
  <!-- <link rel="stylesheet" type = "text/css" href = "media/css/addadmin.css"/> -->
  <link rel="stylesheet" type = "text/css" href = "media/css/deletemodal.css"/>
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
  
 .card{
 	padding-left: 5rem;

 }	
 .card-title,.card-text{
 	color: white;
 }


 .form-group{
	margin:20px;
	transform: translate(0, -20px);
 }
 
 #sub{
    color: #fff;
    background-color: #c9302c;
    border-color: #ac2925;
 }
 
 #form{
     background-color:lightblue;
 }

 
  </style>
  <script>
  	var userid = '<?php echo $_SESSION["Admin_id"]; ?>';
  	var query="";
  	var table,cells,uid,xhttp;
  	$(document).ready(function(){
	  		
			// searchpolice="false";
			load_data(query);
			//usertable(query,searchpolice);
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
		
		//alert(userid);
		var user="admin";
		  $.ajax({
		   url:"fetchcases.php",
		   method:"POST",
		   data:{query:query,userid:userid,from:user},
		   success:function(data)
		   {
		    $('#casetable').html(data);
		    // alert(data);
		   }
		  });
	}

	function gotouser(){
		document.getElementById("search").style.display="";
		usertable(query);

	}

	function deletemodal(){
		document.getElementById("delete").style.display="block";
	}

	function deletepoliceuser(){
		var uid=document.getElementById("selectedid").textContent;
		xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		     var data=JSON.parse(this.responseText);
		     console.log(data);
		     if(data=="true"){
		     	alert('User Deleted Successfully !!!');
           	 	window.location.href='AdminHome.php';
		     }else{
		     	window.alert('Failed to Delete !!!');
           	 	window.location.href='AdminHome.php';
		     }
		     
		    }
		};
		xhttp.open("POST", "del_admin_notice.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("pnid="+uid+"&for=police");
    	
		document.getElementById("delete").style.display="none";

	}

	function viewUser(){
		document.getElementById("search").style.display="none";
		table = document.getElementById('tabpol');
    	cells = table.getElementsByTagName('td');
    	for (var i = 0; i < cells.length; i++) {
    		var cell = cells[i];
    		cell.onclick = function () {
    			var rowId = this.parentNode.rowIndex;
    			var rowSelected = table.getElementsByTagName('tr')[rowId];
    			uid=rowSelected.cells[0].innerHTML;
				var obj = {uuid: uid};
  				var uidobj = JSON.stringify(obj);
    			xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				     var data=JSON.parse(this.responseText);
				     document.getElementById("usertable").innerHTML = '<button onclick="gotouser()">Go To Users</button>'+data;
				     
				    }
				};
				xhttp.open("POST", "fetchadminuser.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("pid="+uidobj);
    		}
    	}
	}


	function notice(val){
		if(val=='add'){
			document.getElementById("notbut").style.display="none";
			document.getElementById("notice_list").style.display="none";
			document.getElementById("addnotice").style.display="";	
		}else{
			document.getElementById('addnotice').style.display="none";
			document.getElementById('notbut').style.display="";	
			document.getElementById("notice_list").style.display="";
		}
	}

	function mostwanted(val){
		if(val=='add'){
			document.getElementById("mostwanted").style.display="none";
			document.getElementById("mw_list").style.display="none";
			document.getElementById("addmw").style.display="";	
		}else{
			document.getElementById('addmw').style.display="none";
			document.getElementById('mostwanted').style.display="";	
			document.getElementById("mw_list").style.display="";
		}
	}

	function DeleteNotice(){
		table = document.getElementById('noticetab');
    	cells = table.getElementsByTagName('td');
    	for (var i = 0; i < cells.length; i++) {
    		var cell = cells[i];
    		cell.onclick = function () {
    			var rowId = this.parentNode.rowIndex;
    			var rowSelected = table.getElementsByTagName('tr')[rowId];
    			nid=rowSelected.cells[0].innerHTML;
    			xhttp = new XMLHttpRequest();
    		    xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				     var data=JSON.parse(this.responseText);
				        if(data=="true"){
					     	window.alert('Notice Deleted Successfully !!!');
			           	 	window.location.href='AdminHome.php';
					     }else{
					     	window.alert('Failed to Delete Notice!!!');
			           	 	window.location.href='AdminHome.php';
					     }
				    }
				};
				xhttp.open("POST", "del_admin_notice.php", true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send("pnid="+nid+"&for=notice");
    		}
    		
    	}

	}

	function searchuser(ele){
		var val=ele.value;  
		if(val != ''){
    		document.getElementById("usertable").innerHTML='';
	    	usertable(val);
		}
    	else{
			usertable(val);

		}
	}

	function noticetable(query){
		var obj = {snqry: query};
  		var qryobj = JSON.stringify(obj);
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			 var data=JSON.parse(this.responseText);
			 document.getElementById("noticetab").innerHTML = data;
		     
		    }
		};
		xhttp.open("POST", "searchnotice.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("query="+qryobj); 
		
	}


	function search_notice(ele){
		var val=ele.value; 
		console.log(val);
		if(val != ''){
    		document.getElementById("noticetab").innerHTML='';
	    	noticetable(val);
		}
    	else{
			noticetable(val);

		}
	}
	
	
  </script>
</head>
<body style="background-color: #770000;">

	<div class="container"> 
              <h1 style="color: white; font-size: 50px;">Online Crime Reporting</h1>      
    </div><br>

    <div class="container">
        <div class="row">
          <div class=”col-xs-6 col-md-4”>
            <ul class="nav nav-tabs nav-justified" style="background-color: white;">
              <li class="active"><a data-toggle="tab" href="#home">HOME</a></li>
              <li><a data-toggle="tab" href="#Cases">Manage Cases</a></li>
              <li><a data-toggle="tab" href="#updatealerts">Update Alerts</a></li>
              <li><a data-toggle="tab" href="#manageusers">Manage Users</a></li>
              <li><a data-toggle="tab" href="#changepasswd">Password</a></li>
              <li><center><form method="post"><input type="submit" class="btn btn-primary" name="logout" value="LOGOUT" /></form></center></li>
            </ul> 
          </div> 
        </div>
    </div><br>	


    <div class="container" style="border:5px solid white;">
	 	<div class="tab-content">
	 		<div id="home" class="tab-pane fade in active">
	 			<div class="row">
	 				<img src="media/images/crime2.jpg" id="adminhome" width="100%" height="400">
	 			</div><br>
	 			<div class="row" style="margin: 5px;">
	 				<h3 style="color:white; ">FeedBack</h3>
	 				<?php include('fetchfb.php'); ?>

	 			</div>
	 		</div>

	 		<div id="Cases" class="tab-pane fade">
	 			<div class="row">
	 				<img src="media/images/crime3.png" width="100%" height="400">
		 			<div class=”col-xs-6 col-md-4”>
			            	<ul class="nav nav-tabs nav-justified" style="background-color: white;">
				              <li class="active"><a data-toggle="tab" href="#New_cases">New cases</a></li>
				              <li><a data-toggle="tab" href="#Available_cases" >Available Cases</a></li>
				             
			            	</ul> 
			        </div> 
		        </div><br>
		       
		       	<div class="tab-content">
		       		
			        <div id="New_cases" class="tab-pane fade in active">
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
	 			 <!-- Cases Tabs -->
				 
					<div id="Available_cases" class="tab-pane fade">
						
						<div class="row" id="casetable" style="margin:5px;"> 
							<?php include('available_cases.php'); ?>
						</div>
					</div>

							
					

				</div>
			</div>

			<div id="Views" class="tab-pane fade">
	 			<br>
	 			<a  data-toggle="tab" href="#Cases"><button>Go To Cases</button></a><br>
	 			<table class="table" id="casess">
		  			<tbody>
			    		
		  			</tbody>
				</table>
	 		</div>	

			<div id="updatealerts" class="tab-pane fade"><br>
				<div class=”col-xs-6 col-md-4”>
	            	<ul class="nav nav-tabs nav-justified" style="background-color: white;">
		              <li class="active"><a data-toggle="tab" href="#manage_notice">Notice</a></li>
		              <li><a data-toggle="tab" href="#manage_mw">Most Wanted</a></li>
		              <li><a data-toggle="tab" href="#manage_missing">Manage Missing</a></li>
		              
	            	</ul> 
			    </div><br> 
				
				<div class="tab-content">
	 				<div id="manage_notice" class="tab-pane fade in active">
	 					<div class="input-group">
						    <input type="text" class="form-control" placeholder="Search Notice" onkeyup="search_notice(this);">
						    <div class="input-group-btn">
						      <button class="btn btn-default" type="submit">
						        <i class="glyphicon glyphicon-search"></i>
						      </button>
						    </div>
						 </div><br>
	 					<center><button type="button" onclick="notice('add');" id="notbut" class="btn btn-info">Add Notice</button></center><br>

	 					<div id="notice_list">
	 						<?php include("noticelist.php")?>
	 					</div>
	 					<div id="addnotice" style="display: none">
	 						<button onclick="notice()">View Notices</button>

	 						<form id="form" method="POST"><br>
	 							<div class="form-group">
				                    <label>Notice Name:</label><br>
				                    <input type="text" name="Nname" id="" class="form-control" required="" autofocus="">
				                </div>
				                <div class="form-group">
				                    <label>Notice Message:</label><br>
				                    <input type="text" name="Nmessage" id="" class="form-control" required="" autofocus="">
				                </div>
				                <div class="form-group" >
						            <input type="submit" id="sub" name="subnot" id="" class="form-control" value="Submit" required autofocus="" >
					            </div>
	 						</form>
	 					</div>
	 				</div>
	 				<div id="manage_mw" class="tab-pane fade">
	 					
	 					<center><button type="button" onclick="mostwanted('add')" id="mostwanted" class="btn btn-info">Add Most Wanted</button></center><br>

	 					<div id="mw_list">
	 							 
	 								<?php include('Most_wanted_list.php'); ?>
	 							
	 					</div>

	 					<div id="addmw" style="display: none">
	 						<button onclick="mostwanted()">View Most Wanted</button>

	 						<form id="form" method="POST" enctype="multipart/form-data"><br>
	 							<div class="form-group">
				                    <label>Criminal Name:</label><br>
				                    <input type="text" name="criminal_name" id="" class="form-control" required="" autofocus="">
				                </div>
				                <div class="form-group">
				                    <label>Criminal Description:</label><br>
				                    <input type="text" name="criminal_desc" id="" class="form-control" required="" autofocus="">
				                </div>
				                <div class="form-group">
					                    <label>Upload Criminal Picture:</label><br>
					                    <input type="file" name="criminal_pic" id="" class="form-control" required="" autofocus="">
					            </div>
				                <div class="form-group">
						            <input type="submit" id="sub" name="submw" id="" class="form-control" value="Submit" required autofocus="" >
					            </div>
	 						</form>
	 					</div>
	 				</div>
	 				<div id="manage_missing" class="tab-pane fade">
	 					<?php include('Missing.php')?>
	 				</div>
	 			</div> 
	 				
	 		</div>


	 		<div id="manageusers" class="tab-pane fade"><br>
	 			
	 			<div class=”col-xs-6 col-md-4”>
	            	<ul class="nav nav-tabs nav-justified" style="background-color: white;">
		              <li class="active"><a data-toggle="tab" href="#adduser">Add User</a></li>
		              <li><a data-toggle="tab" href="#deluser">Delete User</a></li>
		              
	            	</ul> 
			    </div> 
			    <div class="tab-content">
			    	<div id="adduser" class="tab-pane fade in active">
			    		
			    			<form style="background-color:lightblue;" id="form" method="POST" enctype="multipart/form-data"><br>
			    			<h3 class="text-center">Register Officer</h3>
						      
						      			<div class="form-group">
						                    <label class="">Full Name:</label><br>
						                    <input type="text" name="fullname" id="" class="form-control" required="" autofocus="">
					                	</div>
			                            <div class="form-group">
						                    <label class="">Contact Number:</label><br>

						                    <input type="tel" pattern="[0-9]{10}" name="phone" id="" class="form-control" required="" autofocus="">
					                	</div>
					                	<div class="form-group">
						                    <label class="">Email:</label><br>
						                    <input type="email" name="email" id="" class="form-control" required="" autofocus="">
					                	</div>

					                	<div class="form-group">
						                    <label class="">Police Area:</label><br>
						                    <input type="text" name="police_area" id="" class="form-control" required="" autofocus="">
					                	</div>
					                	<div class="form-group">
						                    <label class="">Police Designation:</label><br>
						                    <input type="text" name="police_designation" id="" class="form-control" required="" autofocus="">
					                	</div>
					                	<div class="form-group">
						                    <label class="text-info">Gender:</label><br>
						                    <select name="gender" id="" class="form-control" required="" autofocus="">
						                    	<option>Select</option>
						                    	<option value="M">Male</option>
						                    	<option value="F">Female</option>
						                	</select> 
					                	</div>
					                	<div class="form-group">
						                    <label class="">Upload Profile Picture:</label><br>
						                    <input type="file" name="profile_pic" id="" class="form-control" required="" autofocus="">
					                	</div>
					                	
					                	<div class="form-group">
						                    <label class="">Password:</label><br>
						                    <input type="password" name="pass1" id="" class="form-control" required="" autofocus="">
					                	</div>
					                	<div class="form-group">
						                    <label class="">Confirm Password:</label><br>
						                    <input type="password" name="pass2" id="" class="form-control" required="" autofocus="">
					                	</div>
					                	<div class="form-group">
						                    <input type="submit" id="sub" name="subadd" class="form-control" value="Register" required="" autofocus="">
					                	</div>
					                	

					        
			    			 		
			    					
			    			</form>	
			    		
			    		
			    		  
						


						      
			    	</div>

			    	<div id="deluser" class="tab-pane fade">
			    		<div id="users">
			    		<h2>DELETE USER</h2>
			    		<?php include('Users.php'); ?>
			    		
			    		
			 			</div>
			    	</div>

			    	<div id="delete" class="modal">
			    		<span onclick="document.getElementById('delete').style.display='none'" class="close" title="Close Modal">&times;</span>
  						<form class="modal-content" action="">
					    
					      <h1>Delete Account</h1>
					      <p>Are you sure you want to delete your account?</p>
					    
					      <div class="clearfix">
					        <button type="button" onclick="document.getElementById('delete').style.display='none'" class="btn btn-success">Cancel</button>
					        <button type="button" onclick="deletepoliceuser()" class="btn btn-danger">Delete</button>
					      </div>
					    <br>
					    </form>
					</div>
			    	
	 			</div>

	 		</div>



	 		<div id="changepasswd" class="tab-pane fade">
	 			<div class="row">
	 				<div id="login-row" class="row justify-content-center align-items-center">
                		<div id="login-column" class="col-md-6">
                    		<div id="login-box" class="col-md-12">
				 				<form id="login-form" class="form" action="Adminpass.php" method="post">
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



