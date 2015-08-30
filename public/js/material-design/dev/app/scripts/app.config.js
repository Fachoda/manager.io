(function() {
    'use strict';

    angular
        .module('manager')
        .config(config);

    /** @ngInject */
    function config($logProvider) {
        // Enable log
        $logProvider.debugEnabled(true);
    }

}());
