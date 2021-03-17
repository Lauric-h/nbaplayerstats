<?php
namespace App;
require_once 'vendor/autoload.php';
use PDO;
use PDOException;

/**
 * Class for DB connection
 */
Class Config {
    /**
     * path to DB
     */
    const SQL_PATH = 'db/data.db';

    /**
     * PDO instance
     * @var type
     */
    private ?PDO $pdo = null;


    /**
     * Return an instance of PDO
     *
     * @return PDO
     */
    public function connect (): PDO {
        if ($this->pdo == null) {
            try {
                $this->pdo = new PDO('sqlite:' . self::SQL_PATH);
            } catch (PDOException $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}