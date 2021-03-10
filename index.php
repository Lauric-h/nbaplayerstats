<?php
// Front controller 

use App\Config;

require_once 'vendor/autoload.php';
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI']);



// dump($uri);
// dump($uri['query']);

// dump($name);
// parameters are only 'player' or nothing
// if ($uri[1] !== 'player' || $uri[1] !== '/') {
//   header("HTTP/1.1 404 Not Found");
//   exit();
// }

// 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  switch($uri['path']) {
    case "": 
      include 'public/homepage.php';
      break;
    case "/player": 
      include "app/PlayerController.php";
      break;
    default: 
      include 'public/homepage.php';
      break;
  }
} else {
  header("HTTP/1.1 404 Not Found", 404);
}
die();



