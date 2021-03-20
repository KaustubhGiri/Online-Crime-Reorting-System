<?php
	header("Content-Type: application/json; charset=UTF-8");
	session_start();
	include('config/database.php');
	if (!isset($_SESSION["Admin_Login"])){ 
		header("Location: crime_admin_panel.php");
	}
	$obj = json_decode($_POST["query"], false);
	$sqry=$obj->sname;
	$query='%'.$sqry.'%';
		
	$policeuser = "SELECT Police_id,Police_name,Police_email,Police_gender,Police_area,Police_designation,Police_Phone,Police_photo FROM police WHERE Police_name LIKE ?";	
	$stmt = $con->prepare($policeuser);
	$stmt->bind_param("s",$query);


	$stmt->execute();
	$result = $stmt->get_result();
	$output='<table class="table table-hover w-auto" style="background-color: lightblue;" id="tabpol"><thead class="thead-dark" >
					<tr>
					  <th scope="col">Police Name</th>
					  <th scope="col">Police Designation</th>
					  <th scope="col">Actions</th>
					</tr>
					</thead>
					<tbody>';

	while ($row = $result->fetch_assoc()){
		$output.='<tr>
					<td scope="row" style="display: none;">'.$row["Police_id"].'</td>
					<td scope="row" >'.$row["Police_name"].'</td>
					<td scope="row" >'.$row["Police_designation"].'</td>
					<td scope="row" ><button type="button" class="btn btn-secondary" onclick="viewUser()">View</button></td>
				</tr>';
	}
	$output.='</tbody></table>';
	echo json_encode($output);
	
?>