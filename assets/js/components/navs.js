import { app } from './../app'
import { panels } from './panels'
import { cards } from './cards'

export const navs = {
  activeEvent() {
    let boutons = $('.sideNav-Link')

    boutons.each( (index, bouton) => {
      bouton = $(bouton)

      // event on click
      bouton.click( () => {
        let navbackgroundShadow = bouton.find('.navBtn-background-shadow')
        let navText = bouton.find('.link-txt')
        let link = navText.attr('href')

        
        navbackgroundShadow.attr( 'fill', '#006160')
        navText.css('background-color', '')
        
        panels.afficherSection(link)
      } )

      // event on mouse over
      bouton.mouseover( () => {
        if(!bouton.hasClass('iconActive') && (!window.matchMedia('(max-width: 1024px)').matches)) {
          let navText = bouton.find('.link-txt')
          let navbackgroundShadow = bouton.find('.navBtn-background-shadow')

          navText.css('background-color', '#00A79D')
          navbackgroundShadow.attr( 'fill', '#00A79D')
        }
      } )

      // event on mouse out
      bouton.mouseout( () => {
        if(!bouton.hasClass('iconActive') && (!window.matchMedia('(max-width: 1024px)').matches)) {
          let navText = bouton.find('.link-txt')
          let navbackgroundShadow = bouton.find('.navBtn-background-shadow')

          navText.css('background-color', '')
          navbackgroundShadow.attr( 'fill', '#006160')
        }
      } )
    } )
  }
}