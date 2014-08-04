<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Weather App - Signup</title>

    <?php

      session_start();  
      if(isset($_SESSION['userId'])){
        header('Location:index.php');
      }
      include('api/loginclass.php');
      $login = new Login();
      $errorMsg = $login->signup();
    ?>

    <link href="css/style.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <div class="header">
    </div>

    <div id="content">
      <h2>Signup Page</h2>
      <div class="form-container">
        <p class="error-msg"><?php echo $errorMsg ?></p>
        <form action="signup.php" method="post">
          Username: <input type="text" name="username"><br>
          Name: <input type="text" name="name"><br>
          E-mail: <input type="text" name="email"><br>
          Password: <input type="password" name="password"><br>
          <input type="submit">
        </form>
      </div>
    </div>

    <div class="footer">

    </div>
  </body>
</html>
