<?php
  include('config/database.php');
  include('alert.php');
    if(isset($_POST['sub_feedback'])){
        if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["subject"])){
            extract($_POST);
            $fb_id="";
            $date=date("Y/m/d");
            $query="INSERT INTO feedback VALUES (?,?,?,?,?)";
            $feedback = $con->prepare($query);
            $feedback->bind_param("issss",$fb_id,$firstname,$lastname,$subject,$date);
            if($feedback->execute()){
                alert("Submitted Successfully !!!!!!!!");
            }else{
                alert("Failed to Submit feedback !!!");
                // echo $userdata->error;
            }   
        }
    }

?>
<!DOCTYPE html>
 <head>
   <link rel="stylesheet" href="media/css/main/contactus.css" />
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
   <style>
   </style>
 </head>
<?php include('navbar.php'); ?>
 <div class="container">

  <div style="text-align:center">
    <h2>Contact Us</h2>
    <p>Feel Free to provide your Feedback</p>
  </div>

  <div class="row">
    <div class="column">
      <img src="police.png" style="width:100%">
    </div>
    <div class="column">
      <form action="contactus.php" method="POST">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="firstname" placeholder="Your name.." required>
        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastname" placeholder="Your last name.." required>
        
        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:170px" required></textarea >
        <input type="submit" name="sub_feedback"value="Submit">
      </form>
    </div>
  </div>

  <center>
   <div class="mapopenstreet" id = "map" style = "width: 50%; height: 450px;"></div> 
  </center>
   
      <script>
         // Creating map options
         var mapOptions = {
            center: [18.98912, 73.11976],
            zoom: 10
         }
         
         // Creating a map object
         var map = new L.map('map', mapOptions);
         
         // Creating a Layer object
         var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
         
         // Adding layer to the map
         map.addLayer(layer);

         var marker = L.marker([18.98936, 73.11926]).addTo(map);
         marker.bindPopup("<b>Panvel Station.").openPopup();
      </script>
</div> 