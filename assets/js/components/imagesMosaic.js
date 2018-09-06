export const imagesMosaic = {
    activeHover() {
        $('.images-mosaic').each((index, mosaic) => {
            $(mosaic).find('.image').each((index, image) => {
                $(image).hover(this.hoverIn, this.hoverOut)
            })
        })
    },

    activeClick() {
        $('.images-mosaic').each((index, mosaic) => {
            $(mosaic).find('.image').each((index, image) => {
                $(image).click(this.displayPreview)
            })
        })
    },

    hoverIn(element) {
        let target = $(element.currentTarget)
        target.find('.image-cover').css({'opacity': '0.9'})
    },

    hoverOut(element) {
        let target = $(element.currentTarget)
        target.find('.image-cover').css({'opacity': '0'})
    },

    displayPreview(element) {
        let target = $(element.currentTarget)
        let link = target.find('img').attr('src')
        let imagePreview = $('<div class="image-preview"></div>')
        let coverFlux = $('.coverFlux')

        imagePreview.css('background-image', 'url("' + link + '")')
        coverFlux.append(imagePreview)
        coverFlux.css('display', 'flex')
        setTimeout(() => {
            coverFlux.addClass('visible')
        }, 100)   
    },

    hidePreview(element) {
        let coverFlux = $('.coverFlux')

        coverFlux.removeClass('visible')
        coverFlux.css('display', 'none')
        coverFlux.empty()
    }
}