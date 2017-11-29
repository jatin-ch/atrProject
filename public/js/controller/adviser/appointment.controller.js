
angular.module('app')

.controller('appointmentCtrl', function($scope, $mdDialog) {
  $scope.date=new Date();
  $scope.status = '  ';
  $scope.customFullscreen = false;
  
  $scope.showAdvanced = function(ev) {
    $mdDialog.show({
      controller: DialogController,
      templateUrl: 'EditUser.html',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:true,
    })
  };

$scope.AddAppointment = function(ev) {
    $mdDialog.show({
      controller: DialogController,
      templateUrl: 'AddAppointment.html',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:true,
    })
  };
  
  function DialogController($scope, $mdDialog) {
    $scope.hide = function() {
      $mdDialog.hide();
    };

    $scope.cancel = function() {
      $mdDialog.cancel();
    };

    $scope.answer = function(answer) {
      $mdDialog.hide(answer);
    };
  }
});