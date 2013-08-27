define([
	'marionette', 
    'underscore',
    'events/searchVent',
	'modules/playlist/models/trackCollection',
	'modules/playlist/views/trackCollectionView',
    'modules/playlist/views/searchView',
    'modules/playlist/layout',
], function (Marionette, _, vent, TrackCollection, TrackCollectionView, SearchView, Layout) {
    // set up the app instance
    return Marionette.Controller.extend({
    	initialize: function(){
    		this.trackCollection = new TrackCollection();
    		this.trackCollection.fetch();
            _.bindAll(this, 'trackSelected', 'search');
            vent.on('search:request', this.search);
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
    	},

        trackSelected: function(track){
            this.trigger('track:selected', track);
        },

        search:function(search){
            console.log(search);
            this.trackCollection.fetch({
                data: $.param(search)
            });
        }

    });

});