/* global define */
define([
	'marionette',
	'templates'
], function (Marionette, Templates) {
	'use strict';
	return Marionette.Layout.extend({
		className: 'playlistModule',
        template : Templates['playlist/templates/layoutTemplate.html'],

		regions:{
			search: '.search',
			main: '.main',
		}
	});
  });