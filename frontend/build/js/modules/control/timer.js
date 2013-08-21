define(['marionette',
        'underscore',
        'modules/vent/module'
],function(Marionette, _, vent){
    return Marionette.Controller.extend({

        initialize: function(){
            this.maxTime = 5275;
            _.bindAll(this, 'start', 'stop', 'triggerTimer', 'updateTimer');
            this.isRunning = false;
        },

    	start: function() {
            console.log('starting');
            this.triggerTimer();
            this.interval = window.setInterval(this.triggerTimer, this.maxTime);
            this.isRunning = true;
        },

        stop: function(){
            console.log('stopping');
            for (var i = 1; i <= this.interval; i++) {
                window.clearInterval(i);
            }
            for (var i = 1; i <= this.progressInterval; i++) {
                window.clearInterval(i);
            }
            this.isRunning = false;
    	},

    	triggerTimer: function(){
    		console.log('trigger:timer');
            this.startTime = new Date().getTime();
            this.progressInterval = window.setInterval(this.updateTimer, 200);
    		this.trigger('timer:tick');
            vent.trigger('timer:tick');
    	},

        updateTimer: function(){
            var now = new Date().getTime();
            var timerPercent = Math.round(100 * ((now - this.startTime) / this.maxTime));
            this.trigger('timer:update', timerPercent);

        }
    });
})