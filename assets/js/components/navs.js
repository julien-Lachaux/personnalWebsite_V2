/*
               ______________________________
              |==============================|
              |           COMPONENT          |
              |==============================|
              |$                            $|
              |$        VERTICALE NAV       $|
              |$                            $|
              |==============================|
              |          FILES-INFO          |
              |==============================|
              |    author : Julien Lachaux   |
              |      date : 22-05-2017       |
              |      type : Javascript       |
              |==============================|
              |           CONTACT            |
              |==============================|
              |   lachauxWebDev@gmail.com    |
              |______________________________|
*/

var getAjaxPanel = function(panel, callback) {
  var url = '/ajax/' + panel;
  $.get(url, (response) => {
    $('.webFlux').html(response);
    callback();
  });
}

// on ajoute le rechargement de la page avec la section passez en url
var CheminComplet = document.location.href;

var hash = CheminComplet.substring(CheminComplet.lastIndexOf( "/" ) + 1);
var saltyHash = (hash + '-panel');

//  declarations des variables
var boutons = document.querySelectorAll('.sideNav-Link');
var departBtn = document.querySelector('div.link-txt[href="/' + hash + '"]').parentNode;
var icon = departBtn.querySelector('.link-logo');
//  animation sur la navbar vertical
departBtn.classList.add('iconActive');

icon.style.color = icon.getAttribute('data-descr');

// creation de l'ordre des webcontent
for(var i = 0; i < boutons.length; i++) {
  boutons[i].setAttribute('data-descr', i);
   //  on ajoute l'effet d'affichage de la section au click
   boutons[i].addEventListener('click', function(e) {
    var link = this.querySelector('.link-txt').getAttribute('href');
    afficherSection(link);
  });
  
  boutons[i].addEventListener('mouseover', function(e) {
    if(!this.classList.contains('iconActive') && (!window.matchMedia('(max-width: 1024px)').matches)) {
      var icon = this.querySelector('.link-logo');
      icon.style.color = icon.getAttribute('data-descr');
    }
  });
  boutons[i].addEventListener('mouseout', function(e) {
    if(!this.classList.contains('iconActive') && (!window.matchMedia('(max-width: 1024px)').matches)) {
      var icon = this.querySelector('.link-logo');
      icon.style.color = '';
    }
  });
}

getAjaxPanel(hash, () => {
  var depart = document.querySelector('#' + saltyHash);
  depart.style.transform = 'translateX(-100%)';
  setTimeout(() => {
    depart.classList.add('active');
    depart.style.transform = 'translateX(0)';
  }, 100);
});


// fonction afficherSection
var afficherSection = function(ciblePath){
  var CheminComplet = document.location.href;
  var cibleID = ciblePath.substring(1);
  var hash = CheminComplet.substring(CheminComplet.lastIndexOf( "/" ) + 1);
  var currentPanel = document.querySelector('.webContent');
  var currentBtn = document.querySelector('div.link-txt[href="/' + hash + '"]').parentNode;
  var currentIcon = currentBtn.querySelector('.link-logo');
  var cibleBtn = document.querySelector('div.link-txt[href="/' + cibleID + '"]').parentNode;

  currentPanel.style.transform = 'translateX(-100%)';
  currentBtn.classList.remove('iconActive');
  currentIcon.style.color = '';
  cibleBtn.classList.add('iconActive');

  getAjaxPanel(cibleID, () => {
    var boutons = document.querySelectorAll('.sideNav-Link');
    var cible = document.querySelector('#' + cibleID + '-panel');
    var CheminComplet = document.location.href;
    var urlParams = CheminComplet.split('/').slice(3);

    if (urlParams.length === 1) {
      var stateObj = { foo: cibleID };
      history.pushState(stateObj, cibleID, ciblePath);
    } else if (urlParams.length === 2) {
      var stateObj = { foo: cibleID };
      history.pushState(stateObj, cibleID, '/' + urlParams[0] + ciblePath);
    }

    cible.style.transform = 'translateX(-100%)';
    setTimeout(() => {
      cible.classList.add('active');
      cible.style.transform = 'translateX(0)';
    }, 100);

    var boutons = document.querySelectorAll('.sideNav-Link');
    
    for(var i = 0; i < boutons.length; i++) {
      if((boutons[i].querySelector('.link-txt').getAttribute('href')) === '/' + cibleID){
        var icon = boutons[i].querySelector('.link-logo');
        icon.style.color = icon.getAttribute('data-descr');
      }
    }
  });
}

function copy(text) {
window.clipboardData.setData("Text", text);
}