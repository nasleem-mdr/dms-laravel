function loadData() {

let elTotalEmployee = document.getElementById('total_employee');

fetch('/get/total/employees')
  .then(response => response.json())
  .then(data => {
    elTotalEmployee.innerHTML = data;
  });

let elTotalArchive = document.getElementById('total_archive');

fetch('/get/total/archives')
  .then(response => response.json())
  .then(data => {
    elTotalArchive.innerHTML = data;
  });

  let elTotalDocument = document.getElementById('total_document');

fetch('/get/total/documents')
  .then(response => response.json())
  .then(data => {
    elTotalDocument.innerHTML = data;
  });

}

window.onload = loadData();