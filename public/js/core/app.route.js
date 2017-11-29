angular.module('app')
    .config(function ($stateProvider, $urlRouterProvider,$qProvider) {
        // $urlRouterProvider.when("", "/advisor/dashboard");
        // $urlRouterProvider.when("/adminAdvisor", "/adminAdvisor/dashboard");
        $stateProvider
           
           .state('advisor', {
                url: '/advisor',
                views: {
                    'sidebar@': {
                        templateUrl: 'views/Advisor/sidebar.html',
                        controller: 'advisorSidebarCtrl'
                    },
                    'container@': {
                        templateUrl: 'views/Advisor/dashboard.html',
                        controller: 'dashboardCtrl'
                    }
                }
            })

            .state('advisor.adviserChat', {
                url: '/availability/chat',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/availability/adsChat.html',
                        controller: 'availabilityCtrl'
                    }
                }
            })
             .state('advisor.adviserAskUs', {
                url: '/askus',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/askus.html',
                        controller: 'askusController'
                    }
                }
            })
            .state('advisor.adviserPersonalMeet', {
                url: '/availability/personal_meet',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/availability/personalMeet.html',
                        controller: 'availabilityCtrl'
                    }
                }

            })
            .state('advisor.adviserPhoneCall', {
                url: '/availability/phone_call',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/availability/phoneCall.html',
                        controller: 'availabilityCtrl'
                    }
                }
               
            })
            .state('advisor.adviserVideoCall', {
                url: '/availability/video_call',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/availability/videoCall.html',
                        controller: 'availabilityCtrl'
                    }
                }
                
            })

            .state('advisor.postedBlog', {
                url: 'blog/posted',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Blogs/posted_blog.html',
                        controller: 'blogController'
                    }
                }
               
            })
            .state('advisor.writeBlog', {
                url: 'blog/write',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Blogs/write_blog.html',
                        controller: 'blogController'
                    }
                }
               
            })

            .state('advisor.createNewOffer', {
                url: 'offer/create_new_offer',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Offer/createNewOffer.html',
                        controller: 'offerCtrl'
                    }
                }
                
            })
            .state('advisor.existingOffer', {
                url: '/offer/existing_offer',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Offer/existingOffer.html',
                        controller: 'offerCtrl'
                    }
                }
               
            })
            .state('advisor.unAvailable', {
                url: '/unavailability',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/unavailability/UnavailabilityPanel.html',
                        controller: 'unavailableCtrl'
                    }
                }
                
            })
            .state('advisor.profileAddress', {
                url: '/profileAddress',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Profile/Address.html',
                        controller: 'adviserProfileCtrl'
                    }
                }
               
            })
            .state('advisor.profileBasicDetail', {
                url: '/profileBasicDetail',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Profile/Basic_Detail.html',
                        controller: 'adviserProfileCtrl',
                        params : {basic:null}
                    }
                }
               
            })

            // .state('advisor.Edit', {
            //     url: '/profileBasicDetail/edit',
            //     views: {
            //         'container@': {
            //             templateUrl: 'views/Advisor/Profile/Basic_Detail.html',
            //             controller: 'adviserProfileCtrl',
            //             params: {basic:null},
            //         }
            //     }
               
            // })

            .state('advisor.profile', {
                url: '/profile',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Profile/profile.html',
                        controller: 'adviserProfileCtrl'
                    }
                }
               
            })


            .state('advisor.profilePaymentDetail', {
                url: '/profilePaymentDetail',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Profile/PaymentDetail.html',
                        controller: 'adviserProfileCtrl'
                    }
                }
                
            })
            .state('advisor.profileVerificationDetail', {
                url: '/profileVerificationDetail',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Profile/verfication_detail.html',
                        controller: 'adviserProfileCtrl'
                    }
                }
               
            })
            .state('advisor.profileExpertDetail', {
                url: '/expert',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Profile/ExpertDetail.html',
                        controller: 'adviserProfileCtrl'
                    }
                }
               
            })
            .state('advisor.appointmentProvided', {
                url: '/appointment/appointmentProvided',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Appointment/provided.html',
                        controller: 'appointmentCtrl'
                    }
                }
               
            })

            .state('advisor.appointmentRecieved', {
                url: '/appointment/appointmentRecieved',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Appointment/recieved.html',
                        controller: 'appointmentCtrl'
                    }
                }
                
            })

            .state('advisor.AddService', {
                url: '/service/AddService',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Service/AddServices.html',
                        controller: 'serviceCtrl'
                    }
                }
               
            })

            .state('advisor.ListedService', {
                url: '/service/ListedService',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Service/ListedServices.html',
                        controller: 'serviceCtrl'
                    }
                }
               
            })

            .state('advisor.Invoice', {
                url: '/Invoice/invoice',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/Invoice/invoice.html',
                        controller: 'invoiceCtrl'
                    }
                }
                
            })
            .state('advisor.dashboard', {
                url: '/dashboard',
                views: {
                    'container@': {
                        templateUrl: 'views/Advisor/dashboard.html',
                        controller: 'dashboardCtrl'
                    }
                }
            })




            // AdminAdvisor

            .state('adminAdvisor', {
                url: '/adminadvisor',
                views: {
                    'sidebar@': {
                        templateUrl: 'views/AdminAdvisor/sidebar.html',
                        controller: 'adminAdvisorSidebarCtrl'
                    },
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/dashboard.html',
                        controller: 'ad_dashboardCtrl'
                    }
                }
            })
            .state('adminAdvisor.Dashboard', {
                url: '/dashboard',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/dashboard.html',
                        controller: 'ad_dashboardCtrl'
                    }
                }
            })

            .state('adminAdvisor.ad_adviserChat', {
                url: '/availability/chat',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/availability/adsChat.html',
                        controller: 'ad_availabilityCtrl'
                    }
                }
               
            })
            .state('adminAdvisor.ad_adviserPersonalMeet', {
                url: '/availability/personal_meet',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/availability/personalMeet.html',
                        controller: 'ad_availabilityCtrl'
                    }
                }
                
            })
            .state('adminAdvisor.ad_adviserPhoneCall', {
                url: '/availability/phone_call',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/availability/phoneCall.html',
                        controller: 'ad_availabilityCtrl'
                    }
                }
                
            })
            .state('adminAdvisor.ad_adviserVideoCall', {
                url: 'images/availability/video_call',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/availability/videoCall.html',
                        controller: 'ad_availabilityCtrl'
                    }
                }
               
            })

            .state('adminAdvisor.ad_postedBlog', {
                url: '/blog/posted',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Blogs/posted_blog.html',
                        controller: 'ad_blogController'
                    }
                }
                
            })
            .state('adminAdvisor.ad_writeBlog', {
                url: '/blog/write',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Blogs/write_blog.html',
                        controller: 'ad_blogController'
                    }
                }
                
            })

            .state('adminAdvisor.ad_createNewOffer', {
                url: '/offer/create_new_offer',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Offer/createNewOffer.html',
                        controller: 'ad_offerCtrl'
                    }
                }
                
            })
            .state('adminAdvisor.ad_existingOffer', {
                url: '/offer/existing_offer',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Offer/existingOffer.html',
                        controller: 'ad_offerCtrl'
                    }
                }
                
            })
            .state('adminAdvisor.ad_unAvailable', {
                url: '/unavailability',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/unavailability/UnavailabilityPanel.html',
                        controller: 'ad_unavailableCtrl'
                    }
                }
                
            })
            .state('adminAdvisor.ad_profileAddress', {
                url: '/profileAddress',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Profile/Address.html',
                        controller: 'ad_adviserProfileCtrl'
                    }
                }
                
            })
            .state('adminAdvisor.ad_profileBasicDetail', {
                url: '/profileBasicDetail',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Profile/Basic_Detail.html',
                        controller: 'ad_adviserProfileCtrl'
                    }
                }
                
            })
            .state('adminAdvisor.ad_profilePaymentDetail', {
                url: '/profilePaymentDetail',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Profile/PaymentDetail.html',
                        controller: 'ad_adviserProfileCtrl'
                    }
                }
                
            })
            .state('adminAdvisor.ad_profileVerificationDetail', {
                url: '/profileVerificationDetail',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Profile/verfication_detail.html',
                        controller: 'ad_adviserProfileCtrl'
                    }
                }
                
            })
            .state('adminAdvisor.ad_appointmentProvided', {
                url: '/appointment/appointmentProvided',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Appointment/provided.html',
                        controller: 'ad_appointmentCtrl'
                    }
                }
                
            })

            .state('adminAdvisor.ad_appointmentRecieved', {
                url: '/appointment/appointmentRecieved',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Appointment/recieved.html',
                        controller: 'ad_appointmentCtrl'
                    }
                }
                
            })

            .state('adminAdvisor.ad_AddService', {
                url: '/service/AddService',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Service/AddServices.html',
                        controller: 'ad_serviceCtrl'
                    }
                }
               
            })

            .state('adminAdvisor.ad_ListedService', {
                url: '/service/ListedService',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Service/ListedServices.html',
                        controller: 'ad_serviceCtrl'
                    }
                }
               
            })

            .state('adminAdvisor.ad_Invoice', {
                url: '/Invoice/invoice',
                views: {
                    'container@': {
                        templateUrl: 'views/AdminAdvisor/Invoice/invoice.html',
                        controller: 'ad_invoiceCtrl'
                    }
                }
               
            })
            

        // $urlRouterProvider.otherwise('/adminadvisor/dashboard');
        // $urlRouterProvider.otherwise('/adviser/dashboard');
         $qProvider.errorOnUnhandledRejections(false);
    });


angular.module('webApp')
.config(function ($stateProvider, $urlRouterProvider,$qProvider) {
     $stateProvider
           
           .state('website', {
                url: '',
                templateUrl: 'views/Website/home.html',
                controller: 'websiteCtrl'
            })
           .state('product', {
                url: '/product',
                templateUrl: 'views/Website/product.html',
                controller: 'productCtrl'
            })
           // .state('product', {
           //      url: '/product',
           //      templateUrl: 'views/Website/dashboard.html',
           //      controller: 'websiteCtrl'
                
           //  })
    });