<?php session_start();
require_once 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;600&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Wallpoet&display=swap" rel="stylesheet"> 
  <script src="https://kit.fontawesome.com/264c9e1633.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="public/style.css">
  <title>Document</title>
</head>
<body>
  <div class="wrapper">
  <a href="/" class="button">Retour à la recherche</a>
    <div class="header">
      <h1><?= $_SESSION['name']; ?></h1>
      <p class="info" id="age"><span class="accent"><?= $_SESSION['stats']['year_2021']['age']; ?></span> ans</p>
      <p class="info" id="team"><span class="accent"><?= $_SESSION['stats']['year_2021']['team']; ?></span> </p>
    </div>
  </div>

  <div class="container">
    <div class="card"><canvas id="lineChart"></canvas></div>
    <div class="card"><canvas id="barChart"></canvas></div>
    <h2>Différences passes / perte de balle / interceptions</h2>
    <div class="card"><canvas id="doughtnutChart2021"></canvas></div>
    <div class="grid">
      <div class="grid-container card"><canvas id="doughtnutChart2020"></canvas></div>
      <div class="grid-container card"><canvas id="doughtnutChart2019"></canvas></div>
      <div class="grid-container card"><canvas id="doughtnutChart2018"></canvas></div>
      <div class="grid-container card"><canvas id="doughtnutChart2017"></canvas></div>
    </div>
 </div>
 <footer>Made with <i class="fas fa-heart"></i> by Lauric</footer>

</body>
<script>
  // get data from PHP sessions
  const player = '<?= $_SESSION['name'] ?>';
  const stats = <?= json_encode($_SESSION['stats']); ?>;
  const labels = Object.keys(stats);

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
        labels: labels,
        datasets: [{
            label: 'points',
            borderColor: '#5A9A5F',
            data: points.reverse(),
            backgroundColor: 'rgba(90, 154, 95, .2)',
        },
        {
          label: 'assists',
          borderColor: '#003f5c',
          data: assists.reverse(),
          backgroundColor: 'rgba(0, 63, 92, .2)',
        },
        {
          label: 'rebounds',
          borderColor: '#ff7c43',
          data: rebounds.reverse(),
          backgroundColor: 'rgba(255, 124, 67, .2)',
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Points / Passes / Rebonds',
        fontColor: 'white'
      },
      legend: {
        labels: {
          fontColor: 'white'
        }
      }
    }
});

var ctx = document.getElementById('barChart').getContext('2d');
var chart = new Chart(ctx, {
  type: 'bar',
  data: {
      labels: labels.reverse(),
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
        fontColor: '#fff'
      }
    },
    title: {
      display: true,
      text: 'Pourcentages au tir',
      fontColor: 'white'
    },
    legend: {
      labels: {
        fontColor: 'white'
      }
    },
  }
});

var doughnut2021 = document.getElementById('doughtnutChart2021').getContext('2d');
var chart = new Chart(doughnut2021, {
  type: 'doughnut',
  data: {
      labels: ['Assists', 'Turnovers', 'Steals'],
      datasets: [{
          backgroundColor: ['#003f5c', '#bc5090', '#ffa600'],
          borderColor: 'rgb(255, 50,  200)',
          data: doughnutStats['year_2021'][0]
      },
    ]
  },
  options: {
      title: {
        display: true,
        text: 'Saison 2020-2021',
        fontColor: 'white'
      },
      legend: {
        labels: {
          fontColor: 'white'
        }
      }
    }
});

var doughnut2020 = document.getElementById('doughtnutChart2020').getContext('2d');
var chart = new Chart(doughnut2020, {
  type: 'doughnut',
  data: {
      labels: ['Assists', 'Turnovers', 'Steals'],
      datasets: [{
        backgroundColor: ['#003f5c', '#bc5090', '#ffa600'],
        borderColor: 'rgb(255, 50,  200)',
        data: doughnutStats['year_2020'][0]
      },
    ]
  },
  options: {
      title: {
        display: true,
        text: 'Saison 2019-2020',
        fontColor: 'white',
      },
      legend: {
        labels: {
          fontColor: 'white'
        }
      }
    }
});

var doughnut2019 = document.getElementById('doughtnutChart2019').getContext('2d');
var chart = new Chart(doughnut2019, {
  type: 'doughnut',
  data: {
      labels: ['Assists', 'Turnovers', 'Steals'],
      datasets: [{
          backgroundColor: ['#003f5c', '#bc5090', '#ffa600'],
          borderColor: 'rgb(255, 50,  200)',
          data: doughnutStats['year_2019'][0]
      },
    ]
  },
  options: {
      title: {
        display: true,
        text: 'Saison 2018-2019',
        fontColor: 'white'
      },
      legend: {
        labels: {
          fontColor: 'white'
        }
      }
    }
});

var doughnut2018 = document.getElementById('doughtnutChart2018').getContext('2d');
var chart = new Chart(doughnut2018, {
  type: 'doughnut',
  data: {
      labels: ['Assists', 'Turnovers', 'Steals'],
      datasets: [{
          backgroundColor: ['#003f5c', '#bc5090', '#ffa600'],
          borderColor: 'rgb(255, 50,  200)',
          data: doughnutStats['year_2018'][0]
      },
    ]
  },
  options: {
      title: {
        display: true,
        text: 'Saison 2017-2018',
        fontColor: 'white'
      },
      legend: {
        labels: {
          fontColor: 'white'
        }
      }
    }
});

var doughnut2017 = document.getElementById('doughtnutChart2017').getContext('2d');
var chart = new Chart(doughnut2017, {
  type: 'doughnut',
  data: {
      labels: ['Assists', 'Turnovers', 'Steals'],
      datasets: [{
          backgroundColor: ['#003f5c', '#bc5090', '#ffa600'],
          borderColor: 'rgb(255, 50,  200)',
          data: doughnutStats['year_2017'][0]
      },
    ]
  },
  options: {
      title: {
        display: true,
        text: 'Saison 2016-2017',
        fontColor: 'white'
      },
      legend: {
        labels: {
          fontColor: 'white'
        }
      }
    }
});
</script>
</html>