<?php

use App\Http\Controllers\RegistrationController;
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

Route::get('/234', function () {
    return 44;
});

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@verify');

Route::get('/admin', 'AdminController@index');
Route::post('/admin', 'AdminController@verify');

// Route::apiResource('registration', RegistrationController::class);
// Route::apiResource('posts', 'PostsController');

Route::get('/home/create', 'HomeController@create');
Route::post('/home/create', 'HomeController@store');

Route::group(['middleware' => ['adminSess']], function () {

    Route::get('/admin/home', 'AdminController@adminhome');

    Route::apiResource('registration', 'RegistrationController');

    Route::apiResource('stories', 'StoriesController');
    
    Route::post('/stories/search', 'StoriesController@search');

    Route::delete('/posts/delete/{id}', 'PostsController@destroy');
});

Route::group(['middleware' => ['userSess']],function(){

    // Route::get('/admin/home', 'UserController@userhome');
    Route::get('/user/stories', 'UserController@index');

    Route::get('/user/stories/create', 'UserController@create');

	Route::post('/userstories', 'UserController@store');
});
