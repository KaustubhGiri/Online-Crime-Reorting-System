<?php
session_start();
include('config/database.php');
include('alert.php');
if (!isset($_SESSION["Login"])){ 
	header("Location: Login.php");
}
if(isset($_POST["changepasswd"])){
	extract($_POST);
	echo $_SESSION["User_id"];
	if(!empty($oldpass) && !empty($newpass) && !empty($confirmnewpass)){
		$userid=$_SESSION["User_id"];
		$changepasswd = $con->prepare("SELECT Victim_Phoneno,Victim_email,Victim_pass FROM victim WHERE Victim_id=?");
        $changepasswd->bind_param("i",$userid);
        $changepasswd->execute();
        $changepasswd->bind_result($Victim_Phoneno,$Victim_email,$Victim_pass);
        $changepasswd->store_result();
        if($changepasswd->num_rows > 0){
        	$changepasswd->fetch();
        	$hashpass=hash('sha1',"$Victim_Phoneno$oldpass$Victim_email");
        	echo $Victim_Phoneno;
        	echo "hash pass : ".$hashpass;
        	echo $Victim_pass;
        	if($hashpass==$Victim_pass){
        		if($newpass==$confirmnewpass){
        			$newhash=hash('sha1',"$Victim_Phoneno$newpass$Victim_email");
        			$changepasswd = $con->prepare("UPDATE victim SET Victim_pass=? WHERE Victim_id=?");
        			$changepasswd->bind_param("si",$newhash,$userid);
        			if($changepasswd->execute()){
        				echo "<script>alert('Password changed successfully !!!');
								window.location.href='Home.php';
							</script>";
        			}else{
        				echo "failed to changed pass";
        			}
        		}else{
        			alert("Password mismatch !!!!!");
        		}
        	}else{
        		alert("Invalid Current password");
        	}
        }
        else{
			alert("field cant be blank");
		}
	}
}
?>