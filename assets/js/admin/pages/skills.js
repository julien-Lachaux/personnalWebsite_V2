$(document).ready( () => {
    const app = require('../../app.js');
    const admin = require('../admin.js');

    admin.getNav();
    admin.getContent('skills', 'content', () => {
    });
});