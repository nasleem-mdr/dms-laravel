function loadData() {
    dummyData1 = [122, 129,134,145,167];
    dummyData2 = [22, 49,54,45,77];
  //get total of units/agency
let elTotalAgency = document.getElementById('total_agencies');

fetch('/get/total/agencies')
  .then(response => response.json())
  .then(data => {
    elTotalAgency.innerHTML = data.total_agencies;
  });

let elTotalEmployee = document.getElementById('total_employee');

fetch('/get/total/employees')
  .then(response => response.json())
  .then(data => {
    elTotalEmployee.innerHTML = data.total_employees;
  });

let agencies = [];
let archives = [];

fetch('/get/total/agency/archives')
  .then(response => response.json())
  .then(data => {

      data.forEach(data => {
          agencies.push(data.nama_unit);
          archives.push(data.total_archives);
      });

    //   createGraphArchive(agencies, archives)
      createGraphArchive(agencies, dummyData1)
  });

  let units = [];
  let documents = [];

fetch('/get/total/agency/documents')
    .then(response => response.json())
    .then(data => {
        data.forEach(data => {
            units.push(data.nama_unit);
            documents.push(data.total_documents);
        });

        // createGraphDocument(units, documents)
        createGraphDocument(units, dummyData2)
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
                        max: 200,
                        maxTicksLimit: 20
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
                      max: 100,
                      maxTicksLimit: 20
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