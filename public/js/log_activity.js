function loadActivity(agencyID){
  let el = document.getElementById('agency-' + agencyID)
  el.innerHTML = ''

  fetch('/activities/' + agencyID)
  .then(response => response.json())
  .then(data => {

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
            activityElement[key].innerHTML =  data.pengguna + data.aktivitas + 'pada pukul' + data.waktu
            el.appendChild(activityElement[key])
        });
      }
    }  

    el.appendChild(dateElement)
  });

}
