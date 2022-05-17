<?php

use App\Console\Commands\DeleteFilesCron;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MeterDashboardController;
use App\Http\Controllers\Admin\{
    SettingController,
    OrganizationController,
    UserController,
    DeviceController,
    DeviceMapController,
    NotificationController,
    AlertConfigurationController,
};

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

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('login', [LoginController::class,  'index']); 

Route::post('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout'); 
Route::get('/register', [LoginController::class, 'register'])->name('register'); 
Route::post('/register', [LoginController::class, 'register'])->name('register'); 


$adminPrefix = "admin";
Route::group(['prefix' => $adminPrefix, 'middleware' => ['admin']], function () {
    Route::get('reboot-server', [SettingController::class, 'rebootServer'])->name('reboot-server');

    Route::resource('users', UserController::class);
    Route::get('admin-dashboard', [AdminController::class,  'index'])->name('admin_dashboard');
    Route::get('dashboard', [DashboardController::class,  'index'])->name('dashboard');
    Route::post('/admin-dashboard', [AdminController::class, 'index']);
    Route::get('/admin-profile', [SettingController::class, 'profile'])->name('profile');
    Route::post('/admin-profile', [SettingController::class, 'profile'])->name('profile');
    Route::get('/admin-change-password', [SettingController::class, 'profile'])->name('change_password');
    Route::post('/admin-change-password', [SettingController::class, 'changepwd'])->name('change_password');
    Route::post('/admin-setting', [SettingController::class, 'setting'])->name('setting');
    Route::get('/admin-setting', [SettingController::class, 'setting'])->name('setting');
    Route::get('/device/device-detail/{id}', [DeviceController::class, 'deviceDetail'])->name('device-detail');
    Route::post('/updateName', [DeviceController::class, 'updateName'])->name('updateName');
    Route::post('uploadFile', [DeviceController::class, 'uploadFile'])->name('uploadFile');
    Route::post('connectServer', [DeviceController::class, 'connectServer'])->name('connectServer');
    Route::resource('device', DeviceController::class);
    Route::resource('device-map', DeviceMapController::class);
    Route::get('/users/list', [UserController::class, 'index'])->name('user_list');
    Route::post('/device/ajaxAction', [DeviceController::class, 'ajaxAction'])->name('ajaxAction');
    Route::post('/dashboard/ajaxAction', [DashboardController::class, 'ajaxAction'])->name('ajaxAction');
    Route::get('/meter-dashboard', [MeterDashboardController::class, 'index'])->name('meter_dashboard');
    Route::post('meter-dashboard-export', [MeterDashboardController::class, 'meterDashboardExport'])->name('meter-dashboard-export');

    Route::post('/dashboard-meter/ajaxAction', [MeterDashboardController::class, 'ajaxAction'])->name('ajaxAction');
    Route::resource('organization', OrganizationController::class);

    Route::resource('notification', NotificationController::class);
    Route::resource('alert-configration', AlertConfigurationController::class);
    Route::post('/notification/ajaxAction', [NotificationController::class, 'ajaxAction'])->name('ajaxAction');

    // Route::match(['get', 'post'], 'device/ajaxAction', ['as' => 'ajaxAction', 'uses' => 'CommonFormController@ajaxAction']);

});

Route::group(['prefix' => 'admin',  'middleware' => ['admin']], function (\Illuminate\Routing\Router $route) {
//     $route->get('/users/list', [UserController::class, 'index'])->name('user_list');
//     $route->get('/users/change-status/{id}', 'Admin\UserController@statusChange')->name('user_change_status');
//     $route->match(['get', 'post'], '/user/add', 'Admin\UserController@create')
//         ->name('user_create');
    $route->match(['get', 'post'], '/user/edit/{id}', 'Admin\UserController@edit')
        ->name('user_edit')->where('id', '[0-9]+');
//     $route->match(['get', 'post'], '/user/show/{id}', 'Admin\UserController@show')
//         ->name('user_view')->where('id', '[0-9]+');
//     $route->match(['DELETE', 'post'], '/user/delete/{id}', 'Admin\UserController@destroy')
//         ->name('user_delete')->where('id', '[0-9]+');
});





