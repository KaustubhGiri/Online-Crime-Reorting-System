<?php
include('alert.php');
if (!isset($_SESSION["Admin_Login"])){ 
	header("Location: crime_admin_panel.php");
}
if(isset($_POST["subadd"])){
	extract($_POST);
	if($pass1==$pass2){
		$image_name=basename($_FILES["profile_pic"]["name"]);
		$file_extension = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
		$extensions_arr = array("jpg","jpeg","png");
		if(in_array($file_extension,$extensions_arr)){
			if($_FILES["profile_pic"]["size"] >=1048576  || $_FILES["profile_pic"]["size"] == 0) {
				alert("File Size to short or to long !!!!!!");
			}else{
				$location="AdminUser/".$phone."/";
				if(!is_dir($location)){
          			if(mkdir($location,0777,true)){
						
					}
				// 	else{
				// 		echo "failed to create directory!!!";
				// 	}
          		}
          	    $status="";
          		$profile_pic=$location.$image_name;
				$police_id="";
				$hashpass=hash('sha1',"$phone$pass2$email");
				$data = $con->prepare("INSERT INTO police VALUES (?,?,?,?,?,?,?,?,?)");	
				$data->bind_param("issssssss",$police_id,$fullname,$email,$gender,$police_area,$police_designation,$phone,$hashpass,$profile_pic);
				if(move_uploaded_file($_FILES["profile_pic"]["tmp_name"],$profile_pic)){
					$status.="image";
				}
				// else{
				// 	echo"failed to move image !!"."<br>";
				// }
				if($data->execute()){
					$status.="data";
				}
				// else{
				// 	echo"Failed to Registered !!!";
				// }
				if($status=="imagedata"){
					alert("User Added Successfully !!!!!!");
				}else{
					alert("Failed to Add admin !!");
				}	
			}	
		}else{
			alert("File Format Not Supported !!!!!");
		}
		
	}else{
		alert("Password Mismatch !!");
	}
	
	


}
?>