import { app } from './../app'
import { navs } from './navs'
import { cards } from './cards'
import { animations } from './animations'

const SVG = require('svg.js')

export const panels = {
    afficherSection(ciblePath) {
        var CheminComplet = document.location.href
        var cibleID = ciblePath.substring(1)
        var hash = CheminComplet.substring(CheminComplet.lastIndexOf("/") + 1)
        var currentPanel = document.querySelector('.panel')
        var currentBtn = document.querySelector('div.link-txt[href="/' + hash + '"]').parentNode
        var currentIcon = currentBtn.querySelector('.link-logo')
        var cibleBtn = document.querySelector('div.link-txt[href="/' + cibleID + '"]').parentNode
        var cibleIcon = cibleBtn.querySelector('.link-logo')
        
        currentPanel.style.transform = 'translateX(100%)'
        currentBtn.classList.remove('iconActive')
        currentIcon.style.color = '#fff';
        cibleBtn.classList.add('iconActive')

        var cibleBtnBackground = $(cibleBtn).find('.nav-decoration-active-background polygon')
        cibleBtnBackground.attr('fill', cibleIcon.getAttribute('data-color'));
    
        panels.getAjaxPanel(cibleID, () => {
          var boutons = document.querySelectorAll('.sideNav-Link')
          var cible = document.querySelector('#' + cibleID + '-panel')
          var CheminComplet = document.location.href
          var urlParams = CheminComplet.split('/').slice(3)
          cards.activeAnimation()
          if (urlParams.length === 1) {
            var stateObj = {
              foo: cibleID
            }
            history.pushState(stateObj, cibleID, ciblePath)
          } else if (urlParams.length === 2) {
            var stateObj = {
              foo: cibleID
            }
            history.pushState(stateObj, cibleID, '/' + urlParams[0] + ciblePath)
          }
    
          cible.style.transform = 'translateX(100%)'
          setTimeout(() => {
            cible.classList.add('active')
            cible.style.transform = 'translateX(0)'
          }, 100)
    
          var boutons = document.querySelectorAll('.sideNav-Link')
    
          for (var i = 0; i < boutons.length; i++) {
            if ((boutons[i].querySelector('.link-txt').getAttribute('href')) === '/' + cibleID) {
              var icon = boutons[i].querySelector('.link-logo')
            }
          }
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