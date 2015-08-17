(function () {
  'use strict';

  function MainController($scope, $timeout, $mdSidenav, $mdUtil, $mdMedia, $log)
  {
    $scope.mediaGtMd = $mdMedia('gt-md');
    $scope.toggleMainMenu = buildToggler('main-menu');

    function buildToggler(navID) {
      return $mdUtil.debounce(function () {
        $mdSidenav(navID)
          .toggle()
          .then(function () {
            $log.debug('toggle ' + navID + ' is done');
          })
      }, 200);
    }
  }

  app.controller('MainController', ['$scope', '$timeout', '$mdSidenav', '$mdUtil', '$mdMedia', '$log', MainController]);
})();
