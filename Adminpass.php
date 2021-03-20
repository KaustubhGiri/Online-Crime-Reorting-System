<?php
session_start();
include('config/database.php');
include('alert.php');
if (!isset($_SESSION["Admin_Login"])){ 
	header("Location: crime_admin_panel.php");
}
if(isset($_POST["changepasswd"])){
	extract($_POST);
	// echo $_SESSION["Admin_id"];
	if(!empty($oldpass) && !empty($newpass) && !empty($confirmnewpass)){
	$userid=$_SESSION["Admin_id"];
	$changepasswd = $con->prepare("SELECT Police_Phone,Police_email,Police_password FROM police WHERE Police_id=?");
        $changepasswd->bind_param("i",$userid);
        $changepasswd->execute();
        $changepasswd->bind_result($Police_Phoneno,$Police_email,$Police_pass);
        $changepasswd->store_result();
         echo $changepasswd->num_rows;
        if($changepasswd->num_rows > 0){
        	$changepasswd->fetch();
        	$hashpass=hash('sha1',"$Police_Phoneno$oldpass$Police_email");
        	// echo $Police_Phoneno;
        	// echo "hash pass : ".$hashpass;
        	// echo $Police_pass;
        	if($hashpass==$Police_pass){
        		if($newpass==$confirmnewpass){
        			$newhash=hash('sha1',"$Police_Phoneno$newpass$Police_email");
        			$changepasswd = $con->prepare("UPDATE police SET Police_password=? WHERE Police_id=?");
        			$changepasswd->bind_param("si",$newhash,$userid);
        			if($changepasswd->execute()){
        				echo "<script>alert('Password changed successfully !!!');window.location.href='AdminHome.php';</script>";
        			}else{
        				echo "<script>alert('Failed To Change Password !!!');window.location.href='AdminHome.php';</script>";
        			}
        		}else{
        			echo "<script>alert('Password Mismatch !!!');window.location.href='AdminHome.php';</script>";
        		}
        	}else{
        		echo "<script>alert('Invalid Current Password !!!');window.location.href='AdminHome.php';</script>";
        	}
        }
       
        }
}
?>