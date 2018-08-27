export const cards = {
    activeFilter() {
        if ($('.panel-nav').length) {
            $('.panel-nav .filter a').each((index, filterBtn) => {
                $(filterBtn).click(() => {
                    cards.filter($(filterBtn).text());
                });
            });
            let cardsArray = $('.cards-mosaic .card');
            var position = [];
            for(let i = 1; i <= cardsArray.length; i++) {
                position.push(i);
            }
            position.shuffle();
            cardsArray.each((index, filteredCard) => {
                $(filteredCard).css('order', position[index]);
            });
        }
    },

    filter(filterName) {
        // change le active de lien
        $('.panel-nav .filter a[class="active"]').removeClass('active');
        $('.panel-nav .filter a[href="' + filterName + '"]').addClass('active');

        // filtre les cards
        if (filterName === 'All') {
            let cardsArray = $('.cards-mosaic .card');
            cardsArray.each((index, filteredCard) => {
                $(filteredCard).show();
            });
        } else {
            let cardsArrayHide = $('.card[data-filter!="' + filterName + '"]');
            cardsArrayHide.each((index, filteredCard) => {
                $(filteredCard).hide();
            });
    
            let cardsArrayShow = $('.card[data-filter="' + filterName + '"]');
            cardsArrayShow.each((index, filteredCard) => {
                $(filteredCard).show();
            });
        }
        event.preventDefault();
    },

    activeSearch() {
        if ($('.panel-nav .search input').length) {
            let searchInput = $('.panel-nav .search input');
            searchInput.keyup(() => {
                cards.search(searchInput.val());
            });
        }
    },

    search(query) {
        if (query === '') {
            let cardsArray = $('.cards-mosaic .card');
            cardsArray.each((index, filteredCard) => {
                filteredCard = $(filteredCard);
                filteredCard.find('.card-head .card-title span').each((index, title) => {
                    if($(title).hasClass('highlighted')) {
                        $(title).removeClass('highlighted');
                    }
                });
                filteredCard.show();
            });
        } else {
            let cardsArray = $('.cards-mosaic .card');
            cardsArray.each((index, filteredCard) => {
                filteredCard = $(filteredCard);
                let regex = '\\b(.*)';
                for(let i in query) {
                    regex += '(' + query[i] + ')(.*)';
                }
                regex += '\\b';
                let title = filteredCard.find('.card-head .card-title');
                let text = title.text();
                let result = text.match(new RegExp(regex, 'i'));
                if(result) {
                    filteredCard.show();
                    var string = '';
                    for (let i in  result) {
                        if (i > 0) {
                            if (i % 2 == 0) {
                                string += '<span class="highlighted">' + result[i] + '</span>';
                            } else {
                                string += result[i];
                            }
                        }
                    }
                    title.empty().append(string);
                } else {
                    filteredCard.hide();
                }
            });
        }
    },

    activeAnimation() {
        // OnLoad animation for card
        var webContents = document.querySelectorAll('.webContent');
        var poi = 0;
        var lor;
        setTimeout(() => {
            var cards = document.querySelectorAll('.card.onLoadCard');
            for (let i = 0; i < cards.length; i++) {
                cards[i].classList.remove('onLoadCard');
            }
        }, 5000);
        for (var u = 0; u < webContents.length; u++) {
            lor = 0;
            var cards = webContents[u].querySelectorAll('.card');
            if ((poi % 2) === 0) {
                for (let i = 0; i < cards.length; i++) {
                    cards[i].classList.add('onLoadCard');
                    if (lor === 0) {
                        cards[i].classList.add('top');
                    } else if (lor == (cards.length - 1)) {
                        cards[i].classList.add('bottom');
                    } else if ((lor % 2) === 0) {
                        cards[i].classList.add('left');
                    } else {
                        cards[i].classList.add('right');
                    }
                    lor++;
                }
            } else {
                for (let i = 0; i < cards.length; i++) {
                    cards[i].classList.add('onLoadCard');
                    if (lor === 0) {
                        cards[i].classList.add('top');
                    } else if (lor == (cards.length - 1)) {
                        cards[i].classList.add('bottom');
                    } else if ((lor % 2) === 0) {
                        cards[i].classList.add('right');
                    } else {
                        cards[i].classList.add('left');
                    }
                    lor++;
                }
            }
            poi++;
    
        }
    }
}