<?php
	error_reporting(0);
	$notice = "SELECT Notice_id,Notice_name,Notice_message,Notice_date,police_name FROM notices,police WHERE notices.Notice_by=police.Police_id";	
	$stmt = $con->prepare($notice); 
	$stmt->execute();
	$result = $stmt->get_result();
?>

<table class="table table-hover w-auto" style="background-color: lightblue;" id="noticetab" style="padding-top:5px;">
	<thead class="thead-dark">
		<tr>
		  <th scope="col">Notice Name</th>
		  <th scope="col">Notice Message</th>
		  <th scope="col">Notice By</th>
		  <th scope="col">Notice Date</th>
		  <?php if($_SESSION["Admin_Login"]=="true") { ?>
		  		<th scope="col">Actions</th>
		  <?php } ?>
		  
		</tr>
	</thead>
	<tbody>
		<?php	while ($row = $result->fetch_assoc()){ ?>
			<tr>
				<td scope="row" id="nid" style="display: none;"><?php echo $row["Notice_id"] ?></td>
				<td scope="row" ><?php echo $row["Notice_name"] ?></td>
				<td scope="row" ><?php echo $row["Notice_message"] ?></td>
				<td scope="row" ><?php echo $row["police_name"] ?></td>
				<td scope="row" ><?php echo $row["Notice_date"] ?></td>
				<?php if($_SESSION["Admin_Login"]=="true") { ?>
				<td scope="row"><button type="button" class="btn btn-danger" onclick="DeleteNotice()">Delete</button></td>
				<?php } ?>
			</tr>
		<?php } ?>	
	</tbody>
</table>
