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
            "pts"	REAL,
            "year" INTEGER)';

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
     * Helper function to clean up data
     *
     * @param string $name
     * @return string 
     */
    private function cleanData(string $name): string {
        $pattern = "/\\\\.*/m";
        $name = preg_replace($pattern, '', $name);
        $name = str_replace('č', 'c', $name);
        $name = str_replace('ć', 'c', $name);
        $name = str_replace('ý', 'y', $name);
        $name = str_replace('á', 'a', $name);
        $name = str_replace('Š', 'S', $name);
        $name = str_replace('š', 's', $name);

        return $name;
    }

    /**
     * Update data from updated CSV
     *
     * @param string $year
     * @param array $column
     * @return void
     */
    public function update(string $year, array $column) {
        $name = $this->cleanData($column[1]);
        $this->pdo->exec('UPDATE ' . $year .' SET `name` = ' . $name . ',  `position` = ' . $column[2] . ', `age` = ' . $column[3] . ', `team` = ' . $column[4] . ', `games` = ' . $column[5] . ', `games_started` = ' . $column[6] . ', `minutes_per_game` = ' . $column[7] . ', `fg` = ' . $column[8] . ', `fga` = ' . $column[9] . ', `fgp` = ' . $column[10] . ', `three_made` = ' . $column[11] . ', `three_attempt` = ' . $column[12] . ', `three_pct` = ' . $column[13] . ', `two_made` = ' . $column[14] . ', `two_attempt` = ' . $column[15] . ', `two_pct` = ' . $column[16] . ', `efg` = ' . $column[17] . ', `ft` = ' . $column[18] . ', `fta` = ' . $column[19] . ', `ftp` = ' . $column[20] . ', `orb` = ' . $column[21] . ', `drb` = ' . $column[22] . ', `trb` = ' . $column[23] . ', `ast` = ' . $column[24] . ', `stl` = ' . $column[25] . ', `blk` = ' . $column[26] . ', `tov` = ' . $column[27] . ', `pf` = ' . $column[28] . ', `pts` = ' . $column[29]);
    }
} 