/**
 * Created by adrian on 13.12.2015.
 */
(function () {
    'use strict';

    angular
        .module('manager')
        .controller('TimeSheetsController', [
            '$log', '$http',
            TimeSheetsController
        ]);


    function TimeSheetsController($log, $http)
    {
        var vm = this;

        vm.rowHeaders = true;
        vm.colHeaders = true;
        vm.db = {
            items: []
        };

        $http.get('/timesheets-api/list')
            .then(function (result) {
                vm.db.items = result.data;
                $log.info(result);
            })
            .catch(function (err) {
                $log.error(err);
            });

        // ..or as one object
        vm.settings = {
            contextMenu: [
                'row_above', 'row_below', 'remove_row'
            ]
        };

        $log.info(vm);
    }
}());