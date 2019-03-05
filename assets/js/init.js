import { app } from './app'
import { navs } from './components/navs'
import { panels } from './components/panels'
import { animations } from './components/animations'
import { imagesMosaic } from './components/imagesMosaic'

const hash = app.getCurrentPage()
const saltyHash = (hash + '-panel')

// on active l'animation de loading
app.toggleLoaderBar()

// activation des event des boutons de navigation et des changeHistory
navs.activeEvent()
navs.changeInProgress = true
panels.activeChangeHistory()

// activation du boutons correspondant a la page actuel
let departText = document.querySelector('div.link-txt[href="/' + hash + '"]')
if (departText === null) { // erreur 404
  panels.error(404)
  navs.changeInProgress = false
} else {

  let departBtn = departText.parentNode
  let departIcon = departBtn.querySelector('.link-logo')
  let departBtnBackground = $(departBtn).find('.nav-decoration-active-background polygon')
  
  setTimeout(() => {
    departBtn.classList.add('iconActive')
    departText.style.borderBottom = '.2em solid ' + departIcon.getAttribute('data-color')
    departText.style.backgroundColor = departIcon.getAttribute('data-color') + 'b3'
    departBtnBackground.attr('fill', departIcon.getAttribute('data-color'))
  }, 2000)
  
  // chargement de la page demandé par l'utilisateur au premier chargement de la page
  panels.getAjaxPanel(hash, () => {
    let depart = document.querySelector('#' + saltyHash)
    
    navs.changeInProgress = false
  
    animations.activeOnLoadAnimationFor('card')
    animations.activeOnLoadAnimationFor('widget')
    animations.activeOnLoadAnimationFor('section-title')
    animations.activeOnLoadAnimationFor('section-subtitle')
    
    panels.activeAnimation()
    imagesMosaic.activeHover()
    imagesMosaic.activeClick()
    panels.resizeIframe()
    panels.activeContactModalBtn(false)
    window.onresize = function(){panels.resizeIframe()}
    
    
    $('.coverFlux').click(imagesMosaic.hidePreview)

    depart.classList.add('active')
    app.toggleLoaderBar()
    app.toggleLoader()
  })
  
}

let screen = document.querySelector('.mainFlux')
screen.addEventListener("touchstart", (event) => {
  //console.log('touch start')
  //console.log(event)
  var touches = event.changedTouches
}, false)

screen.addEventListener("touchend", (event) => {
  //console.log('touch end')
}, false)