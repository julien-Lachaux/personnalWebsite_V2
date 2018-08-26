import { activeCardAnimation, afficherSection, getAjaxPanel } from './utils'
import { app } from './app'
import { cards } from './components/cards'
import { panels } from './components/panels'
import { navs } from './components/navs'

const hash = app.getCurrentPage()
const saltyHash = (hash + '-panel')

// activation des event des boutons de navigation
navs.activeEvent()

// activation du boutons correspondant a la page actuel
let departBtn = document.querySelector('div.link-txt[href="/' + hash + '"]').parentNode
departBtn.classList.add('iconActive')
departBtn.querySelector('.link-logo').style.color = departBtn.querySelector('.link-logo').getAttribute('data-color')

// chargement de la page demandé par l'utilisateur au premier chargement de la page
panels.getAjaxPanel(hash, () => {
  let depart = document.querySelector('#' + saltyHash)
  cards.activeAnimation()
  depart.style.transform = 'translateX(100%)'
  setTimeout(() => {
    depart.classList.add('active')
    depart.style.transform = 'translateX(0)'
  }, 100)
})