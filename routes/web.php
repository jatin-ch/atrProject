<?php

use App\Events\MessagePosted;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mySearch', 'HomeController@mySearch')->name('mySearch');
Route::get('/liveSearch', 'HomeController@search')->name('liveSearch');

Auth::routes();
Route::get('expert/create', 'ExpertRegisterController@create')->name('expert.create');
Route::post('expert/create', 'ExpertRegisterController@store')->name('expert.store');
Route::get('/hit', 'HomeController@newHit');




Route::post('/dashboard', 'DashboardController@dashboard')->name('dashboard');

Route::get('/newTest', 'HomeController@newTest')->name('newTest');
Route::get('/newGet', 'HomeController@newGet')->name('newGet');
Route::get('/newTime', 'HomeController@newTime')->name('newTime');

/*
|--------------------------------------------------------------------------
| Web Routes for ADVISER
|--------------------------------------------------------------------------
*/

Route::prefix('adviser')->middleware('auth')->group(function () {

  Route::get('/', 'Adviser\DashboardController@index')->name('adviser.dashboard');

  // Profile Setting Controller
  Route::get('profile-settings', 'Adviser\ProfileSettingController@getSettings')->name('profile.settings.get');
  Route::post('profile-settings', 'Adviser\ProfileSettingController@updateSettings')->name('profile.settings.update');
  Route::post('/profile-picture', 'Adviser\ProfileSettingController@uploadPhoto')->name('profile.photo.upload');

  // Adviser BasicDetail routes
  Route::get('/basicDetails', 'Adviser\BasicDetailController@index')->name('adviser.basicDetails.index');
  Route::post('/basicDetails', 'Adviser\BasicDetailController@store')->name('adviser.basicDetails.store');
  Route::put('/basicDetails/{id}','Adviser\BasicDetailController@update')->name('adviser.basicDetails.update');

  // Location routes
  Route::get('/locations', 'Adviser\LocationController@index')->name('adviser.locations.index');
  Route::post('/locations', 'Adviser\LocationController@store')->name('adviser.locations.store');
  Route::put('/locations/{id}', 'Adviser\LocationController@update')->name('adviser.locations.update');
  Route::delete('/locations/{id}', 'Adviser\LocationController@destroy')->name('adviser.locations.destroy');

  // Payment routes
  Route::get('/payments','Adviser\PaymentController@index')->name('adviser.payments.index');
  Route::post('/payments','Adviser\PaymentController@store')->name('adviser.payments.store');
  Route::put('/payments/{id}','Adviser\PaymentController@update')->name('adviser.payments.update');

  // Verification details routes
  Route::get('/verifications','Adviser\VerificationController@index')->name('adviser.verifications.index');
  Route::post('/verifications','Adviser\VerificationController@store')->name('adviser.verifications.store');

  // Expert details routes
  Route::get('/expertDetails', 'Adviser\ExpertDetailController@index')->name('adviser.expertDetails.index');
  Route::post('/expertDetails', 'Adviser\ExpertDetailController@store')->name('adviser.expertDetails.store');
  Route::put('/expertDetails/{id}', 'Adviser\ExpertDetailController@update')->name('adviser.expertDetails.update');

  /*
  |--------------------------------------------------------------------------
  | Extra Routes for Expert Details
  |--------------------------------------------------------------------------
  */
  Route::post('/expertDetails/education', 'Admin\EDC\EducationController@store')->name('education.store');
  Route::put('/expertDetails/education/{id}', 'Admin\EDC\EducationController@update')->name('education.update');
  Route::delete('/expertDetails/education/{id}', 'Admin\EDC\EducationController@destroy')->name('education.destroy');

  Route::post('/expertDetails/workexp', 'Admin\EDC\WorkExpController@store')->name('workexp.store');
  Route::put('/expertDetails/workexp/{id}', 'Admin\EDC\WorkExpController@update')->name('workexp.update');
  Route::delete('/expertDetails/workexp/{id}', 'Admin\EDC\WorkExpController@destroy')->name('workexp.destroy');

  Route::post('/expertDetails/specialization', 'Admin\EDC\SpecializationController@store')->name('specialization.store');
  Route::put('/expertDetails/specialization/{id}', 'Admin\EDC\SpecializationController@update')->name('specialization.update');
  Route::delete('/expertDetails/specialization/{id}', 'Admin\EDC\SpecializationController@destroy')->name('specialization.destroy');

  Route::post('/expertDetails/membership', 'Admin\EDC\MembershipController@store')->name('membership.store');
  Route::put('/expertDetails/membership/{id}', 'Admin\EDC\MembershipController@update')->name('membership.update');
  Route::delete('/expertDetails/membership/{id}', 'Admin\EDC\MembershipController@destroy')->name('membership.destroy');

  Route::post('/expertDetails/award', 'Admin\EDC\AwardController@store')->name('award.store');
  Route::put('/expertDetails/award/{id}', 'Admin\EDC\AwardController@update')->name('award.update');
  Route::delete('/expertDetails/award/{id}', 'Admin\EDC\AwardController@destroy')->name('award.destroy');

  // Blog Post routes
  Route::get('/posts', 'Adviser\PostController@index')->name('adviser.posts.index');
  Route::get('/posts/create', 'Adviser\PostController@create')->name('adviser.posts.create');
  Route::get('posts/{id}','Adviser\PostController@show')->name('adviser.posts.show');
  Route::get('posts/{id}/edit','Adviser\PostController@edit')->name('adviser.posts.edit');
  Route::post('/posts', 'Adviser\PostController@store')->name('adviser.posts.store');
  Route::put('/posts/{id}', 'Adviser\PostController@update')->name('adviser.posts.update');
  Route::delete('/posts/{id}', 'Adviser\PostController@destroy')->name('adviser.posts.destroy');
  Route::post('/posts/tags', 'Adviser\TagController@store')->name('adviser.tags.store');

  // Service routes
  Route::resource('/services', 'Adviser\ServiceController');

  // Offer routes
  Route::resource('/offers', 'Adviser\OfferController');

  // Availability routes
  Route::get('/availabilities/phone_call', 'Adviser\AvailabilityController@phoneCall')->name('availabilities.phoneCall');
  Route::get('/availabilities/video_call', 'Adviser\AvailabilityController@videoCall')->name('availabilities.videoCall');
  Route::get('/availabilities/chat', 'Adviser\AvailabilityController@chat')->name('availabilities.chat');
  Route::get('/availabilities/personal_meeting', 'Adviser\AvailabilityController@personalMeeting')->name('availabilities.personalMeeting');
  Route::post('/availabilities', 'Adviser\AvailabilityController@store')->name('availabilities.store');
  Route::put('/availabilities/{id}', 'Adviser\AvailabilityController@update')->name('availabilities.update');
  Route::delete('/availabilities/{id}', 'Adviser\AvailabilityController@destroy')->name('availabilities.destroy');
  Route::post('/availabilities/firstshift/store', 'Adviser\FirstShiftController@store')->name('availabilities.firstshift.store');
  Route::put('/availabilities/firstshift/{id}', 'Adviser\FirstShiftController@update')->name('availabilities.firstshift.update');
  Route::delete('/availabilities/firstshift/{id}', 'Adviser\FirstShiftController@destroy')->name('availabilities.firstshift.destroy');

  // Un-availibility routes
  Route::resource('/un-availabilities', 'Adviser\UnAvailabilityController', ['except' => ['create', 'show', 'edit']]);

  //Booking Controller
  Route::get('bookings/consultation', 'Adviser\BookingController@showConsultation')->name('adviser.bookings.consultation');
  Route::post('bookings/consultation/confirm/{id}', 'Adviser\BookingController@confirmConsultation')->name('adviser.bookings.consultation.confirm');
  Route::post('bookings/consultation/cancel/{id}', 'Adviser\BookingController@cancelConsultation')->name('adviser.bookings.consultation.cancel');
  Route::post('bookings/consultation/document/{id}', 'Adviser\BookingController@sendConsultationDocument')->name('adviser.bookings.consultation.document');

  Route::get('bookings/service', 'Adviser\BookingController@showService')->name('adviser.bookings.service');
  Route::post('bookings/service/confirm/{id}', 'Adviser\BookingController@confirmService')->name('adviser.bookings.service.confirm');
  Route::post('bookings/service/cancel/{id}', 'Adviser\BookingController@cancelService')->name('adviser.bookings.service.cancel');
  Route::post('bookings/service/document/{id}', 'Adviser\BookingController@sendServiceDocument')->name('adviser.bookings.service.document');

  Route::post('bookings/reschedule/{id}', 'Adviser\BookingController@reschedule')->name('adviser.bookings.reschedule');

  // Recieved Bookings routes
  Route::get('bookings', 'Adviser\OfflineBookingController@index')->name('bookings.index');
  Route::post('bookings/offline', 'Adviser\OfflineBookingController@store')->name('bookings.offline.store');


  // Booking routes
  Route::get('bookings/recieved/consultation', 'Adviser\BookingRecievedController@consultation')->name('bookings.recieved.consultation');
  Route::post('bookings/recieved/consultation/confirm/{id}', 'Adviser\BookingRecievedController@confirmConsultation')->name('bookings.recieved.consultation.confirm');
  Route::post('bookings/recieved/consultation/cancel/{id}', 'Adviser\BookingRecievedController@cancelConsultation')->name('bookings.recieved.consultation.cancel');
  Route::post('bookings/recieved/consultation/document/{id}', 'Adviser\BookingRecievedController@sendConsultationDocument')->name('bookings.recieved.consultation.document');

  Route::get('bookings/recieved/service', 'Adviser\BookingRecievedController@service')->name('bookings.recieved.service');
  Route::post('bookings/recieved/service/confirm/{id}', 'Adviser\BookingRecievedController@confirmService')->name('bookings.recieved.service.confirm');
  Route::post('bookings/recieved/service/cancel/{id}', 'Adviser\BookingRecievedController@cancelService')->name('bookings.recieved.service.cancel');
  Route::post('bookings/recieved/service/document/{id}', 'Adviser\BookingRecievedController@sendServiceDocument')->name('bookings.recieved.service.document');
  Route::post('bookings/recieved/service/dispute/{id}', 'Adviser\BookingRecievedController@raiseDispute')->name('bookings.recieved.service.dispute');

  Route::post('bookings/recieved/reschedule/{id}', 'Adviser\BookingRecievedController@reschedule')->name('bookings.recieved.reschedule');

  // Aks Us Routes
  Route::get('/ask_us/questions', 'Adviser\Asks\QuestionController@questions')->name('adviser.asks.questions');
  Route::get('/ask_us/questions/{id}', 'Adviser\Asks\QuestionController@show')->name('adviser.questions.show');
  Route::post('ask_us/questions', 'Adviser\Asks\QuestionController@search')->name('adviser.questions.search');

  // Galleries details routes
  Route::get('/galleries', 'Adviser\GalleryController@index')->name('adviser.galleries.index');
  Route::post('/galleries', 'Adviser\GalleryController@store')->name('adviser.galleries.store');

  Route::get('/chat', 'Adviser\ChatController@index');

});












