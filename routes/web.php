<?php

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

Route::get('/', function () {
    
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin/', 'middleware' => ['role:administrator']], function(){
    Route::get('dashboard', 'AdminController@dashboard')->name('adminDashboard');

    Route::get('manage/user/index', 'AdminController@userIndex')->name('userIndex');
    Route::get('manage/user/create', 'AdminController@userCreate')->name('userCreate');
    Route::post('manage/user/store', 'AdminController@userStore')->name('userStore');
    Route::get('manage/user/show/{id}', 'AdminController@userShow')->name('userShow');
    Route::get('manage/user/edit/{id}', 'AdminController@userEdit')->name('userEdit');
    Route::post('manage/user/update/{id}', 'AdminController@userUpdate')->name('userUpdate');

    Route::get('manage/permission/index', 'AdminController@permissionIndex')->name('permissionIndex');
    Route::get('manage/permission/create', 'AdminController@permissionCreate')->name('permissionCreate');
    Route::post('manage/permission/store', 'AdminController@permissionStore')->name('permissionStore');

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