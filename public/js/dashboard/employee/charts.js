function loadData() {

    let elTotalArchive = document.getElementById('total_archive');
    
    fetch('/get/total/archives')
      .then(response => response.json())
      .then(data => {
        elTotalArchive.innerHTML = data.total_archives;
      });
    
      let elTotalDocument = document.getElementById('total_document');
    
    fetch('/get/total/documents')
      .then(response => response.json())
      .then(data => {
        elTotalDocument.innerHTML = data.total_documents;
      });
    
    }
    
    window.onload = loadData();