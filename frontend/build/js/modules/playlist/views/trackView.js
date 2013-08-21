/* global define */
define(
[ 
    'jquery',
    'underscore',
    'marionette',
    'templates',
    'popcorn',
    'modules/vent/module',
],
    function($, _, Marionette, Templates, ppopcorn, vent){
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