/*
|--------------------------------------------------------------------------
| Web Routes for USER
|--------------------------------------------------------------------------
*/

Route::prefix('user')->middleware('auth')->group(function () {

  Route::get('/', 'User\DashboardController@index')->name('user.dashboard');

  // Profile Setting Controller
  Route::get('profile-settings', 'User\ProfileSettingController@index')->name('user.profile.settings');
  Route::post('profile-settings', 'User\ProfileSettingController@update')->name('user.profile.settings.update');
  Route::post('/profile-picture', 'User\ProfileSettingController@uploadPhoto')->name('user.profile.photo.upload');

  // User BasicDetail routes
  Route::get('/basicDetails', 'User\BasicDetailController@index')->name('user.basicDetails.index');
  Route::post('/basicDetails', 'User\BasicDetailController@store')->name('user.basicDetails.store');
  Route::put('/basicDetails/{id}', 'User\BasicDetailController@update')->name('user.basicDetails.update');

  // Blog Post routes
  Route::get('/posts', 'User\PostController@index')->name('user.posts.index');
  Route::get('/posts/create', 'User\PostController@create')->name('user.posts.create');
  Route::get('posts/{id}','User\PostController@show')->name('user.posts.show');
  Route::get('posts/{id}/edit','User\PostController@edit')->name('user.posts.edit');
  Route::post('/posts', 'User\PostController@store')->name('user.posts.store');
  Route::put('/posts/{id}', 'User\PostController@update')->name('user.posts.update');
  Route::delete('/posts/{id}', 'User\PostController@destroy')->name('user.posts.destroy');
  Route::post('/posts/tags', 'User\TagController@store')->name('user.tags.store');

  // Galleries details routes
  Route::get('/galleries', 'User\GalleryController@index')->name('user.galleries.index');
  Route::post('/galleries', 'User\GalleryController@store')->name('user.galleries.store');

  // Booking routes
  Route::get('bookings/consultation', 'User\BookingController@showConsultation')->name('user.bookings.consultation');
  Route::post('bookings/consultation/confirm/{id}', 'User\BookingController@confirmConsultation')->name('user.bookings.consultation.confirm');
  Route::post('bookings/consultation/cancel/{id}', 'User\BookingController@cancelConsultation')->name('user.bookings.consultation.cancel');
  Route::post('bookings/consultation/document/{id}', 'User\BookingController@sendConsultationDocument')->name('user.bookings.consultation.document');

  Route::get('bookings/service', 'User\BookingController@showService')->name('user.bookings.service');
  Route::post('bookings/service/confirm/{id}', 'User\BookingController@confirmService')->name('user.bookings.service.confirm');
  Route::post('bookings/service/cancel/{id}', 'User\BookingController@cancelService')->name('user.bookings.service.cancel');
  Route::post('bookings/service/document/{id}', 'User\BookingController@sendServiceDocument')->name('user.bookings.service.document');
  Route::post('bookings/service/dispute/{id}', 'User\BookingController@raiseDispute')->name('user.bookings.service.dispute');

  Route::post('bookings/reschedule/{id}', 'User\BookingController@reschedule')->name('user.bookings.reschedule');

  // Aks Us Routes
  Route::get('/ask_us/questions', 'User\Asks\QuestionController@questions')->name('user.asks.questions');
  Route::get('/ask_us/questions/{id}', 'User\Asks\QuestionController@show')->name('user.questions.show');
  Route::post('ask_us/questions', 'User\Asks\QuestionController@search')->name('user.questions.search');

  // Sending Email
  Route::get('/email', 'ClientController@email')->name('sendEmail');
  Route::get('/test-mail', 'ClientController@testMail');

  Route::get('/chat', 'User\ChatController@index');
});


