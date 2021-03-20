<?php 
include('config/database.php'); 
session_start();
if (!isset($_SESSION["Admin_Login"])){ 
	header("Location: crime_admin_panel.php");
}
if(isset($_POST["delmw"])){
	
	$query="DELETE FROM most_wanted WHERE mw_id=?";
	$result=$con->prepare($query);
	$result->bind_param('i',$_POST["mwid"]);
	if($result->execute()){
		// alert("Deleted Suceessfully !!");
		echo "<script>
			alert('Deleted Suceessfully !!!');
			window.location.href='AdminHome.php#manage_mw';
		</script>";
	}else{
		echo "<script>
			alert('Failed To Delete !!!');
			window.location.href='AdminHome.php#manage_mw';
		</script>";
	}
}
?>
<head>
<link rel="stylesheet" type = "text/css" href = "media/css/deletemodal.css"/>
</head>
<div id="delete" class="modal" style="display: block;">
<span onclick="window.location.href='AdminHome.php#manage_mw'" class="close" title="Close Modal">&times;</span>
	<form class="modal-content" action="del_mostwanted.php" method="post">

  <h1>Delete Record</h1>
  <p>Are you sure you want to delete most wanted record ?</p>
  <div class="clearfix">
    <button type="button" onclick="window.location.href='AdminHome.php#manage_mw'" class="btn btn-success">Cancel</button>
    
    <input type="hidden" value="<?php echo $_POST['userid']; ?>" name="mwid">
    <input type="submit" name="delmw" value="Delete">
 
  </div>
<br>
</form>
</div>