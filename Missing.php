<?php
  error_reporting(0);
  $missing = "SELECT Comp_id,Comp_name,Comp_img1 FROM `complaints` WHERE Comp_type=2 and Comp_status=1"; 
  $stmt = $con->prepare($missing); 
  $stmt->execute();
  $result = $stmt->get_result();

?>

<div class="parent">

<div class="padding_maker">
<?php while ($row = $result->fetch_assoc()){ ?>   
<div class="children">

<img src="<?php echo $row['Comp_img1']; ?>" alt="Missing image" width=200 height=200 class="card-img-top">
   <center>
        <h5 class="card-title"><?php echo $row['Comp_name']; ?></h5>
        <form method="post" action="del_missing.php">
          <?php if($_SESSION["Admin_Login"] == "true"){ ?>
            <input type="hidden" name="mid" value="<?php echo $row['Comp_id'];?>">
            <input type="submit" class="btn btn-danger" name="subdel" value="Delete">
          <?php } ?>
        </form>
    </center>
</div>
<?php } ?>
</div>

</div>
      



