define([
	'marionette', 
	'modules/message/views/messageView'
], function (Marionette, MessageView) {
    // set up the app instance
    return Marionette.Controller.extend({

    	display: function(region) {
            this.view = new MessageView();
    		region.show(this.view);
    	},

    	showMessage: function(messageName){
    		this.view.showMessage(messageName);
    	},

        

    });

});