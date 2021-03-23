// charts global configuration
Chart.defaults.global.defaultFontColor = 'white';

// assign and populate variables for chart data
const points = [];
const assists = [];
const rebounds = [];
const threePoints = [];
const twoPoints = [];
const freeThrows = [];
let doughnutStats = {};

// populate variables with data
for (let i = 0; i < labels.length; i++) {
  // for line chart
  points.push(stats[labels[i]]['pts'])
  assists.push(stats[labels[i]]['ast'])
  rebounds.push(stats[labels[i]]['trb'])
  // for bar chart : transform into percentage
  threePoints.push(stats[labels[i]]['three_pct'] * 100)
  twoPoints.push(stats[labels[i]]['two_pct'] * 100)
  freeThrows.push(stats[labels[i]]['ftp'] * 100)
  // for doughnut chart
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
    }]
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
    }]
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

if (doughnutStats['year_2021']) {
  var doughnut2021 = document.getElementById('doughnutChart2021').getContext('2d');
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
} else {
  document.querySelector('.doughnutCard2021').innerHTML = 'Saison 2020-2021 : Statistiques non disponibles';
}

if (doughnutStats['year_2020']) {
  var doughnut2020 = document.getElementById('doughnutChart2020').getContext('2d');
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
} else {
  document.querySelector('.doughnutCard2020').innerHTML = 'Saison 2019-2020 : Statistiques non disponibles';
}

if (doughnutStats['year_2019'] != undefined) {
  var doughnut2019 = document.getElementById('doughnutChart2019').getContext('2d');
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
} else {
  document.querySelector('.doughnutCard2019').innerHTML = 'Statistiques non disponibles';
}

if (doughnutStats['year_2018']) {
  var doughnut2018 = document.getElementById('doughnutChart2018').getContext('2d');
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
} else {
  document.querySelector('.doughnutCard2018').innerHTML = 'Saison 2017-2018 : Statistiques non disponibles';
}

if (doughnutStats['year_2017']) {
  var doughnut2017 = document.getElementById('doughnutChart2017').getContext('2d');
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
} else {
  document.querySelector('.doughnutCard2017').innerHTML = 'Saison 2016-2017 : Statistiques non disponibles';
}