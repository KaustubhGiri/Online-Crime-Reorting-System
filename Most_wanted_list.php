
<?php
	$mostwanted = "SELECT mw_id,mw_name,mw_photo,mw_description,police_name FROM most_wanted,police WHERE most_wanted.mw_police_id=police.Police_id";	
	$stmt = $con->prepare($mostwanted); 
	$stmt->execute();
	$result = $stmt->get_result();
	
?>
<head>
	
	<style type="text/css">
		.parent{
			text-align:left;
		}
		.padding_maker{
			display:inline-block;
			padding:10px;
		}
		.children{
			display:inline-block;
			/*background-color:lightgrey;*/
			height:250px;
			width:250px;
			color:white;
			text-align:center;
		}
	</style>
</head>
<script type="text/javascript">

</script>
 
	 

<div class="parent">

<div class="padding_maker">
<?php while ($row = $result->fetch_assoc()){ ?>		
<div class="children">

 <img class="card-img-top" src="<?php echo $row['mw_photo']; ?>" alt="Card image cap" width=200 height=200>
  	<center>
	    <h4 class="card-title">Name : <?php echo $row["mw_name"]; ?></h4>
	    <p class="card-text">Description : <?php echo $row["mw_description"]; ?></p>
	    <?php if($_SESSION["Admin_Login"]=="true"){ ?>
	  		<!-- <button type="button" onclick="delmostwanted()" class="btn btn-danger">Delete</button> -->
	  		<form method="post" action="del_mostwanted.php">
	  			<input type="hidden" name="userid" value="<?php echo $row['mw_id'];?>">
	  			<input type="submit" class="btn btn-danger" name="subdel" value="Delete">
	  		</form>
	  	<?php } ?>
	</center>
</div>
<?php } ?>
</div>

</div>
				
