/* global define */
define(
[ 
    'marionette',
    'templates',
    'events/searchVent',
],
    function(Marionette, Templates, vent){
    'use strict';

    return Marionette.ItemView.extend({
        tagName: 'tr',
        template : Templates['playlist/templates/trackTemplate.html'],

        events: {
            'click .play' : 'onClicked',
            'dblclick': 'onClicked',
            'click .artist': 'onArtistClicked',
            'click .album': 'onAlbumClicked',
        },

        onClicked: function() {
            this.trigger('track:selected');
        },

        onArtistClicked: function(e){
            e.preventDefault();
            var artist = this.model.get('artist').name;
            var search = {
                artist: artist,
            }
            vent.trigger('search:request', search);
        },

        onAlbumClicked: function(e){
            e.preventDefault();
            var albumId = this.model.get('album').id;
            var search = {
                albumId: albumId,
            }
            vent.trigger('search:request', search);
        }

    });
});