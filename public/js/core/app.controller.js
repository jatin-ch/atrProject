angular.module('app')

.controller('mainCtrl',function($scope, $mdDialog) {

  $scope.status = '  ';
  $scope.customFullscreen = false;
  
  $scope.Delete = function(ev) {
    $mdDialog.show({
      controller: DialogController,
      templateUrl: 'Delete.html',
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

})


