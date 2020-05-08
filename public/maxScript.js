

function clck(e) {
  const getFile = document.getElementById('form-file2')
  console.log(getFile.files[0])
  e.preventDefault()
  document.querySelectorAll('.radio').forEach(elem => {
    if(elem.checked){
      setTimeout(upload(elem),5000)
    }
  })
}

// const test = (elem) => {
//   setTimeout(upload(elem),5000)
// }

const upload = async function (elem) {
  const getFile = document.getElementById('form-file2')
  const formData = new FormData();
  formData.append('file', getFile.files[0]);
  const result = fetch(`http://localhost:8080/sendFile/Nick/${elem.dataset.value}`, {
    method: 'POST',
    body: formData
  }).then(response => response.json().then(data => {
    
    // перерисовка графика тут
    chart.data = data.categories
    chart.validateData()
    elem.value = null;
  }))
  console.log(result)
};

document.querySelectorAll('.btn__input').forEach(elem => {
  elem.addEventListener('change', () => {
    upload(elem)
  });
})



// logout button
function logout() {
  location.href = "login.html";
}


// load digital print
function goToLoadPrint() {
  location.href = "loadprint.html";
}



// login functions
function studentLogin() {
  const name = document.getElementById('group-login').value
  const password = document.getElementById('group-password').value
  if(name !=='Arskaravaev'  && password !=='karavaev'){
    alert('Неверные данные входа')
  }else{
    location.href = "http://127.0.0.1:5500/public/index.html";
  }
}


// tabpanel script
function openTab(e, tabId) {
  var i, tabcontent, tablink;

  // hide all tabcontent content when tab button is click
  tabcontent = document.getElementsByClassName('tab-content');
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // remove active for the tablinks if its actvie
  tablink = document.getElementsByClassName('tab-link');
  for (i = 0; i < tablink.length; i++) {
    tablink[i].className = tablink[i].className.replace('btn-left-menu-active', "");
  }

  document.getElementById(tabId).style.display = "block";
  e.currentTarget.className += ' btn-left-menu-active';
}