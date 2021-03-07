<?php

use App\Config;
use App\Database;
require '../app/handlePost.php';

$conn = (new Config())->connect();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db = new Database($conn);

$table = 'year_2019';

// $db->createTable($table);

$filehandle = fopen('../db/' . $table . '.csv', 'r') or die('error');
$pattern = "/\\.*/m";
while(($row = fgetcsv($filehandle, 0, ',')) !== false) {
    $pattern = "/\\\\.*/m";
    $row[1] = preg_replace($pattern, '', $row[1]);
    var_dump($row[1]);
    echo '<br>';

    $db->insertData($table, $row);
}         

fclose($filehandle);


?>