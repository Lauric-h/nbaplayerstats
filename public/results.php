<?php session_start();
require_once '/home/lauric/Bureau/dev/nba_scrape/vendor/autoload.php';
dump($_SESSION['stats']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <title>Document</title>
</head>
<body>
  <a href="/">Retour à la recherche</a>
  <h1><?= $_SESSION['name']; ?></h1>
  <p><?= $_SESSION['stats']['year_2021']['age']; ?> ans</p>
  <p>Team</p>

  <canvas id="lineChart"></canvas>
  <canvas id="barChart"></canvas>
  <canvas id="doughtnutChart2021"></canvas>
  <canvas id="doughtnutChart2020"></canvas>
  <canvas id="doughtnutChart2019"></canvas>
  <canvas id="doughtnutChart2018"></canvas>
  <canvas id="doughtnutChart2017"></canvas>

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

  console.log(labels);

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
            backgroundColor: '#5A9A5F',
            fill: false,
        },
        {
          label: 'assists',
          borderColor: '#003f5c',
          data: assists.reverse(),
          backgroundColor: '#003f5c',
          fill: false,
        },
        {
          label: 'rebounds',
          borderColor: '#ff7c43',
          data: rebounds.reverse(),
          backgroundColor: '#ff7c43',
          fill: false,
        }
      ]
    },
});

var ctx = document.getElementById('barChart').getContext('2d');
var chart = new Chart(ctx, {
  type: 'bar',
  data: {
      labels: labels.reverse(),
      datasets: [{
          label: '2 points %',
          backgroundColor: '#ec4646',
          data: twoPoints.reverse()
      },
      {
        label: '3 points %', 
        data: threePoints.reverse(), 
        backgroundColor: '#FDE74C',
      },
      {
        label: 'Free throws %',
        data: freeThrows.reverse(),
        backgroundColor: '#51c2d5',
      }
    ]
  },
  options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
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
});
</script>
</html>