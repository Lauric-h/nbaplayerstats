<?php

// for test only : needs to be refactored
use App\Config;
use App\Database;
require '../app/handlePost.php';

// $conn = (new Config())->connect();
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $db = new Database($conn);

// $table = 'year_2021';

// $db->create($table);

// $filehandle = fopen('../db/' . $table . '.csv', 'r') or die('error');

// while(($row = fgetcsv($filehandle, 0, ',')) !== false) {

//     $db->store($table, $row);
// }         

// fclose($filehandle);
?>

<!-- only for display tests -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/264c9e1633.js" crossorigin="anonymous"></script>
    <title>NBA stats</title>
</head>
<body>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <p><?= $error ?></p>
        <label for="name">Nom du joueur</label> 
        <input type="text" name="name" id="name" placeholder="nom du joueur" required>

        <label for="year">Année</label>
        <select name="year" id="year" required>
            <option value="">-- sélectionner --</option>
            <option value="year_2020">2019-2020</option>
            <option value="year_2021">2020-2021</option>
        </select>

        <button type="submit">Go ! </button>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($error === null || empty($error))) {
        ?>
             <div>
                <h2>Stats de <?= $name ?> <i class="fas fa-basketball-ball"></i></h2>

                <table>
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>Age</th>
                            <th>Team</th>
                            <th>G</th>
                            <th>GS</th>
                            <th>MP</th>
                            <th>FG</th>
                            <th>FGA</th>
                            <th>FG%</th>
                            <th>3P</th>
                            <th>3PA</th>
                            <th>3P%</th>
                            <th>2P</th>
                            <th>2PA</th>
                            <th>2P%</th>
                            <th>eF%</th>
                            <th>FT</th>
                            <th>FTA</th>
                            <th>FT%</th>
                            <th>ORB</th>
                            <th>DRB</th>
                            <th>TRB</th>
                            <th>AST</th>
                            <th>STL</th>
                            <th>BLK</th>
                            <th>TOV</th>
                            <th>PF</th>
                            <th>PTS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                foreach($result as $key => $value) {
                                    echo "<td>{$value}</td>";
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>Age</th>
                            <th>Team</th>
                            <th>G</th>
                            <th>GS</th>
                            <th>MP</th>
                            <th>FG</th>
                            <th>FGA</th>
                            <th>FG%</th>
                            <th>3P</th>
                            <th>3PA</th>
                            <th>3P%</th>
                            <th>2P</th>
                            <th>2PA</th>
                            <th>2P%</th>
                            <th>eF%</th>
                            <th>FT</th>
                            <th>FTA</th>
                            <th>FT%</th>
                            <th>ORB</th>
                            <th>DRB</th>
                            <th>TRB</th>
                            <th>AST</th>
                            <th>STL</th>
                            <th>BLK</th>
                            <th>TOV</th>
                            <th>PF</th>
                            <th>PTS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                foreach($year_2020 as $key => $value) {
                                    echo "<td>{$value}</td>";
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php
        }
    ?>

    
                            
    
</body>

<footer>Made with <i class="fas fa-heart"></i> by Lauric</footer>

</html>