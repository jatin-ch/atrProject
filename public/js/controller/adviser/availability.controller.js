
angular.module('app')
    .controller('availabilityCtrl', ['$scope', '$mdpTimePicker', function ($scope, $mdpTimePicker) {
        $scope.tabs = [
            { day: ' Monday' },
            { day: ' Tuesday' },
            { day: ' Wednesday' },
            { day: ' Thursday' },
            { day: ' Friday' },
            { day: ' Saturday' },
            { day: ' Sunday' }]

        $scope.subTabs = ['First Shift', 'Second Shift'];
        $scope.arr = ['1', '2'];
        
        $scope.meet = {
            fromDate: '02:40 AM'
        }

        $scope.submitPhoneCall = function (callData) {
            var date_from_phone = $("#fromdatePhone").val();
            var date_to_phone = $("#todatePhone").val();
            meetData.fromDate = date_from_phone;
            meetData.toDate = date_to_phone;
            console.log('call detail', callData);
            var dayCheckPhoneCall = [];
            console.log('personal meet data', meetData);
            angular.forEach($scope.tabs, function (tab) {
                if (tab.selected) {
                    dayCheckPhoneCall.push(tab);
                    console.log('daychecj', dayCheckPhoneCall);
                }
            })
        }
        $scope.submitVideoCall = function (videoData) {
            var date_from_video = $("#fromdateVideo").val();
            var date_to_video = $("#todateVideo").val();
            meetData.fromDate = date_from_video;
            meetData.toDate = date_to_video;
            console.log('video call data', videoData);
            var dayCheckVideoCall = [];
            console.log('personal meet data', meetData);
            angular.forEach($scope.tabs, function (tab) {
                if (tab.selected) {
                    dayCheckVideoCall.push(tab);
                    console.log('daychecj', dayCheckVideoCall);
                }
            })
        }
        $scope.submitMeet = function (meetData) {
            var date_from_meet = $("#fromdateMeet").val();
            var date_to_meet = $("#todateMeet").val();
            meetData.fromDate = date_from_meet;
            meetData.toDate = date_to_meet;
            var dayCheckMeet = [];
            console.log('personal meet data', meetData);
            angular.forEach($scope.tabs, function (tab) {
                if (tab.selected) {
                    dayCheckMeet.push(tab);
                    console.log('daychecj', dayCheckMeet);
                }
            })
        }
        $scope.submitChat = function(chat){
            var date_from_chat = $("#fromdateChat").val();
            var date_to_chat = $("#todateChat").val();
            meetData.fromDate = date_from_chat;
            meetData.toDate = date_to_chat;
            var dayCheckChat = [];
            console.log('chat data', chat);
            angular.forEach($scope.tabs, function (tab) {
                if (tab.selected) {
                    dayCheckChat.push(tab);
                    console.log('daychecj', dayCheckChat);
                }
            })
        }
        
    }]);