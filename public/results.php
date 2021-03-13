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

  <canvas id="myChart"></canvas>
  
</body>

<script>
  let player = '<?= $_SESSION['name'] ?>';
  console.log(player);
  let stats = <?= json_encode($_SESSION['stats']); ?>;
  console.log(stats);
  const labels = Object.keys(stats);
  const points = [];
  const assists = [];
  const rebounds = [];

  for (let i = 0; i < labels.length; i++) {
    points.push(stats[labels[i]]['pts'])
    assists.push(stats[labels[i]]['ast'])
    rebounds.push(stats[labels[i]]['trb'])
  }

  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: labels.reverse(),
        datasets: [{
            label: 'points',
            // backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: points.reverse()
        },
        {
          label: 'assists',
          data: assists.reverse(),
          type: 'line'
        },
        {
          label: 'rebounds',
          data: rebounds.reverse(),
          type: 'line'
        }
      ]
    },
    // Configuration options go here
    options: {}
});
</script>
</html>