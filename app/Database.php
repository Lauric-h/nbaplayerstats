<?php
namespace App;

use PDO;

class Database {
    /**
     * PDO object
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Constructor
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Create table
     *
     * @param string $year
     * @return void
     */
    public function create(string $table): void {
        $create = 'CREATE TABLE ' . $table . ' (
            "id"	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
            "name"	TEXT,
            "position"	TEXT,
            "age"	INTEGER,
            "team"	TEXT,
            "games"	INTEGER,
            "games_started"	INTEGER,
            "minutes_per_game"	REAL,
            "fg"	REAL,
            "fga"	REAL,
            "fgp"	REAL,
            "three_made"	REAL,
            "three_attempt"	REAL,
            "three_pct"	REAL,
            "two_made"	REAL,
            "two_attempt"	REAL,
            "two_pct"	REAL,
            "efg"	REAL,
            "ft"	REAL,
            "fta"	REAL,
            "ftp"	REAL,
            "orb"	REAL,
            "drb"	REAL,
            "trb"	REAL,
            "ast"	REAL,
            "stl"	REAL,
            "blk"	REAL,
            "tov"	REAL,
            "pf"	REAL,
            "pts"	REAL)';

        $this->pdo->exec($create);
    }
   
    /**
     * Insert data into table
     *
     * @param string $table
     * @param array $column
     * @return void
     */
    public function store(string $year, array $column): void {
        $name = $this->cleanData($column[1]);
        // replace column[1] by $name

        $this->pdo->exec('INSERT INTO ' . $year .'(`name`, `position`, `age`, `team`, `games`, `games_started`, `minutes_per_game`, `fg`, `fga`, `fgp`, `three_made`, `three_attempt`, `three_pct`, `two_made`, `two_attempt`, `two_pct`, `efg`, `ft`, `fta`, `ftp`, `orb`, `drb`, `trb`, `ast`, `stl`, `blk`, `tov`, `pf`, `pts`) VALUES ("'.$name.'","'.$column[2].'","'.$column[3].'","'.$column[4].'","'.$column[5].'","'.$column[6].'","'.$column[7].'","'.$column[8].'","'.$column[9].'","'.$column[10].'","'.$column[11].'","'.$column[12].'","'.$column[13].'","'.$column[14].'","'.$column[15].'","'.$column[16].'", "'.$column[17].'", "'.$column[18].'", "'.$column[19].'", "'.$column[20].'", "'.$column[21].'", "'.$column[22].'", "'.$column[23].'", "'.$column[24].'", "'.$column[25].'", "'.$column[26].'", "'.$column[27].'", "'.$column[28].'", "'.$column[29].'")');
    }

    /**
     * Get data from DB
     *
     * @param string $name
     * @param string $table
     * @return array or null
     */
    public function index(string $table, string $name): ?array {
        $request = $this->pdo->prepare('SELECT * FROM ' . $table . ' WHERE name = ?');
        $request->execute(array($name));
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            $result = null;
        }
        return $result;
    } 

    /**
     * Helper function to clean up data
     *
     * @param string $name
     * @return string 
     */
    private function cleanData(string $name): string {
        $pattern = "/\\\\.*/m";
        $name = preg_replace($pattern, '', $name);
        return $name;
    }

    /**
     * Update data for current season
     *
     * @param string $year
     * @param array $column
     * @return void
     */
    public function update(string $table, array $column): void {
        $name = $this->cleanData($column[1]);

        $request = $this->pdo->prepare('UPDATE ' . $table . ' SET age = '. $column[1] . ', position = '. $column[2] . ', a = '. $column[2] );

    }

}