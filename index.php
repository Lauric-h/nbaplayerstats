<?php
// Front controller 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if ($uri[1] !== 'player') {
  header("HTTP/1.1 404 Not Found");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['page'])) {
        switch($_GET['page']) {
            case // /api/player/nomdujoueur:
              // call for playercontroller
              include 'app/PlayerController.php';
              break;

            default:
              include "public/homepage.php";
        }
    } else {
      include "public/homepage.php";
    }
} 
else if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  header("HTTP/1.1 404 Not Found");
}