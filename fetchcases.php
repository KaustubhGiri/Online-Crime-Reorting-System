<?php
	session_start();
	include("config/database.php");
	if(!isset($_SESSION["Admin_Login"]) && !isset($_SESSION["Login"])){
	    header("Location: Login.php");
	}
	if(isset($_POST["query"]) || isset($_POST["userid"])){
		$query='%'.$_POST['query'].'%';
		$sessionid=$_POST["userid"];
		$user=$_POST["from"];
		$search="";
		if($user=="admin"){
			$search=$con->prepare("SELECT c.Comp_id,c.Comp_appby_police,c.Comp_name,c.Comp_date,c.Comp_status from complaints as c INNER JOIN victim ON c.Comp_user_id=victim.Victim_id WHERE c.Comp_status=0 AND c.Comp_name LIKE ?");
			$search->bind_param("s",$query);
		}else{
			$search=$con->prepare("SELECT Comp_id,Comp_appby_police,Comp_name,Comp_date,Comp_status FROM complaints WHERE Comp_user_id=? AND Comp_name LIKE ?");
			$search->bind_param("is",$sessionid,$query);
		}
		
		
	    $search->execute();
	    $search->bind_result($comp_id,$Comp_appby_police,$comp_name,$comp_date,$comp_status);
	    $search->store_result();
		$case_no = $search->num_rows;
		// echo $case_no;
		$output="";
		if($case_no > 0){
			$output.='<table class="table table-hover w-auto" style="background-color: lightblue;" id="mycases_tab">
			<thead class="thead-dark" >
			<tr>
				<th scope="col">Case No</th>
				<th scope="col">Case Title</th>
				<th scope="col">Case Date</th>
				<th scope="col">Status</th>
				<th scope="col">Actions</th>
			</tr>
			</thead>
			<tbody>';
				for($i=1;$i<=$case_no;$i++){
					$search->fetch();
					$output.='<tr>
						<td scope="row" style="display: none;">'.$comp_id.'</td>
						<td scope="row" style="display: none;">'.$Comp_appby_police.'</td>
						<td scope="row">'.$i.'</td>
						<td scope="row">'.$comp_name.'</td>
						<td>'.$comp_date.'</td>
						<td>';
							if($comp_status){
								$output.='Confirm !!';
							}else{
								$output.='Not Confirm !!';
							}
									
						$output.='</td>
						<td>
							<input class="btnSubmit" type="submit" value="View"/>
							<a data-toggle="tab" href="#Views" id="view">
							</a>';
							if($user=="normal"){
								if(!$comp_status){
								$output.='<input class="Delete" type="submit" value="Delete" />'; 
							
								}	
							}
						$output.='</td>
						</tr>';
				}
			}else{
				$output.='<a data-toggle="tab"  style="display:none;" href="#Views" id="view">
				</a>';
				$output.='<h3 style="color:white;">No Cases</h3>';
			}
					
			$output.='</tbody>
				</table>'; 

				

$output.='
<!DOCTYPE html>
<html lang="en">
<head>
	<script>
	function confirm_case(){
	  	td=document.getElementById("ccid").textContent;	
	  	window.location.href="Confirmcase.php?ccid="+td;
	}

	function delete_case(){
		var caseid=document.getElementById("ccid").textContent;	
		if(confirm("Are you sure You want to delete case ?")) {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
					var data=JSON.parse(this.responseText);
						if(data=="true"){
							window.alert(\'Case Deleted Successfully !!!\');
							window.location.href=\'AdminHome.php\';
						}else{
							window.alert(\'Failed to Delete Notice!!!\');
							window.location.href=\'AdminHome.php\';
						}
				}
			};
			xhttp.open("POST", "delcase.php", true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("ccid="+caseid);
			
		}else{
			window.location.href="AdminHome.php#Available_cases.php";
		}
	}
	  	
	$("#mycases_tab tbody").on("click", ".Delete", function() {
			var currow=$(this).closest("tr");
			var cid = currow.find("td:eq(0)").text();
			var uri="deletecase.php?cid="+cid;
			$(".modal-body").load(uri,function(){
				$("#myModal").modal({show:true});
			});
	});  
		
	$("#mycases_tab tbody").on("click", ".btnSubmit", function() {
		var currow=$(this).closest("tr");
		var td=currow.find("td:eq(0)").text();
		var p_id=currow.find("td:eq(1)").text();
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "selectedcases.php?caseid="+td+"&p_id="+p_id, true);
		ajax.send();
		ajax.onreadystatechange = function() {
			if(this.readyState == 4 && this.status == 200) {
				var data=JSON.parse(this.responseText);
				var html="";
				var Comp_appby_police,type,casestatus,video,Comp_img1,Comp_img2;
			    for(var i=0;i<data.length;i++){
														    	
						if(data[i].Comp_video==""){
						video=\'<th scope="col" class="details_col2">No Video Uploaded !!</th>\';
						}else{
						video=\'<th scope="col" class="details_col2"><video width="100%" height="auto" controls src=\'+data[i].Comp_video+\'>video.</video></th></tr>\';
						}

				    	if(data[i].Comp_appby_police==0){
				    		Comp_appby_police="Not Approved!!";
				    	}else{
				    		Comp_appby_police=data[i].Police_name;
				    	}
				    	if(data[i].Comp_type==1){
				    		type="Murder";
				    	}else if(data[i].Comp_type==2){
				    		type="Missing";
				    	}else if(data[i].Comp_type==3){
				    		type="CyberCrime";
				    	}else if(data[i].Comp_type==4){
				    		type="ChildAbuse";
				    	}else if(data[i].Comp_type==5){
				    		type="Robbery";
				    	}else{
				    		type=data[i].Comp_type;
				    	}
				    	if(data[i].Comp_status==0){
				    		casestatus="Not Confirm !!";
				    	}else if(data[i].Comp_status==1){
				    		casestatus="Confirmed !!";
				    	}else if(data[i].Comp_status==2){
				    		casestatus="Solved And Close !!!";
				    	}
				    	if(data[i].Comp_img1==""){
				    		Comp_img1=\'<td scope="col" class="details_col2">No Image Uploaded !!!</td>\';
				    		console.log("Img111");
				    	}else{
				    		Comp_img1=\'<td scope="col" class="details_col2"><img src=\'+data[i].Comp_img1+\' alt="Image1" width="200" height="200">\';
				    	}
				    	if(data[i].Comp_img2==""){
				    		Comp_img2="No Image Uploaded</tr>";
				    		console.log("IMGGG2");
				    	}else{
				    		Comp_img2=\'<img style="padding-left:20px;" src=\'+data[i].Comp_img2+\' alt="Image2" width="200" height="200"></td></tr>\';
				    	}
				    	html+=\'<p style="display:none"; id="ccid">\'+td+\'</p>\';
						html+="<tr>";
	      				html+=\'<td scope="col" class="details_col">Case File By</td>\';
	      				html+=\'<td scope="col" class="details_col2">\'+data[i].Victim_fullname+\'</td></tr>\';

	      				html+="<tr>";
	      				html+=\'<td scope="col" class="details_col">Case Title</td>\';
	      				html+=\'<td scope="col" class="details_col2">\'+data[i].Comp_name+\'</td></tr>\';

	      				html+="<tr>";
	      				html+=\'<td scope="col" class="details_col">Case Approved By</td>\';
	      				html+=\'<td scope="col" class="details_col2">\'+Comp_appby_police+\'</td></tr>\';

	      				html+="<tr>";
	      				html+=\'<td scope="col" class="details_col">Case Type</td>\';
	      				html+=\'<td scope="col" class="details_col2">\'+type+\'</td></tr>\';
	      				
	      				html+="<tr>";
	      				html+=\'<td scope="col" class="details_col">Case Address</td>\';
	      				html+=\'<td scope="col" class="details_col2">\'+data[i].Comp_address+\'</td></tr>\';

	      				html+="<tr>";
	      				html+=\'<td scope="col" class="details_col">Case Description</td>\';
	      				html+=\'<td scope="col" class="details_col2">\'+data[i].Comp_description+\'</td></tr>\';

	      				html+="<tr>";
	      				html+=\'<td scope="col" class="details_col">Case Status</td>\';
	      				html+=\'<td scope="col" class="details_col2">\'+casestatus+\'</td></tr>\';

	      				html+="<tr>";
	      				html+=\'<td scope="col" class="details_col">Case Images</td>\';
	      				html+=Comp_img1;
	      				html+=Comp_img2;

	      				html+="<tr>";
	      				html+=\'<td scope="col" class="details_col">Case Video</td>\';
	      				
						html+=video;';
						if($user=="admin"){

	      					$output.='html +=\'<tr><td scope="col" class="details_col">Actions</td>\';
							  html+=\'<td scope="col" class="details_col2">\'; 
							  	if(data[i].Comp_status==0){
									html+=\'<button type="submit" class="btn btn-success" style="margin:5px;" onclick="confirm_case()">Confirm</button>\';
								} 
	      					html+=\'<button type="submit" class="btn btn-danger" onclick="delete_case()">Delete</button>\'';
						}
					$output.='}
					document.getElementById("casess").innerHTML=html;
				}
		};
		$("#view")[0].click();
	});
  </script>
  <style>
  	.details_col{
		background-color: dimgray;
		color:white;
	}
	.details_col2{
		background-color: white;
	}
  </style>
</head>
		<div class="modal fade" id="myModal">
			   <div class="modal-dialog">
			      <div class="modal-content">
			      	
			      	
			        <div class="modal-header">
			          <h4 class="modal-title">Delete Case</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			        </div>
			        
			        <div class="modal-body">
			          <h4 id="confirm" class="modal-title">Are you sure you want to delete case :</h4>
			        </div>
			        
			        
			        
			      </div>
			    </div>
		</div>';
  	
  	echo $output;

	}
 ?>