<?php
	/**
	* 
	*/
	class Login
	{
		const DBUSERNAME = "abdulharun";
		const DBPASS = "thispassword";
		private $db;
		//live: host=127.12.20.130;port=3306
		//dev:host=localhost
		function __construct()
		{
			$this->db = new PDO('mysql:host=127.12.20.130;port=3306;dbname=weatherapp;charset=utf8', self::DBUSERNAME, self::DBPASS);
		}

		function signup(){
			//i like having it in a variable as opposed to having the _SERVER array in the if statement. 
			$isPost = ($_SERVER['REQUEST_METHOD'] === 'POST');
			$errorMsg = null;
			if($isPost){
				if($this->isEmpty($_POST['name']) || $this->isEmpty($_POST['email']) || $this->isEmpty($_POST['username']) || $this->isEmpty($_POST['password'])){
				  $errorMsg = "Please make sure all fields are filled in";
				} else {
				  $username = $_POST['username'];
				  $email = $_POST['email'];
				  $name = $_POST['name'];
				  //save the password as md5
				  $password = md5($_POST['password']);

				  $sql = "SELECT * From weather_users WHERE username = :username";
				  $stmt = $this->db->prepare($sql);
				  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
				  $stmt->execute();
				  $affected_rows = $stmt->rowCount();

				  if($affected_rows > 0){
				    $errorMsg = "Username taken";
				  } else {
				  	//insert the user info
				    $sql = "INSERT INTO weather_users (id, username, password, name, email) VALUES ( NULL, :username, :password, :name, :email );";
				    $stmt = $this->db ->prepare($sql);
				    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
				    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
				    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
				    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
				    $stmt->execute();
				    //grab the id saved and store in session
				    $id = $this->db ->lastInsertId(); 
				    $_SESSION['userId'] = $id;
				    //redirect to index
				    header('Location:index.php');
				  }

				}
			}
			return $errorMsg;
		}

		function login(){
			$isPost = ($_SERVER['REQUEST_METHOD'] === 'POST');
			$errorMsg = null;
			if($isPost){
				if($this->isEmpty($_POST['username']) || $this->isEmpty($_POST['password'])){
				  $errorMsg = "Please make sure all fields are filled in";
				} else {
				  $username = $_POST['username'];
				  //save the password as md5
				  $password = md5($_POST['password']);

				  $sql = "SELECT * From weather_users WHERE username = :username";
				  $stmt = $this->db->prepare($sql);
				  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
				  $stmt->execute();
				  $result = $stmt->fetch(PDO::FETCH_OBJ);

				  if(!$result){
				    $errorMsg = "Sorry creditials dont match";
				  } else {
				    $_SESSION['userId'] = $result->id;
				    //redirect to index
				    header('Location:index.php');
				  }

				}
			}
			return $errorMsg;
		}

		private function isEmpty($item){
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

	}
?>