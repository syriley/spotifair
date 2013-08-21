/* global define, describe, it, mocha */
define([
    'marionette',
    'tests/lib/chai',
    'tests/lib/sinon-chai',
    'sinon',
    'modules/looper/views/loopView'],

function(Marionette, chai, sinonChai, sinon, ItemView){
    'use strict';
    var LoopViewTest = Marionette.Controller.extend({

    	getTests: function(){
    		describe('Backup Item View', function(){
	            var should = chai.should();
	            chai.use(sinonChai);
			    it('should throw if model not set', function(){
	                (function(){
	                    new ItemView();
	                }).should.throw;
	            });
		    });
    	}
    });

   	return new LoopViewTest();

});