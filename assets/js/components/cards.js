// OnLoad animation for card
var webContents = document.querySelectorAll('.webContent');

var poi = 0;
var lor;
for(var u = 0; u < webContents.length; u++) {
  lor  = 0;
  var cards = webContents[u].querySelectorAll('.card');
  if((poi % 2) === 0) { 
   for(var i = 0; i < cards.length; i++) {
      cards[i].classList.add('onLoadCard');
     if(lor === 0) {
      cards[i].classList.add('top');
     } else if(lor == (cards.length - 1)) {
      cards[i].classList.add('bottom');
     } else if((lor % 2) === 0) { 
      cards[i].classList.add('left');
     } else {
       cards[i].classList.add('right');
     }
     lor++;
   }
  } else {
   for(var i = 0; i < cards.length; i++) {
      cards[i].classList.add('onLoadCard');
     if(lor === 0) {
      cards[i].classList.add('top');
     } else if(lor == (cards.length - 1)) {
      cards[i].classList.add('bottom');
     } else if((lor % 2) === 0) { 
      cards[i].classList.add('right');
     } else {
       cards[i].classList.add('left');
     }
     lor++;
   }
  }
  poi++;
  
}


/* declaration des variables */
var links = document.querySelectorAll('.selectors .selector');

for (var i = 0; i < links.length; i++) {
  links[i].addEventListener('click', function() {
    if(!this.classList.contains('active-selector')) {
      /* declaration des variables */
      var onglets = document.querySelector('.cards');
      var linkActive = document.querySelector('.selectors .selector.active-selector');
      var ongletActive = document.querySelector('.cards .list-card.active-list');
      var cible = this.querySelector('.card-title').innerHTML;
      
      this.classList.add('active-selector');
      linkActive.classList.remove('active-selector');
      onglets.querySelector('#' + cible + '').classList.add('active-list');
      ongletActive.classList.remove('active-list');
    }
  });
}

// scroll des selectors sur mobile

if(window.matchMedia('(max-width: 1024px)').matches) {
  
  var webContent = document.querySelectorAll('.webContent');
  var container = document.querySelector('.selectors');
  
  for(var i = 0; i < webContent.length; i++) {
    var lastScroll = 0;
    webContent[i].addEventListener('scroll', function() {
      console.log((this.scrollTop + 'px'));
      container.style.top = ((this.scrollTop + 10) + 'px');
      if(this.scrollTop > lastScroll) {
      } else if (this.scrollTop < lastScroll) {
        
      }
      lastScroll = this.scrollTop;
    });
  }
  
}
/*
               ______________________________
              |==============================|
              |           COMPONENT          |
              |==============================|
              |$                            $|
              |$          MEDIA-CARD        $|
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
