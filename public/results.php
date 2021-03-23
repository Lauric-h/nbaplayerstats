<?php session_start();
require_once 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
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
  <!-- chart lib -->
  <!-- <script src="/node_modules/chart.js/dist/Chart.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

  <title>NBA player stats</title>
</head>

<body>
  <div class="wrapper">
    <a href="/" class="button">Retour à la recherche</a>
    <div class="header">
      <h1><?= $_SESSION['name']; ?></h1>
      <p class="info" id="age"><span class="accent"><?= $_SESSION['stats']['year_2021']['age']; ?></span> ans</p>
      <p class="info" id="team"><span class="accent"><?= $_SESSION['stats']['year_2021']['team'] ?? 'Retraité'; ?></span> </p>
    </div>
  </div>

  <div class="container">
    <div class="card reveal"><canvas id="lineChart"></canvas></div>
    <div class="card reveal"><canvas id="barChart"></canvas></div>
    <!-- <h2 class="reveal">Différences passes / perte de balle / interceptions</h2> -->
    <div class="card reveal doughnutCard2021"><canvas id="doughnutChart2021"></canvas></div>
    <div class="grid reveal">
      <div class="grid-container card reveal doughnutCard2020"><canvas id="doughnutChart2020"></canvas></div>
      <div class="grid-container card reveal doughnutCard2019"><canvas id="doughnutChart2019"></canvas></div>
      <div class="grid-container card reveal doughnutCard2018"><canvas id="doughnutChart2018"></canvas></div>
      <div class="grid-container card reveal doughnutCard2017"><canvas id="doughnutChart2017"></canvas></div>
    </div>
  </div>

 <footer class="reveal">Made with <i class="fas fa-heart"></i> by Lauric - <a href="https://www.linkedin.com/in/lauric/" target="_blank"><i class="fab fa-linkedin-in"></a></i> <a href="https://github.com/Lauric-h" target="_blank"><i class="fab fa-github"></a></i>
  <div class="terms">
    Les statistiques viennent de
    <a href="https://nba.com" target="_blank">la NBA</a> et 
    <a href="https://www.basketball-reference.com/" target="_blank">Basketball Reference</a>
  </div>
</footer>

</body>

<script>
  // Reveal on load 
  ScrollReveal({ reset: true }).reveal('.reveal', { distance: '200px', delay: 500, origin: 'bottom' });
  
  // charts global configuration
  Chart.defaults.global.defaultFontColor = 'white';

  // get data from PHP sessions
  const player = '<?= $_SESSION['name'] ?>';
  const stats = <?= json_encode($_SESSION['stats']); ?>;
  const labels = Object.keys(stats);
  const years = [];
  for (let i = 0; i < labels.length; i++) {
    years.push((labels[i].replace('year_', '')));
  }
</script>
<script src="public/graph.js"></script>
</html>