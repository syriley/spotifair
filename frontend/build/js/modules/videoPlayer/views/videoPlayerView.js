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
    function($, _, Marionette, Templates, popcorn, vent){
    'use strict';

    return Marionette.ItemView.extend({
        className: 'video-container',
        template : Templates['videoPlayer/templates/videoPlayerTemplate.html'],
        ui: {
            video: '.video',
        },


        initialize: function(){
          vent.on('controls:stop', this.stop, this);
        },

        onShow: function(){
          var video = this.video = Popcorn('#video');

        },


        stop: function(){
          this.video.pause();
          this.video.currentTime(0);
        },


        show: function(){
          this.$el.css('z-index',1);
        },

        hide: function(){
          this.$el.css('z-index',-1);
        },

        selectTrack: function(track){
            if(this.video) {
                this.video.destroy();
            }

            var video = this.video = Popcorn.youtube('#video',
            track.model.get('url'));          
            video.play();
        }
    });
});