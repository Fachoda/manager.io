(function () {
    'use strict';

    angular
        .module('manager')
        .run(runBlock);

    /** @ngInject */
    function runBlock($log) {

        $log.debug('runBlock end');
    }

}());
