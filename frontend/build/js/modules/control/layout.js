/* global define */
define([
    'marionette',
    'templates'
], function (Marionette, Templates) {
    'use strict';
    return Marionette.Layout.extend({
        className: 'container controlModule',
        template : Templates['control/templates/layoutTemplate.html'],

        regions:{
            main: '.main',
            
        }
    });
  });