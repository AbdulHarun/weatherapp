<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Weather App - Signup</title>

    <?php
      // if we decide to have a login session then we can use this but for now its not needed
      session_start();  
      $errorMsg = null;
      //i like having it in a variable as opposed to having the _SERVER array in the if statement. 
      $isPost = ($_SERVER['REQUEST_METHOD'] === 'POST');
      if($isPost){
        if(isEmpty($_POST['name']) || isEmpty($_POST['email']) || isEmpty($_POST['username']) || isEmpty($_POST['password'])){
          $errorMsg = "Please make sure all fields are filled in";
        } else {
          
        }
      }


      function isEmpty($item){
        //since my server uses 5.4 i can not use trim inside empty. Also i need empty since it can catch undefined
        //if item has returned as empty return true stating it 
        $return = empty($item);
        if($return) return true;

        //now we check to make sure the item has not been padded with spaces. This could not work since trim can not work on
        //undefined variables which this maybe
        $item = trim($item);
        $return = empty($item);
        if($return) return true;
      }

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
          Password: <input type="text" name="password"><br>
          <input type="submit">
        </form>
      </div>
    </div>

    <div class="footer">

    </div>
  </body>
</html>
