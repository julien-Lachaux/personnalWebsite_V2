$(document).ready( () => {
    const app = require('../../app.js');
    const admin = require('../admin.js');

    admin.getNav();
    admin.getContent('skills', 'content', () => {
        $('.group_data').each((key, form) => {
            $(form).submit((event) => {
                var formData = app.serializeForm(form);
                app.post('/ajax/admin/updateSkillGroup', formData, (response) => {
                    console.log(response);
                });
                event.preventDefault();
            });
        });
    });
});