// My Organization routes
// Route::get('/myOrg', 'Admin\OrganizationController@index')->name('myOrg.index');
// Route::post('/myOrg', 'Admin\OrganizationController@store')->name('myOrg.store');
// Route::post('/myOrg/add', 'Admin\OrganizationController@add')->name('myOrg.add');










/*
|--------------------------------------------------------------------------
| Web Routes for ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('auth')->group(function () {

  Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');

  // Profile Setting Controller
  Route::get('profile-settings', 'Admin\ProfileSettingController@getSettings')->name('admin.profile.settings.get');
  Route::post('profile-settings', 'Admin\ProfileSettingController@updateSettings')->name('admin.profile.settings.update');
  Route::post('/profile-picture', 'Admin\ProfileSettingController@uploadPhoto')->name('admin.profile.photo.upload');

  // Adviser BasicDetail routes
  Route::get('/profile', 'Admin\ProfileController@index')->name('admin.profile.index');
  Route::post('/profile', 'Admin\ProfileController@store')->name('admin.profile.store');
  Route::put('/profile/{id}','Admin\ProfileController@update')->name('admin.profile.update');

  // User Controller
  Route::get('/users', 'UserController@index')->name('users.index');
  Route::get('/users/create', 'UserController@create')->name('users.create');
  Route::post('/users', 'UserController@store')->name('users.store');
  Route::get('/users/{id}', 'UserController@show')->name('users.show');
  Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
  Route::put('/users/{id}', 'UserController@update')->name('users.update');

  // Categorie routes
  Route::resource('/categories', 'Admin\CategoryController', ['except' => ['create','show','edit']]);

  // Sub-Categorie routes
  Route::resource('/sub-categories', 'Admin\SubCategoryController', ['except' => ['create','show','edit']]);

  // Consultation routes
  Route::get('/consultations', 'Admin\ConsultationController@index')->name('consultations.index');
  Route::post('/consultations', 'Admin\ConsultationController@store')->name('consultations.store');

  Route::get('/manage', 'Admin\Manage\ManageController@index')->name('manage');
  Route::post('/manage', 'Admin\Manage\ManageController@search')->name('search');

  // manage Advisers
  Route::get('/manage/basicProfile/{id}', 'Admin\Manage\BasicProfileController@show')->name('basicProfile.show');
  Route::post('/manage/basicProfile', 'Admin\Manage\BasicProfileController@store')->name('basicProfile.store');
  Route::put('/manage/basicProfile/{id}', 'Admin\Manage\BasicProfileController@update')->name('basicProfile.update');

  // manage Expert Profile
  Route::get('manage/expertProfile/{id}', 'Admin\Manage\ExpertProfileController@show')->name('expertProfile.show');
  Route::post('manage/expertProfile', 'Admin\Manage\ExpertProfileController@store')->name('expertProfile.store');
  Route::put('manage/expertProfile/{id}', 'Admin\Manage\ExpertProfileController@update')->name('expertProfile.update');

  /*
  |--------------------------------------------------------------------------
  | Extra Routes for Expert Details
  |--------------------------------------------------------------------------
  */
  Route::post('/mange/expertProfile/education', 'Admin\Manage\EDC\EducationController@store')->name('manage.education.store');
  Route::put('/mange/expertProfile/education/{id}', 'Admin\Manage\EDC\EducationController@update')->name('manage.education.update');
  Route::delete('/mange/expertProfile/education/{id}', 'Admin\Manage\EDC\EducationController@destroy')->name('manage.education.destroy');

  Route::post('/mange/expertProfile/workexp', 'Admin\Manage\EDC\WorkExpController@store')->name('manage.workexp.store');
  Route::put('/mange/expertProfile/workexp/{id}', 'Admin\Manage\EDC\WorkExpController@update')->name('manage.workexp.update');
  Route::delete('/mange/expertProfile/workexp/{id}', 'Admin\Manage\EDC\WorkExpController@destroy')->name('manage.workexp.destroy');

  Route::post('/mange/expertProfile/specialization', 'Admin\Manage\EDC\SpecializationController@store')->name('manage.specialization.store');
  Route::put('/mange/expertProfile/specialization/{id}', 'Admin\Manage\EDC\SpecializationController@update')->name('manage.specialization.update');
  Route::delete('/mange/expertProfile/specialization/{id}', 'Admin\Manage\EDC\SpecializationController@destroy')->name('manage.specialization.destroy');

  Route::post('/mange/expertProfile/membership', 'Admin\Manage\EDC\MembershipController@store')->name('manage.membership.store');
  Route::put('/mange/expertProfile/membership/{id}', 'Admin\Manage\EDC\MembershipController@update')->name('manage.membership.update');
  Route::delete('/mange/expertProfile/membership/{id}', 'Admin\Manage\EDC\MembershipController@destroy')->name('manage.membership.destroy');

  Route::post('/mange/expertProfile/award', 'Admin\Manage\EDC\AwardController@store')->name('manage.award.store');
  Route::put('/mange/expertProfile/award/{id}', 'Admin\Manage\EDC\AwardController@update')->name('manage.award.update');
  Route::delete('/mange/expertProfile/award/{id}', 'Admin\Manage\EDC\AwardController@destroy')->name('manage.award.destroy');

  // manage Locations
  Route::get('/manage/address/{id}', 'Admin\Manage\AddressController@show')->name('address.show');
  Route::post('/manage/address', 'Admin\Manage\AddressController@store')->name('address.store');
  Route::put('/manage/address/{id}', 'Admin\Manage\AddressController@update')->name('address.update');
  Route::delete('/manage/address/{id}', 'Admin\Manage\AddressController@destroy')->name('address.destroy');

  // manage Bank Details
  Route::get('/manage/bank-detail/{id}', 'Admin\Manage\BankDetailController@show')->name('bank-detail.show');
  Route::post('/manage/bank-detail', 'Admin\Manage\BankDetailController@store')->name('bank-detail.store');
  Route::put('/manage/bank-detail/{id}', 'Admin\Manage\BankDetailController@update')->name('bank-detail.update');

  // Admin Services
  Route::get('/services', 'Admin\ServiceController@index')->name('admin.services.index');
  Route::get('/services/search', 'Admin\ServiceController@search')->name('admin.services.search');
  Route::get('/services/create', 'Admin\ServiceController@create')->name('admin.services.create');
  Route::post('/services', 'Admin\ServiceController@store')->name('admin.services.store');
  Route::get('/services/{id}', 'Admin\ServiceController@show')->name('admin.services.show');
  Route::get('/services/{id}/edit', 'Admin\ServiceController@edit')->name('admin.services.edit');
  Route::put('/services/{id}', 'Admin\ServiceController@update')->name('admin.services.update');
  Route::delete('/services/{id}', 'Admin\ServiceController@destroy')->name('admin.services.destroy');

  // Admin Offers
  Route::get('/offers', 'Admin\OfferController@index')->name('admin.offers.index');
  Route::get('/offers/create', 'Admin\OfferController@create')->name('admin.offers.create');
  Route::post('/offers', 'Admin\OfferController@store')->name('admin.offers.store');
  Route::get('/offers/{id}', 'Admin\OfferController@show')->name('admin.offers.show');
  Route::get('/offers/{id}/edit', 'Admin\OfferController@edit')->name('admin.offers.edit');
  Route::put('/offers/{id}', 'Admin\OfferController@update')->name('admin.offers.update');
  Route::delete('/offers/{id}', 'Admin\OfferController@destroy')->name('admin.offers.destroy');
  Route::post('offers/filter', 'Admin\OfferController@filter')->name('admin.offers.filter');

  // manage Availability
  Route::get('/manage/availability/{id}', 'Admin\Manage\AvailabilityController@show')->name('availability.show');
  Route::post('/manage/availability', 'Admin\Manage\AvailabilityController@store')->name('availability.store');
  Route::put('/manage/availability/{id}', 'Admin\Manage\AvailabilityController@update')->name('availability.update');
  Route::delete('/manage/availability/{id}', 'Admin\Manage\AvailabilityController@destroy')->name('availability.destroy');
  Route::post('/firstshift/store', 'Admin\Manage\FirstShiftController@store')->name('firstshift.store');
  Route::post('/firstshift/update', 'Admin\Manage\FirstShiftController@update')->name('firstshift.update');
  Route::delete('/firstshift/{id}', 'Admin\Manage\FirstShiftController@destroy')->name('firstshift.destroy');

  // manage Availability
  Route::get('/manage/un-availability/{id}', 'Admin\Manage\UnAvailabilityController@show')->name('un-availability.show');
  Route::post('/manage/un-availability', 'Admin\Manage\UnAvailabilityController@store')->name('un-availability.store');
  Route::put('/manage/un-availability/{id}', 'Admin\Manage\UnAvailabilityController@update')->name('un-availability.update');
  Route::delete('/manage/un-availability/{id}', 'Admin\Manage\UnAvailabilityController@destroy')->name('un-availability.destroy');

  // Invoice Controller
  Route::get('invoice/consultation', 'Admin\ConsultationInvoiceController@create')->name('invoice.consultation.create');
  Route::post('invoice/consultation', 'Admin\ConsultationInvoiceController@store')->name('invoice.consultation.store');
  Route::get('invoice', 'Admin\ConsultationInvoiceController@index')->name('invoice.consultation.index');

  // Qualification Routes
  Route::get('/qualifications', 'Admin\QualificationController@index')->name('qualifications.index');
  Route::post('/qualifications', 'Admin\QualificationController@store')->name('qualifications.store');
  Route::put('/qualifications/{id}', 'Admin\QualificationController@update')->name('qualifications.update');
  Route::delete('/qualifications/{id}', 'Admin\QualificationController@destroy')->name('qualifications.destroy');

  // Appointment Routes
  Route::get('/bookings', 'Admin\Booking\BookingController@index')->name('admin.bookings');
  Route::post('/bookings', 'Admin\Booking\BookingController@fetch')->name('admin.bookings.fetch');
  Route::post('/bookings/changeAdviser/{id}', 'Admin\Booking\BookingController@changeAdviser')->name('admin.bookings.changeAdviser');
  Route::post('/bookings/reschedule/{id}', 'Admin\Booking\BookingController@reschedule')->name('admin.bookings.reschedule');

  Route::get('/bookings/consultations', 'Admin\Booking\ConsultationController@index')->name('admin.consultations');
  Route::post('/bookings/consultations/confirm/{id}', 'Admin\Booking\ConsultationController@confirm')->name('admin.consultations.confirm');
  Route::post('/bookings/consultations/cancel/{id}', 'Admin\Booking\ConsultationController@cancel')->name('admin.consultations.cancel');
  Route::post('/bookings/consultations/document/{id}', 'Admin\Booking\ConsultationController@document')->name('admin.consultations.document');

  Route::get('/bookings/services', 'Admin\Booking\ServiceController@index')->name('admin.services');
  Route::post('/bookings/services/confirm/{id}', 'Admin\Booking\ServiceController@confirm')->name('admin.services.confirm');
  Route::post('/bookings/services/cancel/{id}', 'Admin\Booking\ServiceController@cancel')->name('admin.services.cancel');
  Route::post('/bookings/services/document/{id}', 'Admin\Booking\ServiceController@document')->name('admin.services.document');


  // Aks Us Routes
  Route::get('/ask_us/questions', 'Admin\Asks\QuestionController@questions')->name('admin.asks.questions');
  Route::get('/ask_us/questions/{id}', 'Admin\Asks\QuestionController@show')->name('admin.questions.show');
  Route::post('ask_us/questions', 'Admin\Asks\QuestionController@search')->name('admin.questions.search');
