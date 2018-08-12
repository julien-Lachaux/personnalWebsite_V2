const app = {
    get(url, cible, callback = () => {}) {
        $.get(url, (response) => {
            $(cible).html(response);
            callback();
        });
    },

    post(url, cible, data, callback = () => {}) {
        $.post(url, data, (response) => {
            $(cible).html(response);
            callback();
        });
    }
}

module.exports = app;