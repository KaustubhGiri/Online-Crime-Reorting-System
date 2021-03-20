<?php 
include('config/database.php');
include('alert.php');
$query;
$stmt;

if($_GET["p_id"]=='0'){
	$query = "SELECT v.Victim_fullname,c.Comp_name,c.Comp_appby_police,c.Comp_type,c.Comp_status,c.Comp_description,c.Comp_img1,c.Comp_img2,c.Comp_video from complaints as c INNER JOIN victim as v ON c.Comp_user_id=v.Victim_id WHERE c.Comp_id=?";
	$stmt = $con->prepare($query); 
	$stmt->bind_param("i", $_GET["caseid"]);
}else{
	$query="SELECT p.Police_name,v.Victim_fullname,c.Comp_name,c.Comp_appby_police,c.Comp_type,c.Comp_status,c.Comp_description,c.Comp_img1,c.Comp_img2,c.Comp_video from police as p ,complaints as c INNER JOIN victim as v ON c.Comp_user_id=v.Victim_id WHERE c.Comp_id=? AND p.Police_id=?";
	$stmt = $con->prepare($query); 
	$stmt->bind_param("ii", $_GET["caseid"],$_GET["p_id"]);
}
$stmt->execute();
$result = $stmt->get_result();
$data=array();
while ($row = $result->fetch_assoc()) {
    array_push($data, $row);
}
echo json_encode($data);
exit();
?>