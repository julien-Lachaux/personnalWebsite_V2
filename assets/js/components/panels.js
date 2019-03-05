import { app } from './../app'
import { navs } from './navs'
import { cards } from './cards'
import { animations } from './animations'
import { imagesMosaic } from './imagesMosaic'

const SVG = require('svg.js')

export const panels = {
    currentPanel: history.state !== null ? history.state.foo : window.location.href,

    changeHistoryState(newState) {
        if (newState !== this.currentPanel) {
            panels.afficherSection('/' + newState)
        }
    },

    activeChangeHistory() {
        window.onpopstate = (e) => {
            if (e.state !== null) {
                panels.changeHistoryState(e.state.foo)
            }
        }
    },

    afficherSection(ciblePath) {
        const hash = panels.currentPanel
        const currentPanel = $('.panel')
        const currentText = $('div.link-txt[href="/' + hash + '"]')

        app.toggleLoader('panel')

        if (currentText === null) { // erreur 404
            panels.error(404)
            this.currentPanel = ciblePath.substring(1)
            navs.changeInProgress = false
        } else { // fonctionnement normal
            const currentBtn = currentText.parent()
            const cibleID = ciblePath.substring(1)
            const cibleText = $('div.link-txt[href="/' + cibleID + '"]')
            const cibleBtn = cibleText.parent()
            const cibleIcon = cibleBtn.find('.link-logo')
            const navbackgroundShadow = currentBtn.find('.navBtn-background-shadow')
            const cibleBtnBackground = $(cibleBtn).find('.nav-decoration-active-background polygon')
            const CheminComplet = document.location.href
            const urlParams = CheminComplet.split('/').slice(3)
    
            // on réécrie l'url
            if (urlParams.length === 1) {
                let stateObj = {
                    foo: cibleID
                }
                this.currentPanel = cibleID
                history.pushState(stateObj, cibleID, ciblePath)
            } else if (urlParams.length === 2) {
                let stateObj = {
                    foo: cibleID
                }
                this.currentPanel = cibleID
                history.pushState(stateObj, cibleID, '/' + urlParams[0] + ciblePath)
            }
    
            // on retire le visuel du bouton dans la navbar pour la page courante
            currentText.css('background-color', '#006160b3')
            currentBtn.removeClass('iconActive')
            navbackgroundShadow.attr('fill', '#006160')
            
            // on ajoute le visuel du bouton dans la navbar pour la nouvelle page
            cibleBtn.addClass('iconActive')
            cibleText.css('background-color', cibleIcon.attr('data-color')+ 'b3')
            cibleBtnBackground.attr('fill', cibleIcon.attr('data-color'))
            cibleText.css('border-bottom', '.2em solid ' + cibleIcon.attr('data-color'))
    
            panels.getAjaxPanel(cibleID, () => {
                const cible = $('#' + cibleID + '-panel')
    
                animations.activeOnLoadAnimationFor('card')
                animations.activeOnLoadAnimationFor('widget')
                animations.activeOnLoadAnimationFor('section-title')
                animations.activeOnLoadAnimationFor('section-subtitle')
                panels.activeAnimation()
                panels.activeContactModalBtn()
                
                imagesMosaic.activeHover()
                imagesMosaic.activeClick()
    
                panels.resizeIframe()
    
                setTimeout(() => {
                    cible.addClass('active')
                    navs.changeInProgress = false
                }, 1000)
    
                app.toggleLoader('panel')
            })
        }

    },

    getAjaxPanel(panel, callback) {
        var url = '/ajax/' + panel
        app.get(url, (response) => {
            $('.webContent').html(response)
            callback()
            cards.activeFilter()
            cards.activeSearch()
            panels.animate()
        })
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

    error(code) {
        var url = '/error/' + code
        app.get(url, (response) => {
            $('.webContent').html(response)
            //panels.animateError()
        })
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
                let scaleRatio = container[0].offsetWidth / iframe[0].offsetWidth
                
                iframe.css('transform', 'scale(' + scaleRatio + ')')
            })
        }
    },

    activeContactModalBtn(exitOk = true) {
        let openModal = $('.contactMe')
        openModal.click(panels.toggleContactModal)
        if (exitOk === false) {
            let exitModal = $('.exitBtn')
            exitModal.click(panels.toggleContactModal)
        }
    },

    toggleContactModal() {
        let modal = $('.contactModal')
        if (modal.hasClass('active')) {
            modal.removeClass('active')
            setTimeout(() => {
                modal.removeClass('index-alert')
            }, 1000)
        } else {
            modal.addClass('active')
            modal.addClass('index-alert')
        }
    }
}