<?php

use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;

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

    //return Activity::all();
    return view('welcome');
});

Auth::routes(['verify' => true]);
  
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin/', 'middleware' => ['role:administrator']], function(){
    Route::get('dashboard', 'AdminController@dashboard')->name('adminDashboard');

    Route::get('manage/user/index', 'AdminController@userIndex')->name('userIndex');
    Route::get('manage/user/create', 'AdminController@userCreate')->name('userCreate');
    Route::post('manage/user/store', 'AdminController@userStore')->name('userStore');
    Route::get('manage/user/show/{id}', 'AdminController@userShow')->name('userShow');
    Route::get('manage/user/edit/{id}', 'AdminController@userEdit')->name('userEdit');
    Route::post('manage/user/update/{id}', 'AdminController@userUpdate')->name('userUpdate');
    Route::get('manage/user/destroy/{id}', 'AdminController@userDestroy')->name('userDestroy');
    Route::get('manage/user/killdestroy/{id}', 'AdminController@userkillDestroy')->name('userkillDestroy');

    Route::get('manage/permission/index', 'AdminController@permissionIndex')->name('permissionIndex');
    Route::get('manage/permission/create', 'AdminController@permissionCreate')->name('permissionCreate');
    Route::post('manage/permission/store', 'AdminController@permissionStore')->name('permissionStore');
    Route::get('manage/permission/show/{id}', 'AdminController@permissionShow')->name('permissionShow');
    Route::get('manage/permission/edit/{id}', 'AdminController@permissionEdit')->name('permissionEdit');
    Route::post('manage/permission/update/{id}', 'AdminController@permissionUpdate')->name('permissionUpdate');


    Route::get('manager/role/index', 'AdminController@roleIndex')->name('roleIndex');
    Route::get('manage/role/create', 'AdminController@roleCreate')->name('roleCreate');
    Route::post('manage/role/store', 'AdminController@roleStore')->name('roleStore');
    Route::get('manage/role/show/{id}', 'AdminController@roleShow')->name('roleShow');
    Route::get('manage/role/edit/{id}', 'AdminController@roleEdit')->name('roleEdit');
    Route::post('manage/role/update/{id}', 'AdminController@roleUpdate')->name('roleUpdate');

    Route::get('blog', '\Modules\Blog\Http\Controllers\BlogController@index')->name('index');

 //   Route::get('app/Modules/blog', 'blogController');
   

});

// Route::group(['prefix' => '/', 'middleware' => ['role:administrator']], function(){

//     Route::get('blog', '\Modules\Blog\Http\Controllers\BlogController@index');

//  //   Route::get('app/Modules/blog', 'blogController');
   

// });

Route::group(['prefix' => 'director/', 'middleware' => ['role:director']], function(){
    Route::get('dashboard', 'DirectorController@dashboard')->name('directorDashboard');
});

Route::group(['prefix' => 'user/', 'middleware' => ['role:employee']], function(){
    Route::get('dashboard', 'UserController@dashboard')->name('userDashboard');
});