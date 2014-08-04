
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Weather App</title>

    <?php
      //if we decide to have a login session then we can use this but for now its not needed
      session_start(); 
      //i prefer to do logic above and then echo out the element i want although this may not be ideal.
      $loginElem = "<a href='login.php'> Login </a> <a href='signup.php'> Sign Up </a>";
      //override if we have a user id
      if(isset($_SESSION['userId'])) $loginElem = "<a href='logout.php'> Logout </a>";
         
    ?>

    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="js/handlebars-v1.3.0.js"></script>
    <script type="text/javascript" src="js/moment.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
  </head>

  <body>
    <div class="header">
      <?php echo $loginElem; ?>
    </div>

    <div id="content">
      <div id="searchForm">
      </div>
      <div id="searchResults">
      </div>
    </div>

    <div class="footer">

    </div>
  </body>
</html>
