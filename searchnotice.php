<?php
    header("Content-Type: application/json; charset=UTF-8");
    session_start();
    include('config/database.php');
    $obj = json_decode($_POST["query"], false);
	$squery=$obj->snqry;
	$query='%'.$squery.'%';
	$notice = "SELECT Notice_id,Notice_name,Notice_message,Notice_date,police_name FROM notices,police WHERE notices.Notice_by=police.Police_id and notices.Notice_name LIKE ?";	
    $stmt = $con->prepare($notice); 
    $stmt->bind_param("s",$query);
	$stmt->execute();
	$result = $stmt->get_result();
    $output='<table class="table table-hover w-auto" style="background-color: lightblue;" id="noticetab" style="padding-top:5px;">
	<thead class="thead-dark">
		<tr>
		  <th scope="col">Notice Name</th>
		  <th scope="col">Notice Message</th>
		  <th scope="col">Notice By</th>
		  <th scope="col">Notice Date</th>';
    if($_SESSION["Admin_Login"]=="true"){
        $output.='<th scope="col">Actions</th>';
    }
    while ($row = $result->fetch_assoc()){
        $output.='<tr>
        <td scope="row" id="nid" style="display: none;">'.$row["Notice_id"].'</td>
        <td scope="row" >'.$row["Notice_name"].'</td>
        <td scope="row" >'.$row["Notice_message"].'</td>
        <td scope="row" >'.$row["police_name"].'</td>
        <td scope="row">'.$row["Notice_date"].'</td>';
        if($_SESSION["Admin_Login"]=="true") { 
            $output.='<td scope="row"><button type="button" class="btn btn-danger" onclick="DeleteNotice()">Delete</button></td>';
        } 
        $output.='</tr>';
    }    
    $output.='</tr>
	</thead>
	<tbody>';
    $output.='</tbody></table>';
	echo json_encode($output);
?>