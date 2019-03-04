import { panels } from './panels'

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
        
        navText.css('background-color', '')
        navText.css('color', '#313131')
        navbackgroundShadow.attr( 'fill', '#006160')
        
        panels.afficherSection(link)
      } )

      // event on mouse over
      bouton.mouseover( () => {
        if(!bouton.hasClass('iconActive') && (!window.matchMedia('(max-width: 1250px)').matches)) {
          let navText = bouton.find('.link-txt')
          let navbackgroundShadow = bouton.find('.navBtn-background-shadow')

          navText.css('background-color', 'rgba(0, 166, 157, 0.7)')
          navText.css('color', '#ffffff')
          navbackgroundShadow.attr( 'fill', '#00A79D')
        }
      } )

      // event on mouse out
      bouton.mouseout( () => {
        if(!bouton.hasClass('iconActive') && (!window.matchMedia('(max-width: 1250px)').matches)) {
          let navText = bouton.find('.link-txt')
          let navbackgroundShadow = bouton.find('.navBtn-background-shadow')

          navText.css('background-color', '')
          navText.css('color', '#313131')
          navbackgroundShadow.attr( 'fill', '#006160')
        }
      } )
    } )
  }
}