<!-- Ici on renvoie la vue de la home -->
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
  <form action="<?= htmlspecialchars("/player/{name}");?>" method="get">
    <p><?= $error ?></p>
    <label for="name">Nom du joueur</label> 
    <input type="text" name="name" id="name" placeholder="nom du joueur" required>
    <button type="submit">Go ! </button>
  </form>
                               
</body>

<footer>Made with <i class="fas fa-heart"></i> by Lauric</footer>

</html>