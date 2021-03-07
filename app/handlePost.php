<?php

// where logic is handled
// need to be refactored properly

require_once '../vendor/autoload.php';
require 'helpers.php';
use App\Config;
use App\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = null;

    if (empty($_POST['name'])) {
        $error = 'Veuillez renseigner le nom';
    } else {
        $name = test_input($_POST['name']);

        // Connect to DB
        $conn = (new Config())->connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db = new Database($conn);

        // Fetch data from DB
        $result = $db->index($year, $name);
        if (!$result) {
            $error = "Joueur non trouvé";
            $name = ""; // reset variable
            $year = ""; // reset variable
        } else {
            // remove first two values of array
            for ($i = 0; $i < 2; $i++) {
                array_shift($result);
            }
        }

        $year_2020 = $db->index('year_2020', $name);
        if (!$year_2020) {
            $error = "Joueur non trouvé";
            $name = ""; // reset variable
            $year = ""; // reset variable
        } else {
            // remove first two values of array
            for ($i = 0; $i < 2; $i++) {
                array_shift($year_2020);
            }
        }
    }   
}
?>