//Route::delete('ask_us/questions/{id}', 'Admin\Asks\QuestionController@destroy')->name('admin.questions.delete');
  Route::delete('ask_us/questions/reply/{id}', 'Admin\Asks\DeleteController@reply')->name('admin.questions.reply.delete');
  Route::delete('ask_us/questions/comment/{id}', 'Admin\Asks\DeleteController@comment')->name('admin.questions.comment.delete');
  Route::delete('ask_us/questions/answer/{id}', 'Admin\Asks\DeleteController@answer')->name('admin.questions.answer.delete');


    // Blog Post routes
  Route::get('/posts', 'Admin\PostController@index')->name('admin.posts.index');
  Route::get('/posts/create', 'Admin\PostController@create')->name('admin.posts.create');
  Route::get('posts/{id}','Admin\PostController@show')->name('admin.posts.show');
  Route::get('posts/{id}/edit','Admin\PostController@edit')->name('admin.posts.edit');
  Route::post('/posts', 'Admin\PostController@store')->name('admin.posts.store');
  Route::put('/posts/{id}', 'Admin\PostController@update')->name('admin.posts.update');
  Route::delete('/posts/{id}', 'Admin\PostController@destroy')->name('admin.posts.destroy');
  Route::post('posts/search', 'Admin\PostController@search')->name('admin.posts.search');
  Route::post('/posts/sort','Admin\PostController@sort')->name('admin.posts.sort');

});

