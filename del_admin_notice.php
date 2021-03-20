<?php
    session_start();
    include('config/database.php');   
    if (!isset($_SESSION["Admin_Login"])){ 
		header("Location: crime_admin_panel.php");
	}
    $status="";
    $query="";
    if($_POST["for"]=="police"){
        $query="DELETE FROM police WHERE Police_id=?";    
    }else{
        $query="DELETE FROM notices WHERE Notice_id=?";
    }
    
    $result=$con->prepare($query);
    if($result){
        $result->bind_param('i',$_POST["pnid"]);
        if($result->execute()){
            $status="true";
            
        }else{
            $status ="false";
        }
    }
  echo json_encode($status);
?>