<?php
namespace App;
require_once '/home/lauric/Bureau/dev/nba_scrape/vendor/autoload.php';
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
  dump($stats);
  // on retourne en json les stats
} else {
  // on retourne la home avec un message d'erreur
  header('Location:public/homepage.php');
}



