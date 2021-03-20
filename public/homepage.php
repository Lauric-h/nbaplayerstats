<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;600&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Wallpoet&display=swap" rel="stylesheet"> 
    <script src="https://kit.fontawesome.com/264c9e1633.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    <link rel="stylesheet" href="public/style.css">
    <title>NBA player stats</title>
</head>

<body>

  <main>
    <form action="<?= htmlspecialchars("/player");?>" method="get" class="reveal">
      <p><?= $error ?></p>
      <div class="search-bar">
        <input aria-label="nom du joueur" type="text" name="name" id="name" placeholder="Nom du joueur" required>
        <div id="nameList"></div>
      </div>
      <button type="submit">Go ! </button>
    </form>
  </main>

<footer>Made with <i class="fas fa-heart"></i> by Lauric - <a href="https://www.linkedin.com/in/lauric/" target="_blank"><i class="fab fa-linkedin-in"></a></i> <a href="https://github.com/Lauric-h" target="_blank"><i class="fab fa-github"></a></i></footer>

<script>
  ScrollReveal().reveal('.reveal', { distance: '200px', delay: 200, origin: 'bottom' });

  const endpoint = '/all';
  const names = [];

  fetch(endpoint)
  .then(blob => blob.json()
  .then(data => names.push(...data)));

  function findMatches(wordToMatch, names) {

    return names.filter(names => {

      const regex = new RegExp(wordToMatch, 'gi');
      return names.name.match(regex)
    })
  }

  function displayMatches() {
    const matchArray = findMatches(this.value, names);
    const html = matchArray.map(names => {
      return `
        <li>
          <span class="nameAhead">${names.name}</span>
        </li>
      `;
    }).join('');
    nameList.innerHTML = html;
  }

  const searchInput = document.querySelector('#name');
  const nameList = document.querySelector('#nameList');

  searchInput.addEventListener('change', displayMatches);
  searchInput.addEventListener('keyup', displayMatches);

</script>

</body>
</html>   