Route::prefix('admin')->middleware('role:superadministrator')->group(function () {

  // Permission routes
  Route::get('/permissions', 'PermissionController@index')->name('permissions.index');
  Route::get('/permissions/create', 'PermissionController@create')->name('permissions.create');
  Route::post('/permissions', 'PermissionController@store')->name('permissions.store');
  Route::get('/permissions/{id}', 'PermissionController@show')->name('permissions.show');
  Route::get('/permissions/{id}/edit', 'PermissionController@edit')->name('permissions.edit');
  Route::put('/permissions/{id}', 'PermissionController@update')->name('permissions.update');

  // Role routes
  Route::get('/roles', 'RoleController@index')->name('roles.index');
  Route::get('/roles/create', 'RoleController@create')->name('roles.create');
  Route::post('/roles', 'RoleController@store')->name('roles.store');
  Route::get('/roles/{id}', 'RoleController@show')->name('roles.show');
  Route::get('/roles/{id}/edit', 'RoleController@edit')->name('roles.edit');
  Route::put('/roles/{id}', 'RoleController@update')->name('roles.update');

  Route::resource('/commissions', 'Admin\CommissionController');
  Route::post('commissions/create', 'Admin\CommissionController@sort')->name('commissions.sort');

});

/*
|--------------------------------------------------------------------------
| Extra Routes for service Benifits & Includes
|--------------------------------------------------------------------------
*/
 Route::post('/services/benifit', 'Adviser\ServiceBenifitController@storeBenifit')->name('benifit.store');
 Route::put('/services/benifit/{id}', 'Adviser\ServiceBenifitController@updateBenifit')->name('benifit.update');
 Route::delete('/services/benifit/{id}/delete', 'Adviser\ServiceBenifitController@destroyBenifit')->name('benifit.destroy');
 Route::post('/services/package', 'Adviser\ServiceBenifitController@storePackage')->name('package.store');
 Route::put('/services/package/{id}', 'Adviser\ServiceBenifitController@updatePackage')->name('package.update');
 Route::delete('/services/package/{id}/delete', 'Adviser\ServiceBenifitController@destroyPackage')->name('package.destroy');



