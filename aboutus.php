<html>
<head>
	 <link rel="stylesheet" href="media/css/main/aboutus.css" />
</head>
<style>
  .parallax {
    background-image: url("https://mediaserver.goepson.com/ImConvServlet/imconv/ab6b956e0863668f3adcca5683a4c6816908e6b2/original?use=productpictures&assetDescr=001-1400X570");
    min-height: 400px; 
    max-width:100%;
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: auto;
  }

  button{
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
  }
  

    .column {
      float: left;
      width: 50%;
      padding-left:3em;
    }
   
    @media only screen and (max-width: 830px){
      .column {
        float: left;
        width: 70%;
        padding-left:3em;
        padding-bottom:2em;
        
      }

      iframe{
        width:400;
        height:350;
      }

      #video1{
        width:400;
        height:350;
      }

    }

    @media only screen and (min-width: 420px) and (max-width: 830px){
      .column {
        float: left;
        width: 70%;
        padding-left:3em;
        padding-bottom:2em;
        padding-right:2em;
      }

      iframe{
        width:300;
        height:350;
      }

      #video1{
        width:350;
        height:350;
      }

    }

    @media only screen and (max-width: 419px){
      .column {
        float: left;
        width: 100%;
        padding-left:10px;
        padding-bottom:2em;
        
      }

      iframe{
        padding-top:20px;
        width:100%;
        padding-right:10px;
      }

      #video1{
        width:270;
        height:320;
      }

    }

  
   
</style>
<body>
<?php include('navbar.php'); ?>  
 <div class="parallax"></div>
<div class="wrapper">
  <h1>Our Team</h1>
  <div class="team">
    <div class="team_member">
      <div class="team_img">
        <img src="https://i.imgur.com/2pGPLrl.png" alt="Team_image">
      </div>
      <h3>Aman</h3>
      <p class="role">Web Designer</p>
      <p>Hello everyone I am Aman Singh Student of IT and i have my Intreset in web Designing and Development</p>
    </div>
    <div class="team_member">
      <div class="team_img">
        <img src="https://i.imgur.com/2pGPLrl.png" alt="Team_image">
      </div>
      <h3>Clemen Belly</h3>
      <p class="role">Web Designer</p>
      <p>Hello everyone I am Clemen Belly student of IT and i have my intreset in web Dessigning and Development</p></div>
    <div class="team_member">
      <div class="team_img">
        <img src="https://i.imgur.com/2Necikc.png" alt="Team_image">
      </div>
      <h3>Shayan Wangde</h3>
      <p class="role">Web Developer</p>
      <p>Hello everyone I am Shayan Wangde student of IT and i have my intreset in web Designing and Development</p>
    </div>
     <div class="team_member">
      <div class="team_img">
        <img src="https://i.imgur.com/2Necikc.png" alt="Team_image">
      </div>
      <h3>Kaustubh Giri</h3>
      <p class="role">Web Developer</p>
      <p>Hello everyone I am Kaustubh Giri student of IT and i have my intreset in web Designing and Development</p>
    </div>
  </div>
</div>
  <!-- <div style="height:48px;background-color:#4f3826;font-size:36px;text-align:center;padding:10px ">Our Location</div> -->
  <div class="location">
  <div class="row">
		<div class="column" style="text-align:center;">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3772.6694342833935!2d73.1254814144276!3d18.990200987137236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7e866de88667f%3A0xc1c5d5badc610f5f!2sPillai%20College%20of%20Engineering%2C%20New%20Panvel!5e0!3m2!1sen!2sin!4v1602920513708!5m2!1sen!2sin" width="450" height="400" frameborder="3" style="border:1;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>	
    </div>
    </div>
    <div class="column" style="text-align:center;">
         
          <video id="video1">
            <source src="file_example_MP4_640_3MG.mp4" type="video/mp4">
          </video><br>
          <button  onclick="playPause()">Play/Pause</button> 
          <button  onclick="makeBig()">Big</button>
          
          <button onclick="makeNormal()">Normal</button><br><br>
          <br>
    </div>
  </div>



<script> 
var myVideo = document.getElementById("video1"); 

function playPause() { 
  if (myVideo.paused) 
    myVideo.play(); 
  else 
    myVideo.pause(); 
} 

function makeBig() { 
    myVideo.width = 560; 
} 


function makeNormal() { 
    myVideo.width = 450; 
} 
</script> 


</body>
</html>


