angular.module('app')
.controller("ad_serviceCtrl",function($scope, $mdDialog) {
  $scope.status = '  ';
  $scope.customFullscreen = false;
  
  $scope.EditService = function(ev) {
    $mdDialog.show({
      controller: DialogController,
      templateUrl: 'EditService.html',
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