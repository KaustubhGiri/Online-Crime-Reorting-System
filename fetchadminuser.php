<?php
	header("Content-Type: application/json; charset=UTF-8");
	include('config/database.php');
    session_start();
	if (!isset($_SESSION["Admin_Login"])){ 
		header("Location: crime_admin_panel.php");
	}
	$obj = json_decode($_POST["pid"], false);
	$pid=$obj->uuid;
	$policeuser = "SELECT Police_id,Police_name,Police_email,Police_gender,Police_area,Police_designation,Police_Phone,Police_photo FROM police WHERE Police_id = ?";	
	$stmt = $con->prepare($policeuser);
	$stmt->bind_param("s",$pid);
	$stmt->execute();
	$result = $stmt->get_result();
	$output='<table class="table table-hover w-auto" style="background-color: lightblue;" id="tabpol">
	<tbody>';
	$gender="";

	while ($row = $result->fetch_assoc()){ 
		if($row["Police_gender"])
			$gender="Male";
		else
			$gender="Female";
		$output.='
				<p id="selectedid" style="display:none;">'.$row["Police_id"].'</p>
				<tr>
				  <td>Police Name </td>
				  <td>'.$row["Police_name"].'</td>
				</tr>
				<tr>
				  <td>Police Email </td>
				  <td>'.$row["Police_email"].'</td>
				</tr>
				<tr>
				  <td>Police Phone No </td>
				  <td>'.$row["Police_Phone"].'</td>
				</tr>
				<tr>
				  <td>Police Gender </td>
				  <td>'.$gender.'</td>
				</tr>
				<tr>
				  <td>Police Area </td>
				  <td>'.$row["Police_area"].'</td>
				</tr>
				<tr>
				  <td>Police Designation </td>
				  <td>'.$row["Police_designation"].'</td>
				</tr>
				<tr>
				  <td>Police Photo </td>
				  <td><img src='.$row["Police_photo"].' alt="Image1" width="200" height="200"></td>
				</tr>
				<tr>
				  <td>Action </td>
				  <td><button class="btn btn-danger" onclick="deletemodal()">Delete</button></td>
				</tr>
				
			</tbody>
			</table>';
	 }	
	echo json_encode($output);
?>



		
			