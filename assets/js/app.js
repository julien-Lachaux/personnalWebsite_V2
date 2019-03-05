export const app = {

    /**
     * get
     * @description effectue une requete ajax get avec la gestion d'erreur
     * @param {string} url url à appelé en ajax
     * @param {funtion} callback fonction de callback
     */
    get(url, callback = () => {}) {
        $.ajax({
            url: url,
            method: 'GET',
        })
        .done(callback)
        .fail(app.ajaxError)
    },

    /**
     * post
     * @description effectue une requete ajax post avec la gestion d'erreur
     * @param {strin} url url à appelé en ajax
     * @param {object} data data envoyé avec la requete POST
     * @param {function} callback fonction de callback
     */
    post(url, data, callback = () => {}) {
        $.post(url, data, (response) => {
            callback(response)
        })
    },

    /**
     * serializeForm
     * @description serialize un formulaire en un tableau clé - valeur
     * @param {string} form selecteur css pour cibler le formulaire a serializer
     */
    serializeForm(form) {
        var formData = {}
        $(form).find('.form-control').each((key, input) => {
            let champ = $(input).attr('name')
            let valeur = $(input).val()
            formData[champ] = valeur
        });
        return formData
    },

    /**
     * ajaxError
     * @description affiche un message d'erreur en cas d'echec q'un appel ajax
     * @param {object} error 
     */
    ajaxError(error) {
        console.log(error)
    },

    /**
     * getCurrentPage
     * @description recupere la page courante dans l'url
     */
    getCurrentPage() {
        var CheminComplet = document.location.href
        var hash = CheminComplet.substring(CheminComplet.lastIndexOf( "/" ) + 1)

        return hash
    },

    toggleLoader(role = 'page') {
        const loader = document.querySelector('.loaderContainer')
        const isActive = loader.classList.contains('active')
        const isPage = loader.classList.contains('pageLoader')
        const isPanel = loader.classList.contains('panelLoader')

        if (role === 'page') {
            if (!isPage) {
                loader.classList.add('pageLoader')
            } 
            if (isPanel) {
                loader.classList.remove('panelLoader')
            }
        } else if (role === 'panel') {
            if (!isPanel) {
                loader.classList.add('panelLoader')
            } 
            if (isPage) {
                loader.classList.remove('pageLoader')
            }
        }

        if (isActive) {
            loader.classList.remove('active')
            setTimeout(() => {
                loader.classList.remove('loaderZindex')
            }, 2000)
        } else {
            loader.classList.add('active')
            loader.classList.add('loaderZindex')
        }
    },

    toggleLoaderBar() {
        const loaderBar = document.querySelector('.loaderBar')
        const isActive = loaderBar.classList.contains('active')

        if (!isActive) {
            loaderBar.classList.add('active')
            loaderBar.setAttribute('data-item', 0)
            this.loaderBarInterval = setInterval(app.loaderBarAddItem, 1000);
        } else {
            loaderBar.classList.remove('active')
            loaderBar.setAttribute('data-item', 0)
            window.clearInterval(this.loaderBarInterval)
        }
    },

    loaderBarAddItem() {
        const loaderBar = document.querySelector('.loaderBar')

        if (parseInt(loaderBar.getAttribute('data-item')) < 12) {
            const loaderBarItem = app.createLoaderBarItem()
            loaderBar.setAttribute('data-item', parseInt(loaderBar.getAttribute('data-item')) + 1)
            loaderBar.appendChild(loaderBarItem)
        } else {
            loaderBar.innerHTML = '';
            loaderBar.setAttribute('data-item', 0)
        }
    },

    createLoaderBarItem() {
        const loaderItem = document.createElement('div')
        loaderItem.classList.add('loaderBarItem')
        return loaderItem
    }
}