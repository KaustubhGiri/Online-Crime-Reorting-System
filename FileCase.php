<?php

session_start();
include('config/database.php');
include('alert.php');
if (!isset($_SESSION["Login"])){ 
	header("Location: Login.php");
}
$status=0;
$up_status=0;
function create_location($datatype,$img_vid_selected,$data_size){
	global $status,$up_status;
	$extensions_arr = array();
	$maxsize=""; 
	$value="";
	$location="Proofs/".$_SESSION["Phone"]."/".$datatype."/";
	$data=$location . basename($img_vid_selected);
  	
	
	$file_extension = strtolower(pathinfo($data,PATHINFO_EXTENSION));
		// $image2Type = strtolower(pathinfo($_FILES["file"]["image2"],PATHINFO_EXTENSION));

		if($datatype=="images"){
			$extensions_arr = array("jpg","jpeg","png");
			$maxsize = 1048576; // 1MB in bytes	
			$value="1MB";
		}else{
			$extensions_arr=array("mp4","avi","3gp","mpeg");
			$maxsize = 5242880; // 5MB in bytes
			$value="5MB";
		}
		if(in_array($file_extension,$extensions_arr)){
			if($data_size >= $maxsize || $data_size == 0) {
				$status=2;
            	alert("File too large or small. File must be less than ".$value);
            	echo "<script>window.location.href='Home.php';</script>";	
          	}else{
				
				$up_status=1;
          		if(!is_dir($location)){
          			if(mkdir($location,0777,true)){
				// 		echo "done created";
					}else{
				// 		echo "failed to create";
					}
          		}
					
          	}
			
		}else{
			alert($datatype." Format Not Supported !!!!!");
			$status=2;
			echo "<script>
			window.location.href='Home.php#Complaint'</script>";
			
		}
		return $location;
}
if(isset($_POST["submitcase"])){
	extract($_POST);
	$img1="";
	$img2="";
	$comp_video="";
	$comp_id="";
	$comp_userid=$_SESSION["User_id"];

	if($type==6){
		$type=$others;
	}
	$comp_status=0;
	$current_date=date("Y-m-d h:i:s");
	$comp_appbypolice="";
	// $Proof=$_POST["Proof"];
	
	function uploadimages(){
		global $status,$up_status;
		$loc_images = array(); 
		
		if($_FILES['image1']['error'] === 0 ){
			$img1=create_location("images",$_FILES["image1"]["name"],$_FILES["image1"]["size"]);
			if($up_status==1){
				if(move_uploaded_file($_FILES["image1"]["tmp_name"],$img1.$_FILES["image1"]["name"])){
				
					$status=1;
				}else{
				
					$status=2;
				}
			}
		}

		if($_FILES['image2']['error'] === 0 ){
			$img2=create_location("images",$_FILES["image2"]["name"],$_FILES["image2"]["size"]);
			
			if($up_status==1){
				if(move_uploaded_file($_FILES["image2"]["tmp_name"],
					$img2.$_FILES["image2"]["name"])){
				
					$status=1;
				}else{
					
					$status=2;
				}
			}
		}
		
		array_push($loc_images,$img1.$_FILES["image1"]["name"],$img2.$_FILES["image2"]["name"]);	
		
		return $loc_images;
	}
	function uploadvideo(){
		global $status;
		$comp_video=create_location("videos",$_FILES["video"]["name"],$_FILES["video"]["size"]);
		
		if($up_status==1){
			if(move_uploaded_file($_FILES["video"]["tmp_name"],$comp_video.$_FILES["video"]["name"])){
				$status=1;
			}
		}
		
		return $comp_video.$_FILES["video"]["name"];
		
	}
	if($Proof=="1"){
		$images=uploadimages();
		$img1=$images[0];
		$img2=$images[1];
	}elseif($Proof=="2"){
		$comp_video=uploadvideo();
	
	}elseif($Proof=="3"){
		$images=uploadimages();
		$img1=$images[0];
		$img2=$images[1];
		$comp_video=uploadvideo();
	
	}
	$data = $con->prepare("INSERT INTO complaints VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
	$data->bind_param("iisssssiisss",$comp_id,$comp_userid,$c_title,$type,$C_description,$C_address,$current_date,$comp_appbypolice,$comp_status,$img1,$img2,$comp_video);
	if($status==0 || $status==1){
		if($data->execute()){
			echo "<script>alert('Case File successfully !!!');
			window.location.href='Home.php';
						</script>";	
		}else{
		   
			echo "<script>alert('Failed to Register case !!!');
						</script>";
			
		}
	}
		   
}
?>