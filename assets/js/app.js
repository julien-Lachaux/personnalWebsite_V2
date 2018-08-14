const app = {
    get(url, cible, callback = () => {}) {
        $.get(url, (response) => {
            $(cible).html(response);
            callback();
        });
    },

    post(url, data, callback = () => {}) {
        $.post(url, data, (response) => {
            callback(response);
        });
    },

    serializeForm(form) {
        var formData = {};
        $(form).find('.form-control').each((key, input) => {
            let champ = $(input).attr('name');
            let valeur = $(input).val();
            formData[champ] = valeur;
        });
        console.log(formData);
        return formData;
    }
}

module.exports = app;