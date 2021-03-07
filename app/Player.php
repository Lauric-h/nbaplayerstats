<?php

namespace App;
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
   * String year
   * @var string
   */
  public string $year;

  /**
   * Array of stats
   * @var array
   */
  public array $stats;

  /**
   * Constructor
   *
   * @param string $name
   * @param string $year
   * @return void
   */
  public function construct(string $name, string $year): void {
    $this->name = $name;
    $this->year = $year;
  }
}