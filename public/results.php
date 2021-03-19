<?php session_start();
require_once 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;600&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Wallpoet&display=swap" rel="stylesheet"> 
  <script src="https://kit.fontawesome.com/264c9e1633.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
  <script src="/node_modules/chart.js/dist/Chart.js"></script>
  <link rel="stylesheet" href="public/style.css">
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
    <h2 class="reveal">Différences passes / perte de balle / interceptions</h2>
    <div class="card reveal"><canvas id="doughtnutChart2021"></canvas></div>
    <div class="grid reveal">
      <div class="grid-container card reveal"><canvas id="doughtnutChart2020"></canvas></div>
      <div class="grid-container card reveal"><canvas id="doughtnutChart2019"></canvas></div>
      <div class="grid-container card reveal"><canvas id="doughtnutChart2018"></canvas></div>
      <div class="grid-container card reveal"><canvas id="doughtnutChart2017"></canvas></div>
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
    ScrollReveal({ reset: true }).reveal('.reveal', { distance: '200px', delay: 200, origin: 'bottom' });


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
  
  // assign and populate variables for chart data
  const points = [];
  const assists = [];
  const rebounds = [];
  const threePoints = [];
  const twoPoints = [];
  const freeThrows = [];

  let doughnutStats = {};

  for (let i = 0; i < labels.length; i++) {
    // for line chart
    points.push(stats[labels[i]]['pts'])
    assists.push(stats[labels[i]]['ast'])
    rebounds.push(stats[labels[i]]['trb'])
    // for bar chart : transform into percentage
    threePoints.push(stats[labels[i]]['three_pct'] * 100)
    twoPoints.push(stats[labels[i]]['two_pct'] * 100)
    freeThrows.push(stats[labels[i]]['ftp'] * 100)
    // for doughtnut chart
    doughnutStats[labels[i]] = [[stats[labels[i]]['ast'], stats[labels[i]]['tov'], stats[labels[i]]['stl']]];
  }

  // line chart
  var ctx = document.getElementById('lineChart').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: years.reverse(),
        datasets: [{
            label: 'points',
            borderColor: 'rgb(156,252,151)',
            data: points.reverse(),
        },
        {
          label: 'assists',
          borderColor: '#FFCAD4',
          data: assists.reverse(),
        },
        {
          label: 'rebounds',
          borderColor: '#CDF7F6',
          data: rebounds.reverse(),
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Points / Passes / Rebonds',
      },
      scales: {
      yAxes: [{
          ticks: {
              beginAtZero: true,
          }
      }],
    }
  }
});

var ctx = document.getElementById('barChart').getContext('2d');
var chart = new Chart(ctx, {
  type: 'bar',
  data: {
      labels: years,
      datasets: [{
          label: '2 points %',
          backgroundColor: 'rgba(236, 70, 70, .8)',
          data: twoPoints.reverse()
      },
      {
        label: '3 points %', 
        data: threePoints.reverse(), 
        backgroundColor: 'rgba(253, 231, 76, .8)',
      },
      {
        label: 'Free throws %',
        data: freeThrows.reverse(),
        backgroundColor: 'rgba(81, 194, 213, .8)',
      }
    ]
  },
  options: {
    scales: {
      yAxes: [{
          ticks: {
              beginAtZero: true,
          }
      }],
      scaleLabel: {
        display: true,
      }
    },
    title: {
      display: true,
      text: 'Pourcentages au tir',
    },
  }
});

var doughnut2021 = document.getElementById('doughtnutChart2021').getContext('2d');
var chart = new Chart(doughnut2021, {
  type: 'doughnut',
  data: {
      labels: ['Assists', 'Turnovers', 'Steals'],
      datasets: [{
          backgroundColor: ['#BDD358', '#bc5090', '#ffa600'],
          borderColor: ['#BDD358', '#bc5090', '#ffa600'],
          data: doughnutStats['year_2021'][0]
      },
    ]
  },
  options: {
      title: {
        display: true,
        text: 'Saison 2020-2021',
      },
    }
});

var doughnut2020 = document.getElementById('doughtnutChart2020').getContext('2d');
var chart = new Chart(doughnut2020, {
  type: 'doughnut',
  data: {
      labels: ['Assists', 'Turnovers', 'Steals'],
      datasets: [{
        backgroundColor: ['#BDD358', '#bc5090', '#ffa600'],
        borderColor: ['#BDD358', '#bc5090', '#ffa600'],
        data: doughnutStats['year_2020'][0]
      },
    ]
  },
  options: {
      title: {
        display: true,
        text: 'Saison 2019-2020',
      },
    }
});

var doughnut2019 = document.getElementById('doughtnutChart2019').getContext('2d');
var chart = new Chart(doughnut2019, {
  type: 'doughnut',
  data: {
      labels: ['Assists', 'Turnovers', 'Steals'],
      datasets: [{
        backgroundColor: ['#BDD358', '#bc5090', '#ffa600'],
        borderColor: ['#BDD358', '#bc5090', '#ffa600'],
        data: doughnutStats['year_2019'][0]
      },
    ]
  },
  options: {
      title: {
        display: true,
        text: 'Saison 2018-2019',
      },
    }
});

var doughnut2018 = document.getElementById('doughtnutChart2018').getContext('2d');
var chart = new Chart(doughnut2018, {
  type: 'doughnut',
  data: {
      labels: ['Assists', 'Turnovers', 'Steals'],
      datasets: [{
        backgroundColor: ['#BDD358', '#bc5090', '#ffa600'],
        borderColor: ['#BDD358', '#bc5090', '#ffa600'],
        data: doughnutStats['year_2018'][0]
      },
    ]
  },
  options: {
      title: {
        display: true,
        text: 'Saison 2017-2018',
      },
    }
});

var doughnut2017 = document.getElementById('doughtnutChart2017').getContext('2d');
var chart = new Chart(doughnut2017, {
  type: 'doughnut',
  data: {
      labels: ['Assists', 'Turnovers', 'Steals'],
      datasets: [{
        backgroundColor: ['#BDD358', '#bc5090', '#ffa600'],
        borderColor: ['#BDD358', '#bc5090', '#ffa600'],
        data: doughnutStats['year_2017'][0]
      },
    ]
  },
  options: {
      title: {
        display: true,
        text: 'Saison 2016-2017',
      },
    }
});
</script>
</html>