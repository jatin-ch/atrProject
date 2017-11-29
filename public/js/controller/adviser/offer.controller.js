
angular.module('app')
    .controller('offerCtrl', ['$scope', function ($scope) {
        $scope.fromDate = new Date();
        $scope.toDate = new Date();
        $scope.isOpen = false;
        $scope.percentDiscount = true;
        $scope.flatDiscount = false;
        $scope.servicePercent = false;
        $scope.newOff = {
            consultRadio: 'Consultation',
            percentDis: 'percent',
        }
        $scope.isconsultation = true;
        $scope.changeOfferType = function (type) {
            if (type.consultRadio === 'Consultation') {
                if (type.percentDis === 'percent') {
                    $scope.percentDiscount = true;
                    $scope.flatDiscount = false;
                    $scope.servicePercent = false;
                }else{
                    $scope.flatDiscount = true;
                    $scope.percentDiscount = false;
                    $scope.servicePercent = false;
                }
                $scope.isconsultation = true;
            } else {
                if (type.percentDis === 'percent') {
                    $scope.percentDiscount = false;
                    $scope.flatDiscount = false;
                    $scope.servicePercent = true;
                }else{
                    $scope.flatDiscount = true;
                    $scope.percentDiscount = false;
                    $scope.servicePercent = false;
                }
                $scope.isconsultation = false;
            }
        }
        $scope.changeDiscountType = function (type) {
            if (type.percentDis === 'percent') {
                if (type.consultRadio === 'Consultation') {
                    $scope.percentDiscount = true;
                    $scope.flatDiscount = false;
                    $scope.servicePercent = false;
                }else{
                    $scope.percentDiscount = false;
                    $scope.flatDiscount = false;
                    $scope.servicePercent = true;
                }
            } else {
                $scope.percentDiscount = false;
                $scope.flatDiscount = true;
                $scope.servicePercent = false;
            }
        }
       


    }])
    .config(function ($compileProvider) {
        $compileProvider.preAssignBindingsEnabled(true);
    });