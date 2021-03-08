<?php
require_once '../vendor/autoload.php';
require 'helpers.php';
use App\Player;
use App\Config;

use function App\test_input;

$conn = (new Config)->connect;
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$name = ucwords(test_input($_GET['name']));
$player = new Player($conn, $name);
$stats = $player->show();
if ($stats) {
  // on retourne en json les stats
} else {
  // on retourne la home avec un message d'erreur
}



