/* global define */
define(
    [
    'backbone',
    'modules/playlist/models/track'],
    function(Backbone, Loop){
        return Backbone.Collection.extend({
            url: '/api/tracks',
            model: Loop,

            category: function(category){
            	return this.filter(function(loop) {
		            return loop.get('category') == category;
		        });
            }
        });
    });