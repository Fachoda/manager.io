(function() {
    'use strict';

    angular
        .module('manager')
        .config(routeConfig);

    /** @ngInject */
    function routeConfig($stateProvider, $urlRouterProvider) {
        $stateProvider
            .state('index', {
                url: '/',
                templateUrl: 'app/partials/index/index.html',
                controller: 'IndexCtrl',
                controllerAs: 'index'
            });

        $urlRouterProvider.otherwise('/');
    }

}());
