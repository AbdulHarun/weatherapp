<?php
$url = 'http://' . $_SERVER['SERVER_NAME'];
if($_SERVER['SERVER_NAME'] == 'localhost'){
	$url .= '/weatherapp';
}
echo "<pre>";
echo "\nExpected Successes:\n";
test('city','London,UK', 'current', 1);
test('city','Walsall,UK', '7_days', 7);
test('city','Birmingham,UK', '14_days', 14);

test('postcode','B191Rl', 'current', 1);
test('postcode','B191Rl', '7_days', 7);
test('postcode','B191Rl', '14_days', 14);

test('ip','', 'current', 1);
test('ip','', '7_days', 7);
test('ip','', '14_days', 14);

echo "\n\n\nExpected Fails:\n";
test('city','dfdfdfdf', 'current', 1);
test('city','Walsall,UK', '7_days', 5);
test('city','Birmingham,UK', '14_days', 2);

function test($by, $searchTerm = "", $forcast = "current", $expectedSize = 0){
	global $url;
	echo "\n\n Type: ".$forcast . " search by " . $by . " for ".$searchTerm." with result amount $expectedSize:\n";
	try {
		$queryUrl = $url."/api/search.php?searchBy=$by&searchTerm=$searchTerm&searchDays=$forcast";
		echo " URL Called: $queryUrl";
		$daySearchJson = file_get_contents($queryUrl);
		$daySearch = json_decode($daySearchJson);
		$result = isset($daySearch->list) && count($daySearch->list) == $expectedSize ? "sucess" : "failed";
		echo "\n Result: $result";
		if($result == "failed"){
			echo "\nObject : ";
			var_dump($daySearchJson);
		}
		
	} catch(Exception $e){
		print_r($e);
	}
	sleep(1);
}


?>