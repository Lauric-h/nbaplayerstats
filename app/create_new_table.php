<?php
require_once 'vendor/autoload.php';
use App\Config;
use App\Database;

/*
 * Run this only to create new table or update from CSV file
 * CSV downloaded from basketball reference
 */

// change table year accordingly
$table = 'year_2021';
$current_year = 'year_2021';

// connect to DB
$conn = (new Config())->connect();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db = new Database($conn);

/* create new table 
 * uncomment below to create new table
*/
$db->create($table);

// insert data from CSV to DB
$filehandle = fopen('../db/' . $table . '.csv', 'r') or die('error');
while(($row = fgetcsv($filehandle, 0, ',')) !== false) {
  $db->store($table, $row);
}
fclose($filehandle);

// update data from CSV
// $filehandle = fopen('../db/' . $current_year . '.csv', 'r') or die('error');
// while(($row = fgetcsv($filehandle, 0, ',')) !== false) {
//   $db->update($current_year, $row);
//   dump($row);
// }
// fclose($filehandle);




