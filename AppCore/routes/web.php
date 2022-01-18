<?php
use App\Http\Controllers\Admin\agencyController;
use App\Http\Controllers\Admin\Auth\LoginAgencyController;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => '/'], function(){

	// Dashboard
	Route::get('/', 'Admin\DashboardController@index')->name('admin.index');
	
});



Route::group(['prefix' => 'admin_'], function(){
		Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
		Route::get('/create', 'Admin\agencyController@index')->name('admin.agencyCreate');
		Route::get('/getCountries', 'Admin\agencyController@getCountries')->name('admin.getCountries');
		Route::get('/getStates/{code}', 'Admin\agencyController@getStates')->name('admin.getStates');
		Route::post('/agencyStore', 'Admin\agencyController@store');
		Route::post('/business', 'Admin\LoginAgencyController@login')->name('admin.business.login');
		Route::get('/business', 'Admin\LoginAgencyController@showLoginFormAdmin')->name('admin.business.login');
		// Auth
		Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin.login');
		Route::get('/register', 'Admin\Auth\RegisterController@create')->name('admin.register');
		Route::get('/login', 'Admin\Auth\LoginController@showLoginFormAdmin')->name('admin.login');
		

			Route::group(['prefix' => 'users'], function(){
				Route::get('/profile', 'Admin\DashboardController@showProfile')->name('users.showProfile');
				Route::get('/getProfile', 'Admin\DashboardController@getProfile')->name('users.getProfile');
				Route::post('/updateProfile', 'Admin\DashboardController@updateProfile')->name('users.updateProfile');

				Route::get('/getAllRoles', 'Admin\UserController@getAllRoles');
				Route::get('/getAllWithPagination', 'Admin\UserController@getAllWithPagination');
				Route::post('/update/{id}', 'Admin\UserController@updateUser');
				Route::delete('/{id}', 'Admin\UserController@destroy');
				Route::resource('/', 'Admin\UserController');
			});

		Route::get('/shifts', 'Admin\ShiftsController@index')->name('shifts.index');
		Route::get('/shifts/getAllActivated', 'Admin\ShiftsController@getAllActivated');
		Route::get('/shifts/getAllWithPagination', 'Admin\ShiftsController@getAllWithPagination');
		Route::post('/shifts', 'Admin\ShiftsController@store');
		Route::put('/shifts/{id}', 'Admin\ShiftsController@update');
		Route::delete('/shifts/{id}', 'Admin\ShiftsController@destroy');
		Route::get('/clients/getAllActivated', 'Admin\ClientsController@getAllActivated');
		Route::get('/clients/getAll', 'Admin\ClientsController@getAll');
		Route::get('/clients/getAllClients', 'Admin\ClientsController@getAllClients');	
		Route::get('/clients/getAllWithPagination', 'Admin\ClientsController@getAllWithPagination');
		Route::get('/clients/getEmpty', 'Admin\ClientsController@getEmpty');
		Route::get('/clients/getNotEmptyClients', 'Admin\ClientsController@getNotEmptyClients');
		Route::get('/clients/getAvailableClientsByDate', 'Admin\ClientsController@getAvailableClientsByDate');
		Route::resource('/clients', 'Admin\ClientsController');

		Route::get('/watchmen/getAllWithPagination', 'Admin\WatchmenController@getAllWithPagination');
		Route::get('/watchmen/getAllActivated', 'Admin\WatchmenController@getAllActivated');
		Route::get('/watchmen/getAllFree', 'Admin\WatchmenController@getAllFree');
		Route::get('/watchmen/getAll', 'Admin\WatchmenController@getAll');
		Route::resource('/watchmen', 'Admin\WatchmenController');

		Route::post('/assignment', 'Admin\AssignmentController@store')->name('admin.assignment.store');
		Route::put('/assignment/{id}', 'Admin\AssignmentController@update')->name('admin.assignment.update');
		Route::delete('/assignment/{id}', 'Admin\AssignmentController@destroy')->name('admin.assignment.destroy');
		Route::get('/assignment', 'Admin\AssignmentController@assignment')->name('admin.assignment');
		Route::get('/assignment/form', 'Admin\AssignmentController@assignment_form')->name('admin.assignment.create');
		Route::get('/assignment/getAllWithPagination', 'Admin\AssignmentController@getAllWithPagination');
		Route::get('/assignment/{id_assignment}/getListWatchmenByClient/{id_client}', 'Admin\AssignmentController@getListWatchmenByClient');

		Route::get('/news/getAllWithPagination', 'Admin\NewsController@getAllWithPagination');
		Route::get('/news/reports', 'Admin\NewsController@reports')->name('news.reports');
		Route::get('/news/getReport', 'Admin\NewsController@getReport');
		Route::get('/news/printReport', 'Admin\NewsController@printReport');
		Route::get('/shift-change', 'Admin\NewsController@shiftChange')->name('news.shift-change');
		Route::get('/news/getAllWithPaginationByType', 'Admin\NewsController@getAllWithPaginationByType');
		Route::get('/news/reportsByType/{type}', 'Admin\NewsController@reportsByType')->name('news.reportsByType');

		Route::resource('/news', 'Admin\NewsController');

		Route::get('/resignations-and-dismissals/getAllWithPagination', 'Admin\ResignationsAndDismissalsController@getAllWithPagination');
		Route::get('/resignations-and-dismissals/reports', 'Admin\ResignationsAndDismissalsController@reports')->name('resignations-and-dismissals.reports');
		Route::get('/resignations-and-dismissals/getReport', 'Admin\ResignationsAndDismissalsController@getReport');
		Route::get('/resignations-and-dismissals/printReport', 'Admin\ResignationsAndDismissalsController@printReport');
		Route::resource('/resignations-and-dismissals', 'Admin\ResignationsAndDismissalsController');

		Route::get('/transfer', 'Admin\OperationsController@transfer')->name('operations.transfer');
		Route::get('/operations/get-by-type/{type}', 'Admin\OperationsController@getAllWithPaginationByType');
		Route::post('/save-operation', 'Admin\OperationsController@save');
		Route::delete('/operations/delete/{id}', 'Admin\OperationsController@destroy');
		Route::get('/operations/reports/{type}', 'Admin\OperationsController@reportsByType')->name('operations.reportsByType');
		Route::get('/operations/getReport', 'Admin\OperationsController@getReport');
		Route::get('/operations/printReport', 'Admin\OperationsController@printReport');
});

Auth::routes();

Route::get('/home', 'Admin\DashboardController@index')->name('home');
