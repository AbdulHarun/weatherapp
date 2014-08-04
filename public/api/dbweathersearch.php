<?php
/**
* 
*/
	class DBWeatherSearch
	{
		
		const DBUSERNAME = "abdulharun";
		const DBPASS = "thispassword";
		private $db;
		function __construct()
		{
			$this->db = new PDO('mysql:host=localhost;dbname=weatherapp;charset=utf8', self::DBUSERNAME, self::DBPASS);
		}

		public function storeResult($user_id = null, $url = null, $json_received = null, $searchBy = null, $searchLocation = null, $searchIp = null){
			//insert the info
		    $sql = "INSERT INTO weather_searches (id, user_id, url, json_received, searchBy, searchLocation, searchIp) ";
		    $sql .= "VALUES ( NULL, :user_id, :url, :json_received, :searchBy, :searchLocation, :searchIp );";
		    $stmt = $this->db ->prepare($sql);

		    $stmt->bindParam(':user_id', $user_id, $this->returnType($user_id, PDO::PARAM_INT));
		    $stmt->bindParam(':url', $url, $this->returnType($url, PDO::PARAM_STR));
		    $stmt->bindParam(':json_received', $json_received, $this->returnType($json_received, PDO::PARAM_STR));
		    $stmt->bindParam(':searchBy', $searchBy, $this->returnType($searchBy, PDO::PARAM_STR));
		    $stmt->bindParam(':searchLocation', $searchLocation, $this->returnType($searchLocation, PDO::PARAM_STR));
		    $stmt->bindParam(':searchIp', $searchIp, $this->returnType($searchIp, PDO::PARAM_STR));

		    $stmt->execute();
		}


		private function returnType($val, $originalType){
			$type = PDO::PARAM_STR;
			if(!$val || !isset($val)){
				$type = PDO::PARAM_NULL;
			}
			return $type;
		}
	}
?>