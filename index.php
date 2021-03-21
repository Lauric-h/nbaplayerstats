<?php
// Front controller 
require_once 'vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");

$uri = parse_url($_SERVER['REQUEST_URI']);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  switch($uri['path']) {
    case "": 
      include 'public/homepage.php';
      break;
    case "/home": 
      include "app/PlayerController.php";
      break;
    case "/player": 
      include "app/PlayerController.php";
      break;
    case "/results": 
      include "public/results.php";
      break;
    case "/all": 
      include "public/all.php";
      break;
    default: 
      include 'public/homepage.php';
      break;
  }
} else {
  header("HTTP/1.1 404 Not Found", 404);
  exit();
}




