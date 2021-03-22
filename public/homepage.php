<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;600&family=Wallpoet&display=swap" rel="stylesheet"> 
    <!-- icons -->
    <script src="https://kit.fontawesome.com/264c9e1633.js" crossorigin="anonymous"></script>
    <!-- reveal lib -->
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    <!-- style -->
    <link rel="stylesheet" href="public/style.css">

    <title>NBA player stats</title>
</head>

<body>
  <main>
    <form action="<?= htmlspecialchars("/player");?>" method="get" class="reveal">
      <div class="search-bar">
        <input aria-label="nom du joueur" type="text" name="name" id="name" placeholder="Nom du joueur" required>
        <ul id="nameList"></ul>
        <button type="submit">Go ! </button>
      </div>
    </form>
  </main>

<footer>Made with <i class="fas fa-heart"></i> by Lauric - <a href="https://www.linkedin.com/in/lauric/" target="_blank"><i class="fab fa-linkedin-in"></a></i> <a href="https://github.com/Lauric-h" target="_blank"><i class="fab fa-github"></a></i></footer>

<script>
  ScrollReveal().reveal('.reveal', { distance: '200px', delay: 500, origin: 'bottom' });
</script>
<script src="public/autocomplete.js"></script>

</body>
</html>   