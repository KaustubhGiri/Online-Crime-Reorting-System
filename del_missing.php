<?php 
session_start();
include('config/database.php');   
if (!isset($_SESSION["Admin_Login"])){ 
	header("Location: crime_admin_panel.php");
}
if(isset($_POST["delmm"])){
	
	$query="DELETE FROM complaints WHERE Comp_id=?";
	$result=$con->prepare($query);
	$result->bind_param('i',$_POST["c_id"]);
	if($result->execute()){
		// alert("Deleted Suceessfully !!");
		echo "<script>
			alert('Deleted Suceessfully !!!');
			window.location.href='AdminHome.php';
		</script>";
	}else{
		echo "<script>
			alert('Failed To Delete !!!');
			window.location.href='AdminHome.php';
		</script>";
	}
}
?>
<head>
<link rel="stylesheet" type = "text/css" href = "media/css/deletemodal.css"/>
</head>
<div id="delete" class="modal" style="display: block;">
<span onclick="window.location.href='AdminHome.php#manage_missing'" class="close" title="Close Modal">&times;</span>
	<form class="modal-content" action="del_missing.php" method="post">

  <h1>Delete Record</h1>
  <p>Are you sure you want to delete missing record ?</p>
  <div class="clearfix">
    <button type="button" onclick="window.location.href='AdminHome.php#manage_missing'" class="btn btn-success">Cancel</button>
    
    <input type="hidden" value="<?php echo $_POST['mid']; ?>" name="c_id">
    <input type="submit" name="delmm" value="Delete">
 
  </div>
<br>
</form>
</div>