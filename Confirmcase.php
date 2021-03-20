<?php
	session_start();
	include('config/database.php');
	include('alert.php');
	if (!isset($_SESSION["Admin_Login"])){ 
		header("Location: crime_admin_panel.php");
		// header("Location: Login.php");
	}

	$updatestatus = $con->prepare("UPDATE complaints SET comp_status=1,Comp_appby_police=? WHERE Comp_id=?");
	$updatestatus->bind_param("si",$_SESSION["Admin_id"],$_GET["ccid"]);
	if($updatestatus->execute()){
		echo "<script>alert('Case Confirm Successfully !!!');window.location.href='AdminHome.php';</script>";
	}else{
		echo "<script>alert('Failed To Confirm Case !!!');window.location.href='AdminHome.php';</script>";
	}
?>