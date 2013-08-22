/* global define */
define(
[ 
    'marionette',
    'templates',
],
    function(Marionette, Templates){
    'use strict';

    return Marionette.ItemView.extend({
        className: 'search-container',
        template : Templates['playlist/templates/searchTemplate.html'],

        ui: {
            searchTerm: '.search-term',
        },

        events: {
            'click .search-button': 'onSearchClicked',
            'keypress .search-term': 'onSearchKeyPress',
        },

        onSearchClicked: function(e) {
            e.preventDefault();
            this.searchClicked();
        },

        onSearchKeyPress: function (e){
            if(e.keyCode === 13){
                this.searchClicked();
            }
        },

        searchClicked: function(){
            var searchTerm = this.ui.searchTerm.val();
            console.log(searchTerm);
            this.trigger('search:request', searchTerm);

        }

    });
});