
    angular.module('app')
    .controller('ad_offerCtrl', ['$scope', function ($scope) {
        $scope.fromDate = new Date();
        $scope.toDate = new Date();
        $scope.isOpen = false;
        $scope.data = {
            percentDis : 'percent',
        }
       
        
     }])
     .config(function($compileProvider) {
        $compileProvider.preAssignBindingsEnabled(true);
      });