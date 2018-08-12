const app = require('../app.js');

const admin = {
    getNav() {
       app.get('/ajax/admin/getNav', '#nav');
    },

    getContent(content, target, callback) {
        content = content.charAt(0).toUpperCase() + content.substring(1);
        const url = '/ajax/admin/get' + content;
        app.get(url, '#' + target, callback);
    }
}

module.exports = admin;