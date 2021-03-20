<?php
  	if (!isset($_SESSION["Admin_Login"])){ 
		header("Location: crime_admin_panel.php");
	}
	$available = "SELECT * FROM complaints WHERE Comp_status=1"; 
	$stmt = $con->prepare($available); 
	$stmt->execute();
	$result = $stmt->get_result();

?>


	<table class="table table-hover w-auto" style="background-color: lightblue;" id="mycases_tab">
		<thead class="thead-dark">
			<tr>
			  <th scope="col">Case Title</th>
			  <th scope="col">Case Date</th>
			  <th scope="col">Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = $result->fetch_assoc()){ ?>
			<tr>
            	<td scope="row" style="display: none;"><?php echo $row['Comp_id']; ?></td>
            	<td scope="row" style="display: none;"><?php echo $row['Comp_appby_police']; ?></td>
            	<td scope="row"><?php echo $row['Comp_name']; ?></td>
            	<td scope="row"><?php echo $row['Comp_date']; ?></td>	
        		<td scope="row"><input class="btnSubmit" type="submit" value="View"/></td>	
        		
        		
			</tr>
			<?php } ?>
		</tbody>
	</table>	

