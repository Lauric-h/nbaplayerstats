<?php
    require '../app/handlePost.php';
?>

<!-- only for testing -->

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
        <button type="submit">Go ! </button>
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($error === null || empty($error))) {    
        ?>
            <h2>Stats de <?= $name ?></h2>
            <?php foreach($years as $year): ?>
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
                                <?php foreach($year as $key => $value): ?>
                                    <?php echo "<td>{$value}</td>" ?>
                                <?php endforeach ?>
                            </tr>
                </table>
                <?php $season-- ?>
            <?php endforeach ?>
             
        <?php
        }
    ?>

                               
</body>

<footer>Made with <i class="fas fa-heart"></i> by Lauric</footer>

</html>