<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type = "text/css" href = "media/css/main/navbar.css"/>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <nav>
      <ul>
<li class="logo"><a href="index.php"> Online Crime Reporting</a></li>

<li class="items"><a href="Login.php">Login</a></li>
<li class="items"><a href="signup.php">Register</a></li>
<li class="items"><a href="contactus.php">Contact</a></li>
<li class="items"><a href="aboutus.php">About Us</a></li>
<li class="btn"><a href="#"><i class="fas fa-bars"></i></a></li>
</ul>
</nav>
    <script>
      $(document).ready(function(){
        $('.btn').click(function(){
          $('.items').toggleClass("show");
          $('ul li').toggleClass("hide");
        });
      });
    </script>
  </body>
</html>
