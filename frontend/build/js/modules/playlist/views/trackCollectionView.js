/* global define */
define(
[
    'marionette',
    'jquery',
    'templates',
    'modules/vent/module',
    'modules/playlist/views/trackView',
],
    function(Marionette, $, Templates, vent, TrackView){
    'use strict';

    return Marionette.CollectionView.extend({
    	className: 'table',
    	tagName: 'table',
        itemView: TrackView,

        onRender:function(){
        	var template = Templates['playlist/templates/tableHeadTemplate.html'];
        	this.$el.prepend(template());
        },

        search:function(searchTerm){
            console.log(searchTerm);
            this.collection.fetch({
                data: $.param({
                    term: searchTerm,
                })
            });
        }

    });
});