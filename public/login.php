<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Weather App - Login</title>

    <?php

     session_start();  
      if(isset($_SESSION['userId'])){
        header('Location:index.php');
      }
      include('api/loginclass.php');
      $login = new Login();
      // $errorMsg = $login->login();
    ?>

    <link href="css/style.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <div class="header">
    </div>

    <div id="content">
      <h2>Login Page</h2>
      <div class="form-container">
        <p class="error-msg"><?php echo $errorMsg ?></p>
        <form action="login.php" method="post">
          Username: <input type="text" name="username"><br>
          Password: <input type="password" name="password"><br>
          <input type="submit">
        </form>
      </div>
    </div>

    <div class="footer">

    </div>
  </body>
</html>