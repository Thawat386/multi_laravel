<?php

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

// Route::prefix('blog')->group(function() {
//     Route::get('/', 'BlogController@index');
// });

Route::group(['prefix' => 'admin/', 'middleware' => ['role:administrator']], function(){

    Route::get('/', 'BlogController@index');

  //  Route::get('blog', '\Modules\Blog\Http\Controllers\BlogController@index');

 //   Route::get('app/Modules/blog', 'blogController');
});