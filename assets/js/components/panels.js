import { app } from './../app'
import { navs } from './navs'
import { cards } from './cards'
import { animations } from './animations'

const SVG = require('svg.js')

export const panels = {
    afficherSection(ciblePath) {
        let CheminComplet = document.location.href
        let cibleID = ciblePath.substring(1)
        let hash = CheminComplet.substring(CheminComplet.lastIndexOf("/") + 1)
        let currentPanel = $('.panel')
        let currentBtn = $('div.link-txt[href="/' + hash + '"]').parent()
        let currentIcon = currentBtn.find('.link-logo')
        let cibleBtn = $('div.link-txt[href="/' + cibleID + '"]').parent()
        let cibleIcon = cibleBtn.find('.link-logo')
        let navbackgroundShadow = currentBtn.find('.navBtn-background-shadow')
        let cibleBtnBackground = $(cibleBtn).find('.nav-decoration-active-background polygon')
        
        navbackgroundShadow.attr( 'fill', '#006160')
        currentBtn.find('.link-txt').css('background-color', '')
        
        currentPanel.css('transform', 'translateX(100%)')
        currentBtn.removeClass('iconActive')

        setTimeout(() => {
            currentIcon.css('color', '#fff');
            cibleBtn.addClass('iconActive')
          }, 1000)

        cibleBtnBackground.attr('fill', cibleIcon.attr('data-color'));
    
        panels.getAjaxPanel(cibleID, () => {
          let cible = $('#' + cibleID + '-panel')
          let CheminComplet = document.location.href
          let urlParams = CheminComplet.split('/').slice(3)

          cards.activeAnimation()

          if (urlParams.length === 1) {
            let stateObj = {
              foo: cibleID
            }
            history.pushState(stateObj, cibleID, ciblePath)
          } else if (urlParams.length === 2) {
            let stateObj = {
              foo: cibleID
            }
            history.pushState(stateObj, cibleID, '/' + urlParams[0] + ciblePath)
          }
    
          cible.css('transform', 'translateX(100%)')
          setTimeout(() => {
            cible.addClass('active')
            cible.css('transform', 'translateX(0)')
          }, 1000)

        })
      },

      getAjaxPanel(panel, callback) {
        var url = '/ajax/' + panel;
        app.get(url, (response) => {
            $('.webContent').html(response);
            callback();
            cards.activeFilter();
            cards.activeSearch();
            panels.animate();
        });
      },

    animate() {
        // récupération de la forme cible
        let draw = SVG.adopt(document.querySelector('#headerPage'))
        
        if (draw) {
            // rotation
            let rotatesPath = draw.select('path.rotates')
            let rotatesPolygon = draw.select('polygon.rotates')
            animations.rotate(rotatesPath, 10000, '-')
            animations.rotate(rotatesPolygon, 5000, '-')
    
            // aller retour
            let inOut = draw.select('path.inOut')
            animations.easeInOut(inOut, [
                {
                    duration: 5000,
                    ease: '<>',
                    delay: 2000
                },
                {
                    duration: 5000,
                    ease: '<>',
                    delay: 2000,
                    move: {
                        x: -50,
                        y: 20
                    }
                },
                {
                    duration: 5000,
                    ease: '<>',
                    delay: 2000,
                    move: {
                        x: 50,
                        y: -20
                    }
                },
                {
                    duration: 5000,
                    ease: '<>',
                    delay: 2000,
                    move: {
                        x: 70,
                        y: 70
                    }
                },
                {
                    duration: 5000,
                    ease: '<>',
                    delay: 2000,
                    move: {
                        x: -70,
                        y: -70
                    }
                }
            ])
    
            // fade out
    
            let particule = draw.circle(10).addClass('particule').fill('#27AAE1').back()
            
            particule.move(250, 50)
            animations.fadeOut(particule, 3000, '<>', -250, 25)
            // animations.fadeOut(fadeOutPath, 3000, '<>')
            // animations.fadeOut(fadeOutPolygon, 3000, '<>')
        }
    }
}