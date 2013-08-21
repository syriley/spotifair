define([
	'marionette', 
    'underscore',
	'modules/videoPlayer/layout',
    'modules/videoPlayer/views/videoPlayerView',

], function (Marionette, 
    _, 
    Layout,
    VideoPlayerView
    ) {
    'strict mode';

    // set up the app instance
    return Marionette.Controller.extend({

        display: function(region) {
            var layout = new Layout();
            region.show(layout);
            this.videoPlayerView = new VideoPlayerView();
            layout.player.show(this.videoPlayerView);
        },

        selectTrack: function(track){
            console.log('track selected', track);
            this.videoPlayerView.selectTrack(track);
        },

    });

});