<?php 
namespace App;
session_start();
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: GET");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// header("Content-Type: application/json; charset=UTF-8");

require_once 'vendor/autoload.php';
require 'helpers.php';
use PDO;
use App\Config;
use App\Player;

// clean up data
$name = clean_input($uri);

// connect to DB
$conn = (new Config()) ->connect();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db = new Database($conn);

// lookup for stats 
$player = new Player($conn, $name);
$stats = $player->show();

if ($stats) {
  $_SESSION['stats'] = $stats;
  $_SESSION['name'] = $name;
  header('Location:/results');
} else {
  header('Location:/');
}



