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
        vm.colHeaders = ['Project', 'Task', 'Date', 'Duration', 'Billable'];
        vm.db = {
            items: [],
            projects: ['test1', 'test2'],
            tasks: ['test1', 'test2']
        };
        vm.minSpareRows = 1;
        vm.maxSpareRows =10;
        vm.columns = [
            {
                data: 'project_id',
                type: 'autocomplete',
                source: vm.db.projects,
                strict: false
            },
            {
                data: 'task_id',
                type: 'autocomplete',
                source: vm.db.tasks,
                strict: false
            },
            {
                data: 'date',
                type: 'date'
            },
            {
                data: 'duration',
                type: 'numeric'
            },
            {
                data: 'billable',
                type: 'checkbox'
            }
        ];

        $http.get('/api/tasks')
            .then(function (result) {
                vm.db.tasks = $.map(result.data.data, function (item) {
                    return item.title;
                });
                $log.info(vm.db.tasks);
            })
            .catch(function (err) {
                $log.error(err);
            });

        $http.get('/api/projects')
            .then(function (result) {
                vm.db.projects = $.map(result.data.data, function (item) {
                    return item.title;
                });
                $log.info(vm.db.projects);
            })
            .catch(function (err) {
                $log.error(err);
            });

        $http.get('/api/timesheets')
            .then(function (result) {
                vm.db.items = result.data.data;
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

            $log.info(data);
            if (angular.isDefined(data.id) && data.id !== null) {
                //var postData = $.param({
                //    json: JSON.stringify(data)
                //});
                var postData = data;
                $http.defaults.headers.post["Content-Type"] = "application/json";
                $http.put(
                    '/api/timesheets/' + data.id,
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