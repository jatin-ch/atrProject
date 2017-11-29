angular.module('app')
.controller('adviserProfileCtrl', ['$scope','$rootScope', '$mdDialog', '$controller','$http','$filter','$state','$stateParams', function ($scope,$rootScope, $mdDialog, $controller,$http,$filter,$state,$stateParams) {
   
// $scope.basic = $stateParams.basic;
$scope.files = [];  

$scope.$on("seletedFile", function (event, args) {  
        $scope.$apply(function () {  
            //add the file object to the scope's files collection  
            $scope.files.push(args.file);  
        });  
    });  
    $scope.setUnavail = function (ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'views/Advisor/unavailability/setUnavailable.html',
            parent: angular.element(document.html),
            targetEvent: ev,
            clickOutsideToClose: false
        });
    }
    $rootScope.flagEdit = false; 
     $scope.editProfile = function (data,ev) {
        $rootScope.editData = data;
         $rootScope.flagEdit = true; 
        $mdDialog.show({
            controller: DialogController,
            templateUrl: 'EditUser.html',
             parent:angular.element(document.querySelector('.wrapper')),
            targetEvent: ev,
            clickOutsideToClose: false
        });
    }

    $scope.slickConfig = {
                enabled: true,
            }
             $scope.images = [
                {
                    url: 'images/UserVideos_5178_0006.png'
                },
                {
                    url: 'images/UserVideos_5194_0002.png'
                }, {
                    url: 'images/UserVideos_5194_0002.png'
                }, {
                    url: 'images/UserVideos_5288_0002.png'
                }];


    $scope.SaveBasic = function(param){
        var date=$filter('date')(Date.parse(param.dob), 'dd/MM/yyyy');
        param.dob=date;
        // param.file=$scope.files;
        // $scope.jsonData=param;

        // var formData = new FormData();  
        //         formData.append('model', $scope.jsonData);  
        //             formData.append('file', $scope.files); 
        //             console.log('paramrrr',formData);

            $http({
                    url: "http://localhost:8000/admin/basicDetails",
                    method: "POST",
                    data: param,
                    headers: { 'Content-Type': 'application/json' },  

                     // transformRequest: angular.identity
            
                }).then(function (data) {
                    console.log(data.data.id);
                    if(data.data.id>0){
            $state.go('advisor.profileAddress');
        }else{
            alert('please ');
        }
                    console.log(data);
                },function(error){
                    console.log('error',error);
                });
            }
   
   $scope.savePaymentDetail=function(param)
   {
     console.log(param);
            $http({
                    url: "/admin/payments",
                    method: "POST",
                    data: param
                }).then(function (data) {
                    console.log(data.data.id);
                    if(data.data.id>0){
            // $state.go('advisor.profileAddress');
        }
                    console.log(data);
                },function(error){
                    console.log('error',error);
                });
            }

     $http.get("/admin/basicDetails")
      .then(function(response) {
        console.log("data is..",response);
        if(response.data=="" || response.data.id<0){
            $state.go('advisor.profileBasicDetail');
        }
         $scope.myData = response.data;
      });


    function DialogController($scope,$rootScope, $mdDialog) {
       
        $scope.cancel = function () {
            $mdDialog.cancel();
        };

        console.log('root data edit',$scope.editData);
        if( $rootScope.flagEdit == true ){
             $scope.editBasic = {
                        firstname :$rootScope.editData.firstname,
                        lastname : $rootScope.editData.lastname,
                        dob : $rootScope.editData.dob,
                        gender:$rootScope.editData.gender,
                        mobile:$rootScope.editData.mobile,
                        landline:$rootScope.editData.landline,
                        email:$rootScope.editData.email,
                        language:$rootScope.editData.language,
                        website:$rootScope.editData.website,
                        facebook:$rootScope.editData.facebook,
                        linkedin:$rootScope.editData.linkedin
                    };
                    console.log('rioot editbasic',$rootScope.editBasic);
        }
         $scope.UpdateBasic = function(param,id){
         console.log('param update',param);
         var date=$filter('date')(Date.parse(param.dob), 'dd/MM/yyyy');
         param.dob=date;
            $http({
                    url: "/admin/basicDetails/"+id,
                    method: "PUT",
                    data: param,
                    headers: { 'Content-Type': 'application/json' }  
                }).then(function (data) {
                  console.log('iiiy',data);
                    $mdDialog.cancel();
                },function(error){
                    console.log('error',error);
                });
        };

        
    }
    
}])

.directive('uploadFiles', function () {  
    return {  
        scope: true,        //create a new scope  
        link: function (scope, el, attrs) {  
            el.bind('change', function (event) {  
                var files = event.target.files;  
                //iterate files since 'multiple' may be specified on the element  
                for (var i = 0; i < files.length; i++) {  
                    //emit event upward  
                    scope.$emit("seletedFile", { file: files[i] });  
                }  
            });  
        }  
    };  
})

// .run(['$rootScope','$scope','$state','$stateParams'],function($rootScope,$scope,$state,$stateParams){
//     $rootScope.state = $state;
//     $rootScope.stateParams = $stateParams;
//     console.log('dfsf',$rootScope.state,$rootScope.stateParams);
// })
