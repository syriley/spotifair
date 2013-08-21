define([
    'marionette',
    'modules/playlist/module',
    'modules/videoPlayer/module',
    'utilities/cookie',
], function (Marionette,
    PlaylistModule,
    VideoPlayerModule,
    Cookie) {
    'use strict';

    // set up the app instance
    var app = new Marionette.Application();

    app.addRegions({
        messageRegion:     '.messageRegion',
        videoPlayerRegion: '.videoPlayerRegion',
        controlRegion:     '.controlRegion',
        playlistRegion:    '.playlistRegion',

    });

    app.addInitializer(function(options){

        var playlistModule = new PlaylistModule();
        playlistModule.display(app.playlistRegion);

        // var controlModule = new ControlModule();
        // controlModule.display(app.controlRegion);

        var videoPlayerModule = new VideoPlayerModule();

        videoPlayerModule.display(app.videoPlayerRegion);
        videoPlayerModule.listenTo(playlistModule, 'track:selected', videoPlayerModule.selectTrack);


        // var messageModule = new MessageModule();
        // messageModule.display(app.messageRegion);

    });

    return app;
});

