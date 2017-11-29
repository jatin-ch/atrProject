
    angular.module('app')
    .controller('ad_availabilityCtrl', ['$scope','$mdpTimePicker', function ($scope,$mdpTimePicker) {
        $scope.tabs = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday']
        $scope.subTabs = ['First Shift','Second Shift'];
        // $scope.showTimePicker = function(ev) {
        //     $mdpTimePicker($scope.currentTime, {
        //     targetEvent: ev
        //   }).then(function(selectedDate) {
        //     $scope.currentTime = selectedDate;
        //   });
        // }  
    }]);