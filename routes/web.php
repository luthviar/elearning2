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

Route::get('/', 'HomeController@index');

Route::get('/test', 'HomeController@test');


/*
|--------------------------------------------------------------------------
| Training Routes
|--------------------------------------------------------------------------
|
| Bagian route tentang training
|
*/
Route::get('/get_module_training','TrainingController@get_module_training');

Route::get('/get_training/{id}','TrainingController@get_trainings');

/*
|--------------------------------------------------------------------------
| News Routes
|--------------------------------------------------------------------------
|
| Bagian route tentang news
|
*/

Route::get('/get_all_news','NewsController@get_all_news');

Route::get('/get_active_news', 'NewsController@get_active_news');

Route::get('/get_news/{id}' , 'NewsController@get_news');

Route::get('/activate_news/{id}','NewsController@activate_news');

Route::get('/nonactivate_news/{id}','NewsController@nonactivate_news');

/*
|--------------------------------------------------------------------------
| Slider Routes
|--------------------------------------------------------------------------
|
| Bagian route tentang slider
|
*/

Route::get('/get_all_slider','SliderController@get_all_slider');

Route::get('/get_active_slider','SliderController@get_active_slider');

Route::get('/activate_slider/{id}','SliderController@activate_slider');

Route::get('/nonactivate_slider/{id}','SliderController@nonactivate_slider');

/*
|--------------------------------------------------------------------------
| Forum Routes
|--------------------------------------------------------------------------
|
| Bagian route tentang forum
|
*/

Route::get('/get_all_forum','ForumController@get_all_forum');

Route::get('/get_forum/{forum_type}', 'ForumController@get_user_forum');

Route::get('/get_forum/{id}','ForumController@get_forum');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
