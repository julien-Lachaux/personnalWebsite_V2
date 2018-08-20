function randomInt(mini, maxi)
{
     var nb = mini + (maxi+1-mini)*Math.random();
     return Math.floor(nb);
}
Array.prototype.shuffle = function(n)
{
     if(!n)
          n = this.length;
     if(n > 1)
     {
          var i = randomInt(0, n-1);
          var tmp = this[i];
          this[i] = this[n-1];
          this[n-1] = tmp;
          this.shuffle(n-1);
     }
}

const cards = {
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
            console.log(position);
            position.shuffle();
            console.log(position);
            cardsArray.each((index, filteredCard) => {
                $(filteredCard).css('order', position[index])
                if($(filteredCard).hasClass('onLoadCard')) {
                    $(filteredCard).removeClass('onLoadCard');
                }
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
    }
}

module.exports = cards;