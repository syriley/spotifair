define([
	'marionette', 
    'underscore',
	'modules/playlist/models/trackCollection',
	'modules/playlist/views/trackCollectionView',
    'modules/playlist/views/searchView',
    'modules/playlist/layout',
], function (Marionette, _, TrackCollection, TrackCollectionView, SearchView, Layout) {
    // set up the app instance
    return Marionette.Controller.extend({
    	initialize: function(){
    		this.trackCollection = new TrackCollection();
    		this.trackCollection.fetch();
            _.bindAll(this, 'trackSelected');
    	},

    	display: function(region) {
            var playlistView = new TrackCollectionView({
                collection: this.trackCollection,
            });
            var searchView = new SearchView();
            playlistView.on('itemview:track:selected', this.trackSelected)
            var layout = new Layout();
            region.show(layout);
            layout.main.show(playlistView);
            layout.search.show(searchView);
            playlistView.listenTo(searchView, 'search:request', playlistView.search);
    	},

        trackSelected: function(track){
            this.trigger('track:selected', track);
        }
    });

});