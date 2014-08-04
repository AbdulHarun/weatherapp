<?php
/**
* Author: Abdul Harun
* Title: Weather Application
* Description: Basic weather application which uses open weather map's api to gather information
*/

//require the class
require('weather.php');
session_start(); 
//we shall be returning it as json so set the header 
header('Content-Type: application/json');

//define the weather class and add our variables to initialise it
$weather = new Weather($_GET['searchBy'],$_GET['searchTerm']);

//set the default to current if nothing specified
$forecastDays = ( isset($_GET['searchDays']) && $_GET['searchDays'] )? $_GET['searchDays'] : 'current';

//call function through curly braces
$json = $weather->{'search_'.$forecastDays}();

//return the json data back
echo $json;
?>