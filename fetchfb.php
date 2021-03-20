<?php
	include('config/database.php');
	if (!isset($_SESSION["Admin_Login"])){ 
		header("Location: crime_admin_panel.php");
	}
?>
 
<table class="table table-hover w-auto" style="background-color: lightblue;" id="">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Sr no</th>
			<th scope="col">First Name</th>
			<th scope="col">Last Name</th>
			<th scope="col">Subject</th>
			<th scope="col">Feedback Date</th>
		  
		</tr>
	</thead>
		<tbody>
			<?php
				$query ="Select * from feedback";
				$feedback = $con->query($query);

				if($feedback->num_rows > 0){
					while($row=$feedback->fetch_assoc()){ ?>
						<tr>
							<td><?php echo $row["fb_id"];?></td>
							<td><?php echo $row["fb_first_name"];?></td>
							<td><?php echo $row["fb_last_name"];?></td>
							<td><?php echo $row["fb_subject"];?></td>
							<td><?php echo $row["fb_date"];?></td>
						</tr>
					<?php }
				}

			?>
		</tbody>
</table>
			
	
	