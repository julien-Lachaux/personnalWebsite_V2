import { app } from './../app'
import { navs } from './navs'
import { cards } from './cards'
import { animations } from './animations'
import { imagesMosaic } from './imagesMosaic'

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

        navbackgroundShadow.attr('fill', '#006160')
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

            animations.activeOnLoadAnimationFor('card')
            animations.activeOnLoadAnimationFor('widget')
            animations.activeOnLoadAnimationFor('section-title')
            animations.activeOnLoadAnimationFor('section-subtitle')
            panels.activeAnimation()
            
            imagesMosaic.activeHover()
            imagesMosaic.activeClick()

            panels.resizeIframe()

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

    activeAnimation() {
        let headerPage = $('.headerPage-decoration svg')
        headerPage.addClass('appear')
        headerPage.css('transform', 'translateX(110%)')

        let decorationPage = $('.decorationPage-decoration svg')
        decorationPage.addClass('appear')
        decorationPage.css('transform', 'translateX(-110%)')
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
            animations.easeInOut(inOut, [{
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
        }
    },

    /**
     * resizeIframe
     */
    resizeIframe() {
        let iframes = $('iframe')
        if (iframes.length > 0) {
            iframes.each((index, element) => {
                let iframe = $(element)
                let container = iframe.parent()
                let scaleRatio = container[0].offsetWidth / iframe[0].offsetWidth;
                
                iframe.css('transform', 'scale(' + scaleRatio + ')')
            })
        }
    }
}