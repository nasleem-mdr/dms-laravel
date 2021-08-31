function loadActivity(agencyID){
  let el = document.getElementById('logActivity')
  let agencyNameElement = document.getElementById('agencyName')
  el.innerHTML = ''

  fetch('/activities/' + agencyID)
  .then(response => response.json())
  .then(data => {
    

    if(data.length === 0){
      el.innerHTML = 'Belum ada aktivitas'
    }

    for (const key in data) {
      
      if (Object.hasOwnProperty.call(data, key)) {
        const activities = data[key];
        let dateElement = [];
        dateElement[key] = document.createElement('h5')
        dateElement[key].innerHTML = key
        el.appendChild(dateElement[key])
        let activityElement = []
        activities.forEach(data => {
            activityElement[key] = document.createElement('p')
            activityElement[key].innerHTML =  data.pengguna + ' ' + data.aktivitas + 'pada pukul' + data.waktu
            el.appendChild(activityElement[key])
        });
      }
    }  

  });

}
