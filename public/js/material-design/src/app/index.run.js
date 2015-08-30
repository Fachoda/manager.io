(function () {
    'use strict';

    angular
        .module('materialDesign')
        .run(runBlock);

    /** @ngInject */
    function runBlock($log) {

        $log.debug('runBlock end');
    }

}());
