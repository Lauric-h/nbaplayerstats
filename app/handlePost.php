<?php

// where logic is handled
// need to be refactored properly

require_once '../vendor/autoload.php';
require 'helpers.php';
use App\Config;
use App\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = null;

    if (empty($_POST['name']) || empty($_POST['year'])) {
        $error = 'Veuillez renseigner tous les champs';
    } else {
        $name = test_input($_POST['name']);
        $year = test_input($_POST['year']);

        var_dump($name);
        echo '<br>';
        var_dump($year);
        echo '<br>';

        // Connect to DB
        $conn = (new Config())->connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db = new Database($conn);

        var_dump($db);
        die();

        // Fetch data from DB
        $result = $db->getData($year, $name);
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

        $year_2020 = $db->getData('year_2020', $name);
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

