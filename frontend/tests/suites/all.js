/* global mocha */
require(['tests/modules/looper/views/loopViewTest',
    ],
function(loopViewTest
    
    ){
    'use strict';
    loopViewTest.getTests();
    
    mocha.run();
});