Route::get('/advisers', 'Page\AdviserController@index')->name('advisers.index');
Route::post('/advisers', 'Page\AdviserController@cat')->name('advisers.cat');
Route::post('/advisers/like', 'Page\AuthorController@authorLike')->name('author.like');
Route::post('/advisers/follow', 'Page\AuthorController@authorFollow')->name('author.follow');

Route::get('/advisers-category/{slug}', 'Page\AdviserCategoryController@index')->name('advisers-category.index');
Route::post('/advisers-category', 'Page\AdviserCategoryController@search')->name('advisers-category.search');
Route::get('/advisers-subcategory/{name}', 'Page\AdviserCategoryController@subcategory')->name('advisers-subcategory.index');
Route::get('/author/{id}', 'Page\AuthorController@show')->name('author.show');
Route::post('/author/consultation', 'Page\BookingController@consultation')->name('booking.consultation');
Route::post('/author/service', 'Page\BookingController@service')->name('booking.service');
Route::post('/advisers-category/{slug}', 'Page\AdviserCategoryController@filter')->name('filter');

Route::get('/blog-posts', 'Page\PostController@index')->name('blog-posts.index');
Route::post('/blog-posts','Page\PostController@sort')->name('blog-posts.sort');
Route::get('/blog-posts/{id}', 'Page\PostController@show')->name('blog-posts.show');
Route::post('/like', 'Page\PostController@postLikePost')->name('like');

