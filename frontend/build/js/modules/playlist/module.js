define([
	'marionette', 
    'underscore',
	'modules/playlist/models/trackCollection',
	'modules/playlist/views/trackCollectionView',
    'modules/playlist/layout',
], function (Marionette, _, TrackCollection, TrackCollectionView, Layout) {
    // set up the app instance
    return Marionette.Controller.extend({
    	initialize: function(){
    		this.trackCollection = new TrackCollection();
    		this.trackCollection.fetch();
            _.bindAll(this, 'trackSelected');
    	},

    	display: function(region) {
            var view = new TrackCollectionView({
                collection: this.trackCollection,
            });
            view.on('itemview:track:selected', this.trackSelected)
            var layout = new Layout();
            region.show(layout);
            layout.main.show(view);
    	},

        trackSelected: function(track){
            this.trigger('track:selected', track);
        }
    });

});