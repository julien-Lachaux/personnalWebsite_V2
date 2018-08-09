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

// on ajoute le rechargement de la page avec la section passez en url
var hash = window.location.hash;
if(hash == '') {
  window.location.hash = '#bienvenue';
  hash = '#bienvenue';
}
var saltyHash = (hash + '-panel');
//  declarations des variables
var sections = document.querySelectorAll('.webContent');
var boutons = document.querySelectorAll('.sideNav-Link');
var depart = document.querySelector(saltyHash);
var departBtn = document.querySelector('div.link-txt[href="' + hash + '"]').parentNode;
var icon = departBtn.querySelector('.link-logo');

// creation de l'ordre des webcontent
for(var i = 0; i < sections.length; i++) {
  sections[i].setAttribute('data-descr', i);
}

depart.classList.add('active');
depart.style.transform = 'translateX(0)';

var departNumber = depart.getAttribute('data-descr');
for(var i = 0; i < sections.length; i++) {
  var currentNumber = (sections[i].getAttribute('data-descr') - departNumber);
  var finalNumber = 0;
  
  if (currentNumber == 0) {
    finalNumber = '0';
  } else {
    if(currentNumber < 0) {
      finalNumber = '-100';
    }else {
      finalNumber = '100';
    }
  }
  
  sections[i].style.transform = 'translateX(' + finalNumber + '%)';
}


//  animation sur la navbar vertical
departBtn.classList.add('iconActive');

icon.style.color = icon.getAttribute('data-descr');

// fonction afficherSection
var afficherSection = function(cibleID){
  var cible = document.querySelector(cibleID + '-panel');
  var cibleBtn = document.querySelector('div.link-txt[href="' + cibleID + '"]').parentNode;
  
  if(!cible.classList.contains('active')) {
    var active = document.querySelector('.active');
    var currentBtn = document.querySelector('.iconActive');
    var currentIcon = currentBtn.querySelector('.link-logo');
          
    active.classList.remove('active');
    active.classList.add('inactive');
    function inactive() {
      active.classList.remove('inactive');
    }
    window.setTimeout(inactive, 500);
    
    cible.classList.add('active');

    window.location.hash = cibleID;
    
    var activeNumber = cible.getAttribute('data-descr');
    for(var i = 0; i < sections.length; i++) {
      var currentNumber = (sections[i].getAttribute('data-descr') - activeNumber);
      var finalNumber = '0';
      if (currentNumber == 0) {
        finalNumber = '0';
      } else {
        if (currentNumber < 0) {
          finalNumber = '-100';
        } else {
          finalNumber = '100';
        }
      } 
      sections[i].style.transform = 'translateX(' + finalNumber + '%)';
    }
    
    currentBtn.classList.remove('iconActive');
    currentIcon.style.color = '';
    
    cibleBtn.classList.add('iconActive');

    var boutons = document.querySelectorAll('.sideNav-Link');
    
    for(var i = 0; i < boutons.length; i++) {
      if((boutons[i].querySelector('.link-txt').getAttribute('href')) === cibleID){
        var icon = boutons[i].querySelector('.link-logo');
        icon.style.color = icon.getAttribute('data-descr');
      }
    }
    
  }
}

//  on declare les event listener sur les boutons de la navbar
for (var i = 0; i < boutons.length; i++) {
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

function copy(text) {
window.clipboardData.setData("Text", text);
}