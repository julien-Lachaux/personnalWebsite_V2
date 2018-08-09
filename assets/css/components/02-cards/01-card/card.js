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

