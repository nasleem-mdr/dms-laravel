function loadData() {

  //get total of units/agency
let elTotalAgency = document.getElementById('total_agencies');

fetch('/get/total/agencies')
  .then(response => response.json())
  .then(data => {
    elTotalAgency.innerHTML = data;
  });

let elTotalEmployee = document.getElementById('total_employee');

fetch('/get/total/employees')
  .then(response => response.json())
  .then(data => {
    elTotalEmployee.innerHTML = data;
  });

let agencies = [];
let archives = [];

fetch('/get/total/agency/archives')
  .then(response => response.json())
  .then(data => {

      data.forEach(data => {
          agencies.push(data.nama_unit);
          archives.push(data.total_arsip);
      });

      createGraphArchive(agencies, archives)
  });

  let units = [];
  let documents = [];

fetch('/get/total/agency/documents')
    .then(response => response.json())
    .then(data => {
        data.forEach(data => {
            units.push(data.nama_unit);
            documents.push(data.total_dokumen);
        });

        createGraphDocument(units, documents)
    });
}

function createGraphArchive(agency, total) {

    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    // Area Chart Example
    var ctx = document.getElementById("archiveChart");
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: agency,
            datasets: [{
                label: "Unit",
                lineTension: 0.3,
                backgroundColor: "#FFA726",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 50,
                pointBorderWidth: 2,
                data: total,
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 20,
                        maxTicksLimit: 10
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });

}

function createGraphDocument(agency, total) {

  Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#292b2c';
  // Area Chart Example
  var ctx = document.getElementById("documentChart");
  var myBarChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: agency,
          datasets: [{
              label: "Unit",
              lineTension: 0.3,
              backgroundColor: "#FFA726",
              borderColor: "rgba(2,117,216,1)",
              pointRadius: 5,
              pointBackgroundColor: "rgba(2,117,216,1)",
              pointBorderColor: "rgba(255,255,255,0.8)",
              pointHoverRadius: 5,
              pointHoverBackgroundColor: "rgba(2,117,216,1)",
              pointHitRadius: 50,
              pointBorderWidth: 2,
              data: total,
          }],
      },
      options: {
          scales: {
              xAxes: [{
                  time: {
                      unit: 'date'
                  },
                  gridLines: {
                      display: false
                  },
                  ticks: {
                      maxTicksLimit: 7
                  }
              }],
              yAxes: [{
                  ticks: {
                      min: 0,
                      max: 20,
                      maxTicksLimit: 10
                  },
                  gridLines: {
                      color: "rgba(0, 0, 0, .125)",
                  }
              }],
          },
          legend: {
              display: false
          }
      }
  });
}



window.onload = loadData();