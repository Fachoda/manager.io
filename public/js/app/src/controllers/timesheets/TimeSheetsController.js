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
        vm.minSpareRows = 1;
        vm.maxSpareRows =10;

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
            ],
            onAfterChange: function (changes, source) {
                $log.info(changes, source);
                if (changes) {
                    $log.info(vm.db.items[changes[0][0]]);
                }
                if (changes !== null) {
                    switch (source) {
                        case 'edit':
                            for (var i in changes) {
                                saveData(changes[i]);
                            }
                            break;
                    }
                }
            }
        };

        var saveData = function (changes) {
            var index = changes[0];
            var data = vm.db.items[index];

            if (angular.isDefined(data._id.$id) && data._id.$id !== null) {
                var postData = $.param({
                    json: JSON.stringify({
                        $id: data._id.$id,
                        column: changes[1],
                        value: changes[3]
                    })
                });
                $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
                $http.post(
                    '/timesheets-api/update',
                    postData
                );
                $log.info('saving');
            } else {
                $http.post(
                    '/timesheets-api/save',
                    {}
                );
                $log.info('inserting');
            }
        }
    }
}());