// Comments
Route::post('/comments/{post_id}', 'Page\CommentController@store')->name('comments.store');
Route::put('/comments/{id}', 'Page\CommentController@update')->name('comments.update');
Route::delete('/comments/{id}', 'Page\CommentController@destroy')->name('comments.destroy');
Route::post('/clike', 'Page\CommentController@postLikeComment')->name('clike');

// Replies
Route::post('/reply/{comment_id}', 'Page\ReplyController@store')->name('reply.store');
Route::put('/reply/{id}', 'Page\ReplyController@update')->name('reply.update');
Route::delete('/reply/{id}', 'Page\ReplyController@destroy')->name('reply.destroy');
Route::post('/rlike', 'Page\ReplyController@postLikeReply')->name('rlike');

// Text Message and Phone Call Routes
Route::get('/sendSms', 'PhoneCallController@sendSms');
Route::get('/customerPhoneCall', 'PhoneCallController@customerPhoneCall');
Route::get('/customerAgentPhoneCall', 'PhoneCallController@customerAgentPhoneCall');

// Get Route For Show Payment Form
Route::get('paywithrazorpay', 'RazorpayController@payWithRazorpay')->name('paywithrazorpay');
// Post Route For Makw Payment Request
Route::post('payment', 'RazorpayController@payment')->name('payment');

