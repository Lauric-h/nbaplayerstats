<?php

namespace App;

use PDO;
require_once '../vendor/autoload.php';

/**
 * stock les stats par année
 * un objet = un joueur sur une année
 */
class Player {
  /**
   * String name
   * @var string
   */
  public string $name;

  /**
   * Array of stats
   * @var array
   */
  public array $stats;

  private PDO $db;
  private array $seasons = ['year_2021', 'year_2020', 'year_2019', 'year_2018', 'year_2017'];
  private array $years = [];

  /**
   * Constructor
   *
   * @param string $name
   * @param string $year
   * @return void
   */
  public function construct(PDO $db, string $name): void {
    $this->db = $db;
    $this->name = $name;
  }

  /**
   * Search into DB for name
   *
   * @param string $table
   * @return array
   */
  private function find(string $table): array {
    $request = $this->db->prepare('SELECT * FROM ' . $table . ' WHERE name = ? COLLATE NOCASE');
    $request->execute(array($this->name));
    $result = $request->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        $result = null;
    }
    return $result;
  }

  /**
   * Get array of data
   *
   * @return array
   */
  public function show(): array {
    foreach($this->seasons as $season) {
      $result = $this->find($season);
      // remove first two values of array
      for ($i = 0; $i < 2; $i++) {
          array_shift($result);
      }
      if ($result) {
          $this->years[$season] = $result;
      }
    }
    return $this->years;
  }


}