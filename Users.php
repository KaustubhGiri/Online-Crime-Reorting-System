<?php
	include('config/database.php');
	
?> 
<script type="text/javascript">
	function usertable(query){
		var obj = {sname: query};
  		var strname = JSON.stringify(obj);
		var xhttp = new XMLHttpRequest();
		// console.log(query);
		xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		     var data=JSON.parse(this.responseText);
		     document.getElementById("usertable").innerHTML = data;
		     
		    }
		};
		xhttp.open("POST", "fetchpoliceuser.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("query="+strname); 
		
	}

	
</script>

<div class="input-group" id="search">
<input type="text" class="form-control" id="Searchofficer" placeholder="Enter Officer Name" onkeyup="searchuser(this);">
<div class="input-group-btn">
	<button class="btn btn-default" type="submit">
	<i class="glyphicon glyphicon-search"></i>
	</button>
</div>
</div><br>

<div class="row" id="usertable" style="margin:5px;">
<?php 
	$policeuser = "SELECT Police_id,Police_name,Police_email,Police_gender,Police_area,Police_designation,Police_Phone,Police_photo FROM police";	
	$stmt = $con->prepare($policeuser); 
	$stmt->bind_param("i",$_SESSION["Admin_id"]);
	$stmt->execute();
	$result = $stmt->get_result();
	

?>

	<table class="table table-hover w-auto" style="background-color: lightblue; " id="tabpol"><thead class="thead-dark">
		<tr>
		  <th scope="col">Police Name</th>
		  <th scope="col">Police Designation</th>
		  <th scope="col">Actions</th>
		</tr>
		</thead>
		<tbody>
		<?php	while ($row = $result->fetch_assoc()){ ?>
			<tr>
				<td scope="row" id="pid" style="display: none;"><?php echo $row["Police_id"] ?></td>
				<td scope="row" ><?php echo $row["Police_name"] ?></td>
				<td scope="row" ><?php echo $row["Police_designation"] ?></td>
				<td scope="row" ><button type="button" class="btn btn-secondary" onclick="viewUser()">View</button></td>
			</tr>
		<?php } ?>	
		</tbody>
	</table>
</div>

