/* global define */
define(
[
    'marionette',
    'templates',
    'bootstrap',
    'utilities/cookie',
],
    function(Marionette, Templates, Bootstrap, Cookie){
    'use strict';

    return Marionette.ItemView.extend({
        template : Templates['message/templates/messageTemplate.html'],

        events: {
            'click .unlock' : 'onUnlockClick'
        },

        showMessage: function(messageName){
            var template;
            switch(messageName){
                case 'register': 
                    template = 'message/templates/registerTemplate.html';
                break;
                default:
            }
            this.template = Templates[template];
            this.render();
        },

        onUnlockClick: function(e){
            e.preventDefault();
            console.log('unlockClicked');
            this.trigger('unlock:show');
        }

    });
});