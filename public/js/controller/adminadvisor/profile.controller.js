angular.module('app')
.controller('ad_adviserProfileCtrl', ['$scope', '$mdDialog', '$controller', function ($scope, $mdDialog, $controller) {
    $scope.setUnavail = function (ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'views/AdminAdvisor/unavailability/setUnavailable.html',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose: false
        });
    }

    function DialogController($scope, $mdDialog) {
        $scope.cancel = function () {
            $mdDialog.cancel();
        };
    }

    $http.post('localhost:8000/admin/basicDetails/store',)

}])