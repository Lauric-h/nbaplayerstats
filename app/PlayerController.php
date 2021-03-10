<?php
namespace App;
require_once '/home/lauric/Bureau/dev/nba_scrape/vendor/autoload.php';
require 'helpers.php';
use PDO;
use App\Config;
use App\Player;
use function App\test_input;


$name = explode('=', $uri['query']);
$name = ucwords(test_input($name[1]));

$conn = (new Config()) ->connect();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db = new Database($conn);
$player = new Player($conn, $name);
dump($player->name);
die();

$stats = $player->show();


die();

if ($stats) {
  // on retourne en json les stats
} else {
  // on retourne la home avec un message d'erreur
  header('Location:/homepage.php');
}