// Mail Routes
Route::get('/send', 'PhoneCallController@send');
Route::get('/sparkpost', function () {
  Mail::send('emails.test', [], function ($message) {
    $message
      ->from('jeete@adviceli.com', 'Adviceli')
      ->to('atr.moolchand@gmail.com', 'Receiver Name')
      ->subject('From SparkPost with ❤');
  });
});

//User rating
Route::post('/rating', 'Page\RatingController@store')->name('rating.store');
Route::put('/rating/{id}', 'Page\RatingController@update')->name('rating.update');

// Ask Us routes
Route::get('/ask-us', 'Page\AskUs\questionController@index')->name('asks.index');
Route::post('/ask-us', 'Page\AskUs\questionController@store')->name('asks.store');
Route::get('/ask-us/questions', 'Page\AskUs\questionController@questions')->name('asks.questions');
Route::get('/ask-us/questions/{id}', 'Page\AskUs\questionController@show')->name('asks.questions.show');
Route::post('/ask-us/questions', 'Page\AskUs\answerController@answer')->name('asks.answer');
Route::put('/ask-us/answer/{id}', 'Page\AskUs\answerController@update')->name('asks.answer.update');
Route::get('ask-us/search', 'Page\AskUs\questionController@search')->name('asks.questions.search');

Route::post('/answer/like', 'Page\AskUs\answerController@like')->name('answer.like');
Route::post('/answer/comment', 'Page\AskUs\AnswerCommentController@store')->name('answer.comment');
Route::post('/answer/reply', 'Page\AskUs\AnswerReplyController@store')->name('answer.reply');

Route::get('/about-us', 'Common\CommonController@about')->name('about');
Route::get('/faq', 'Common\CommonController@faq')->name('faq');
Route::get('/terms-of-site', 'Common\CommonController@terms')->name('terms-of-site');
Route::get('/how-it-works', 'Common\CommonController@howitworks')->name('howitworks');

Route::get('/chat', 'Page\ChatController@index');
Route::get('/messages/{userId}', 'Page\ChatController@fetchMessages')->name('fetchMessages');
Route::post('/messages/{userId}', 'Page\ChatController@sendMessage')->name('sendMessage');
Route::post('/fileUpload/{userId}', 'Page\ChatController@fileupload')->name('chat.fileupload');
Route::get('/users', 'Page\ChatController@users')->name('chat.users');
