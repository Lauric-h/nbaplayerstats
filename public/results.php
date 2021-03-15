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
  <p>Age</p>
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
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: labels,
        datasets: [{
            label: 'points',
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: 'rgb(255, 50,  200)',
            data: points.reverse()
        },
        {
          label: 'assists',
          data: assists.reverse(),
          type: 'line',
          backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
        },
        {
          label: 'rebounds',
          data: rebounds.reverse(),
          type: 'line',
          backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
        }
      ]
    },
    // Configuration options go here
    options: {}
});

var ctx = document.getElementById('barChart').getContext('2d');
var chart = new Chart(ctx, {
  // The type of chart we want to create
  type: 'bar',

  // The data for our dataset
  data: {
      labels: labels.reverse(),
      datasets: [{
          label: '3 points %',
          backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: 'rgb(255, 50,  200)',
          data: twoPoints.reverse()
      },
      {
        label: '2 points %', 
        data: threePoints.reverse(), 
        type: 'bar',
        backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
          ],
      },
      {
        label: 'Free throws %',
        data: freeThrows.reverse(),
        type: 'bar',
        backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
          ],
      }
    ]
  },
  // Configuration options go here
  options: {}
});

console.log(doughnutStats['year_2021'][0])

var doughnut = document.getElementById('doughtnutChart2021').getContext('2d');
var chart = new Chart(doughnut, {
  // The type of chart we want to create
  type: 'doughnut',

  // The data for our dataset
  data: {
      labels: ['Assists', 'Turnovers', 'Steals'],
      datasets: [{
          backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: 'rgb(255, 50,  200)',
          data: doughnutStats['year_2021'][0]
      },
    ]
  },
  // Configuration options go here
  options: {}
});

</script>
</html>