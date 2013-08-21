/* global define */
define([
	'marionette',
	'templates'
], function (Marionette, Templates) {
	'use strict';
	return Marionette.Layout.extend({
		className: 'container videoPlayerModule',
        template : Templates['videoPlayer/templates/layoutTemplate.html'],

		regions:{
			player: '.player',
		}
	});
  });