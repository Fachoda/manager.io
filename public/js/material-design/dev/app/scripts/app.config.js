(function() {
    'use strict';

    angular
        .module('manager')
        .config(['$logProvider', '$mdIconProvider', config]);

    /** @ngInject */
    function config($logProvider, $mdIconProvider) {
        // Enable log
        $logProvider.debugEnabled(true);

        $mdIconProvider.fontSet('mi', 'material-icons');
    }

}());
