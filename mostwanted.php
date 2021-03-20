<?php
	if(isset($_POST["submw"])){
		extract($_POST);
		if(isset($criminal_name) && isset($criminal_desc)){
			$mw_id="";
			$mwname="Mostwanted/".$_FILES["criminal_pic"]["name"];
			$data = $con->prepare("INSERT INTO most_wanted VALUES (?,?,?,?,?)");
			$data->bind_param("iisss",$mw_id,$_SESSION['Admin_id'],$criminal_name,$mwname,$criminal_desc);
			$ext=basename($_FILES["criminal_pic"]["name"]);
			$file_extension = strtolower(pathinfo($ext,PATHINFO_EXTENSION));
			$extensions_arr = array("jpg","jpeg","png");
			if(in_array($file_extension,$extensions_arr)){
				if($_FILES["criminal_pic"]["size"] >=1048576  || $_FILES["criminal_pic"]["size"] == 0) {
					alert("File Size to short or to long !!!!!!");
				}else{
					$status="";
					if(move_uploaded_file($_FILES["criminal_pic"]["tmp_name"],$mwname)){
						$status.="image";
						// echo "saved";
					}else{
						echo"failed to move image !!"."<br>";
					}
					if($data->execute()){
						$status.="data";
					}else{
						echo $data->error;
					}
					if($status=="imagedata"){
						alert("Most Wanted Added Successfully !!!!!!");
					}else{
						alert("Failed to Add Most Wanted !!");
					}
				}
			}else{
				alert("Invalid image format !!!!!");
			}	
		

		}
	}
?>
