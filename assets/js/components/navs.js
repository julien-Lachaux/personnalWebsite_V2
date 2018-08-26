import { app } from './../app'
import { panels } from './panels'
import { cards } from './cards'

export const navs = {
  activeEvent() {
    //  declarations des variables
    var boutons = document.querySelectorAll('.sideNav-Link')

    // creation de l'ordre des webcontent
    for(var i = 0; i < boutons.length; i++) {
      boutons[i].setAttribute('data-descr', i)
      //  on ajoute l'effet d'affichage de la section au click
      boutons[i].addEventListener('click', function(e) {
        var link = this.querySelector('.link-txt').getAttribute('href')
        panels.afficherSection(link)
      })
      boutons[i].addEventListener('mouseover', function(e) {
        if(!this.classList.contains('iconActive') && (!window.matchMedia('(max-width: 1024px)').matches)) {
          var icon = $(this).find('.link-logo')
          icon.css('color', icon.attr('data-color'))
        }
      })
      boutons[i].addEventListener('mouseout', function(e) {
        if(!this.classList.contains('iconActive') && (!window.matchMedia('(max-width: 1024px)').matches)) {
          var icon = $(this).find('.link-logo')
          icon.css('color', '#fff')
        }
      })
    }
  }
}