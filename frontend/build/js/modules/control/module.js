define([
    'marionette',
    'modules/control/layout',
    'modules/control/timer',
    'modules/control/views/controlView', 
], function (Marionette, Layout, Timer, ControlView) {
    'use strict';
    return Marionette.Controller.extend({
        display: function(region) {
            var layout = new Layout();
            var controlView = new ControlView();
            var timer = new Timer();

            region.show(layout);
            layout.main.show(controlView);
            controlView.listenTo(timer, 'timer:update', controlView.updateTime);
            this.listenTo(timer, 'timer:tick', this.restartLoop);

        },

        restartLoop: function(){
            console.log('trigger loop:restart');
            this.trigger('loop:restart');
        }

    });

});