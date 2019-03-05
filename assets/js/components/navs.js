import { panels } from './panels'

export const navs = {
  changeInProgress: false,

  activeEvent() {
    let boutons = $('.sideNav-Link')

    boutons.each( (index, bouton) => {
      bouton = $(bouton)

      // event on click
      bouton.click( () => {
        if (!navs.changeInProgress) {
          let navText = bouton.find('.link-txt')
          let link = navText.attr('href')
          navs.changeInProgress = true
          
          panels.afficherSection(link)
        }
      } )

      // event on mouse over
      bouton.mouseover( () => {
        if(!bouton.hasClass('iconActive') && (!window.matchMedia('(max-width: 1250px)').matches)) {
          let navText = bouton.find('.link-txt')
          let navbackgroundShadow = bouton.find('.navBtn-background-shadow')

          navText.css('background-color', '#00a79db3')
          navbackgroundShadow.attr( 'fill', '#00a79d')
        }
      } )

      // event on mouse out
      bouton.mouseout( () => {
        if(!bouton.hasClass('iconActive') && (!window.matchMedia('(max-width: 1250px)').matches)) {
          let navText = bouton.find('.link-txt')
          let navbackgroundShadow = bouton.find('.navBtn-background-shadow')

          navText.css('background-color', '#006160b3')
          navbackgroundShadow.attr( 'fill', '#006160')
        }
      } )
    } )
  }
}