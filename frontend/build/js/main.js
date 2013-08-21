require.config({
  baseUrl: '/app/js/',
  paths : {
    jquery : 'lib/jquery.min',
    underscore : 'lib/underscore',
    backbone : 'lib/backbone-min',
    marionette : 'lib/marionette',
    'backbone.wreqr' : 'lib/backbone.wreqr',
    'backbone.babysitter' : 'lib/backbone.babysitter',
    handlebars: 'lib/handlebars',
    templates: 'templates/templates',
    popcorn: 'lib/popcorn',
    isotope: 'lib/isotope',
    bootstrap: 'lib/bootstrap',
    facebook: '//connect.facebook.net/en_US/all',
    twitter: '//platform.twitter.com/widgets',
  },
  shim : {
    jquery : {
      exports : 'jQuery'
    },
    isotope : {
      deps : ['jquery'],
    },
    underscore : {
      exports : '_'
    },
    bootstrap: {
      deps: ['jquery'],
    },
    backbone : {
      deps : ['jquery', 'underscore'],
      exports : 'Backbone'
    },
    marionette : {
      deps : ['jquery', 'underscore', 'backbone'],
      exports : 'Marionette'
    },
    'backbone.wreqr' : {
      deps: ['backbone'],
    },
    'backbone.babysitter': {
      deps: ['backbone'], 
    },
    handlebars:{
      exports: 'Handlebars'
    },
    facebook: {
      exports: 'FB',
    },
    twitter: {
      exports: 'twttr',
    }

  }
});

