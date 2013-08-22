/* global define */
define(
[ 
    'marionette',
    'templates',
],
    function(Marionette, Templates){
    'use strict';

    return Marionette.ItemView.extend({
        tagName: 'tr',
        template : Templates['playlist/templates/trackTemplate.html'],

        events: {
            'click': 'onClicked',
        },

        onClicked: function() {
            this.trigger('track:selected');
        }

    });
});