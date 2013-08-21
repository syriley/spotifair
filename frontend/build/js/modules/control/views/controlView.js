/* global define */
define(
[
    'marionette',
    'templates',
    'modules/vent/module'
],
    function(Marionette, Templates, vent){
    'use strict';

    return Marionette.ItemView.extend({
        template : Templates['control/templates/controlViewTemplate.html'],
        
        ui: {
            progress: 'progress-bar',
        },

        events:{
            'click .play': 'onPlayClicked',
            'click .stop': 'onStopClicked',
        },

        onPlayClicked: function(){
            this.trigger('controls:play');
            vent.trigger('controls:play');
        },

        onStopClicked: function(){
            this.trigger('controls:stop');
            vent.trigger('controls:stop');
        },

        updateTime: function(percent){
            // this.ui.progress.width(percent+'%');
            var progressBar = this.$('.progress-bar');
              
              if(percent < 3){
                this.stopAnimation(progressBar);
              }
              else{
                this.startAnimation(progressBar);
              }
              // this.ui.progress.show();
              progressBar.width(percent+'%');
        },

        stopAnimation: function(progressBar) {
            progressBar.css("-webkit-transition", "none");
            progressBar.css("-moz-transition", "none");
            progressBar.css("-ms-transition", "none");
            progressBar.css("transition", "none");
        },

        startAnimation: function(progressBar) {
            progressBar.css("-webkit-transition", "width .6s ease");
            progressBar.css("-moz-transition", "width .6s ease");
            progressBar.css("-ms-transition", "width .6s ease");
            progressBar.css("transition", "width .6s ease");
        }, 
    });
});