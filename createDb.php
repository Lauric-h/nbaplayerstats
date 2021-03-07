<?php
require_once 'vendor/autoload.php';
use App\Config;
use App\Database;

$conn = (new Config())->connect();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db = new Database($conn);

$table = 'year_2020';

$db->create($table);

$filehandle = fopen('db/' . $table . '.csv', 'r') or die('error');

while(($row = fgetcsv($filehandle, 0, ',')) !== false) {

    $db->store($table, $row);
}         

fclose($filehandle);


?>