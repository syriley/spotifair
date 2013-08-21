/* global define */
define(['backbone'],
    function(Backbone){
    'use strict';
    return Backbone.Model.extend({
        urlRoot: '/api/tracks',
        defaults: {
        	isPlaying: false,
        }
    });
});