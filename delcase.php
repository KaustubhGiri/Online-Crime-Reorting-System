<?php
    include('config/database.php');   
    $status="";
	$query="";
	$query="DELETE FROM complaints WHERE Comp_id=?";    
    
    $result=$con->prepare($query);
    if($result){
        $result->bind_param('i',$_POST["ccid"]);
        if($result->execute()){
            $status="true";
        }else{
            $status ="false";
        }
    }
  echo json_encode($status);
?>