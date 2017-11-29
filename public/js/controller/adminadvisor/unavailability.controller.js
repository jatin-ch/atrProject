angular.module('app')
    .controller('ad_unavailableCtrl', ['$scope', '$mdDialog', '$controller', function ($scope, $mdDialog, $controller) {
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
    }])