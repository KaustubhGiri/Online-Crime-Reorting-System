<?php
// include('config/database.php');
if (!isset($_SESSION["Admin_Login"])){ 
	header("Location: crime_admin_panel.php");
}
if(isset($_POST["subnot"])){
	extract($_POST);
	$notice_id="";
	$current_date=date("Y-m-d");
	$data = $con->prepare("INSERT INTO notices VALUES (?,?,?,?,?)");
	$data->bind_param("issss",$notice_id,$Nname,$Nmessage,$_SESSION["Admin_id"],$current_date);
	if($data->execute()){
		alert("Notice added Successfully !!!!!!");
	}else{
		
		alert("Failed to add notice !!!");
	}
}
?>