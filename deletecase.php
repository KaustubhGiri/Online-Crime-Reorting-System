<?php
	include('config/database.php');
	session_start();
	if (!isset($_SESSION["Login"])){ 
		header("Location: Login.php");
	}

	$query=$con->prepare("Select Comp_name from complaints where Comp_id = ?");
	$query->bind_param("s",$_GET["cid"]);
	$query->execute();
	$query->bind_result($comp_name);
	$query->fetch();
		if(isset($_POST["delyes"])) { 
			include('Home.php');
           //alert($_POST["caseid"]);
			$query="DELETE FROM complaints WHERE Comp_id=?";
			$result=$con->prepare($query);
			if($result){
				$result->bind_param('i',$_POST["caseid"]);
				if($result->execute()){
					echo "<script>
					alert('Case deleted successfully !!!');
					window.location.href='Home.php';
					
					</script>";	
				}else{
					echo "<script>
					alert('Failed To Delete Case !!!');</script>";
				}
			}
           	
        } 
        
	?>
<head>

</head>
<style type="text/css">
		h2{
			color:red;
		}
	</style>
<body >
<h2>Are you sure you want to delete the </h2> 
	<h2>Case : <?php echo $comp_name?></h2>
	<div class="modal-footer">
	 	<form method="post" action="deletecase.php">
	 		<button type="submit" class="btn btn-success" name="delyes">Yes</button>
	 		<input type="hidden" name="caseid" value="<?php echo $_GET["cid"]; ?>">
	      	<button type="button" class="btn btn-danger" data-dismiss="modal" >No</button>	
	 	</form>
	      
	</div>
</body>