<?php
/**
* Author: Abdul Harun
* Title: Weather Application
* Description: Basic weather application which uses open weather map's api to gather information (similar to a controller)
*/

include('dbweathersearch.php');
class Weather
{
  private $searchLocation;
  private $searchBy;
  private $searchIp;
  private $cityByIp;
  const BASEURL = 'http://api.openweathermap.org/data/2.5/forecast/daily';
  const APPID = 'b556ab78f328a1f5827e606870e25570';

  //were using these to initiate the class. its not needed but i'd rather start with some data
  //TODO: consider if we need to override values if so add configure future functions to do so
  function __construct($searchBy, $searchLocation = null) {

    //values which will be needed later
    $this->searchBy     = $searchBy;
    $this->searchLocation   = $searchLocation;

    //regardless we want to grab the users ip for now just incase we wish to do soemthing with it
    $this->searchIp     = $this->get_client_ip();
 
    // since development was done with xampp, this if statement was needed to add a fall back.
    // once in this if statement, it would grab the users city through a website to get the the details
    if($this->searchIp !== '127.0.0.1'){

      //lets grab the city just incase we need it and it can be 
      $details = json_decode(file_get_contents("http://ipinfo.io/{$this->searchIp}/json"));
      $this->cityByIp = $details->city.",".$details->country;
    } else {

      //mainly for testing
      $this->cityByIp = "birmingham,uk";
    }   

  }

  public function search_current(){
    //grab the base url for the api and then add the query data which is the location
    $url = self::BASEURL.'?q=';
    $city = ($this->searchBy == 'ip') ? urlencode($this->cityByIp) : urlencode($this->searchLocation);
    $url .= $city;

    //generate a timestamp so we it doesnt cache
    $date = new DateTime();

    //for this one it wasn't needed but i've used this to keep it consistant with the others
    $url .= '&units=metric&cnt=1&mode=json&t'.$date->getTimestamp();
    $content = file_get_contents($url);

    $user_id = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;


    $DBSearch = new DBWeatherSearch();
    $DBSearch->storeResult($user_id, $url, $content, $this->searchBy, $city, $this->searchIp);
    return $content;
  }

  // This function isnt needed and could have been produced by passing the number to the function above
  // however this is used just to show how to access through function through curly braces
  public function search_7_days(){
    //grab the base url for the api and then add the query data which is the location
    $url = self::BASEURL.'?q=';
    $city = ($this->searchBy == 'ip') ? urlencode($this->cityByIp) : urlencode($this->searchLocation);
    $url .= $city;

    //generate a timestamp so we it doesnt cache
    $date = new DateTime();

    //now add the peroid as 7 and return json
    $url .= '&units=metric&cnt=7&mode=json&t'.$date->getTimestamp();
    $content = file_get_contents($url);

    $user_id = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
    $DBSearch = new DBWeatherSearch();
    $DBSearch->storeResult($user_id, $url, $content, $this->searchBy, $city, $this->searchIp);
    return $content;
  }

  // This function isnt needed and could have been produced by passing the number to the function search_current
  // however this is used just to show how to access through function through curly braces
  public function search_14_days(){
    //grab the base url for the api and then add the query data which is the location
    $url = self::BASEURL.'?q=';
    $city = ($this->searchBy == 'ip') ? urlencode($this->cityByIp) : urlencode($this->searchLocation);
    $url .= $city;

    //generate a timestamp so we it doesnt cache
    $date = new DateTime();

    //now add the peroid as 14 and return json
    $url .= '&units=metric&cnt=14&mode=json&t'.$date->getTimestamp();
    $content = file_get_contents($url);

    $user_id = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
    $DBSearch = new DBWeatherSearch();
    $DBSearch->storeResult($user_id, $url, $content, $this->searchBy, $city, $this->searchIp);
    return $content;
  }

  private function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }
}
?>