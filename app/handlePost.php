<?php

/* 
* where logic is handled
* need to be refactored properly
*/ 

require_once '../vendor/autoload.php';
require 'helpers.php';
use App\Config;
use App\Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = null;

    if (empty($_POST['name'])) {
        $error = 'Veuillez renseigner le nom';
    } else {
        $seasons = ['year_2021', 'year_2020', 'year_2019', 'year_2018', 'year_2017'];
        $years = [];

        $name = ucwords(test_input($_POST['name']));
        
        // Connect to DB
        $conn = (new Config())->connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db = new Database($conn);

        foreach($seasons as $season) {
            // dump($year);
            $result = $db->show($season, $name);
            // remove first two values of array
            for ($i = 0; $i < 2; $i++) {
                array_shift($result);
            }
            if ($result) {
                $years[$season] = $result;
            }
        }
        dump($years);
    }   
}
?>

