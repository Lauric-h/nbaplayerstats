<?php 
namespace App;
session_start();
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

// redirect
if ($stats) {
  $_SESSION['stats'] = $stats;
  $_SESSION['name'] = $name;
  header('Location:/results');
} else {
  header('Location:/');
}



