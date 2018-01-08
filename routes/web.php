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

Route::get('/', 'HomeController@index')->name('home');

//Route::get('/test', 'HomeController@test');


Route::post('change_password', 'UserController@change_password');

/*
|--------------------------------------------------------------------------
| USER Routes
|--------------------------------------------------------------------------
|
| Bagian route tentang user
|
*/

Route::get('/profile', 'UserController@get_profile');

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

Route::get('/material/{id}', 'TrainingController@get_material');

Route::get('/file', function(){
	return view('material_file');
});

Route::get('/finish_chapter/{id_chapter}','TrainingController@finish_chapter');

Route::get('/test/{id_chapter}','TrainingController@get_test');

Route::post('/test_submit', 'TrainingController@submit_test');

Route::get('/review_test/{id_chapter}','TrainingController@review_test');

Route::get('/get_chapter/{id}', 'TrainingController@next_chapter');

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

//Route::get('/get_news/{id}' , 'NewsController@get_news');

Route::get('/activate_news/{id}','NewsController@activate_news');

Route::get('/nonactivate_news/{id}','NewsController@nonactivate_news');

Route::get('/news-board','NewsController@index');

Route::get('/news/{id}','NewsController@get_news');

//Route::get('/comm/{id}','NewsController@get_news');

Route::post('/news/comment','NewsController@storeCommentByUser');

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

Route::get('/forum/{id}','ForumController@get_forum');

Route::post('/forum_public', 'ForumController@forum_public');

Route::get('forum','ForumController@index');

Route::post('forum/store','ForumController@storeByUser');

Route::get('forum/user/edit/{id}','ForumController@editByUser');

Route::post('forum/user/update','ForumController@updateByUser');

Route::post('forum/comment','ForumController@storeCommentByUser');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Front End by Luthfi

Route::get('/home2', 'HomeController@index2')->name('home2');

//End of Front End by Luthfi


/*
|--------------------------------------------------------------------------
| ADMIN AREA Routes
|--------------------------------------------------------------------------
|
| Bagian route tentang news
|
*/

Route::get('/admin', function(){
	return view('admin.layout_admin	');
});

Route::get('/personnel', 'UserController@personnel_list');

Route::post('/personnel', 'UserController@personnel_list_serverside');

Route::get('/personnel/{id}', 'UserController@profile_view');

Route::get('/personnel_add', function(){
	return view('admin.personnel_add');
});


// ----------------------------------
// NEWS
// -----------------------------------

Route::get('/news_add', function(){
	return view('admin.news_add');
});

Route::get('admin_news','NewsController@news_list');

Route::post('admin_news','NewsController@news_list_serverside');

Route::get('admin_news/{id}','NewsController@admin_news_view');

// -------------------------------------
// SLIDER
// -------------------------------------

Route::get('admin_slider','SliderController@slider_list');

Route::post('admin_slider','SliderController@slider_list_serverside');

// -------------------------------------
// FORUM
// -------------------------------------

Route::get('admin_forum_public','ForumController@forum_public_list');

Route::post('admin_forum_public','ForumController@forum_public_list_serverside');

Route::get('admin_forum_department','ForumController@forum_department_list');

Route::post('admin_forum_department','ForumController@forum_department_list_serverside');

Route::get('admin_forum_job_family','ForumController@forum_job_family_list');

Route::post('admin_forum_job_family','ForumController@forum_job_family_list_serverside');

Route::get('admin_forum/{id_forum}','ForumController@forum_admin_view');

// -------------------------------------
// TRAINING
// -------------------------------------

Route::get('add_training', function(){
	return view('admin.training_add');
});

Route::get('manage_training/{id}', 'TrainingController@manage_training');

Route::get('add_chapter', function(){
	return view('admin.training_add_chapter');
});

Route::get('add_training','TrainingController@add_training');

Route::post('add_training','TrainingController@add_training_submit');

Route::get('add_chapter/{id_module}','TrainingController@add_chapter');

Route::get('manage_chapter/{id_chapter}','TrainingController@manage_chapter');

Route::post('add_chapter_submit','TrainingController@add_chapter_submit');

Route::post('add_question_submit','TrainingController@add_question_submit');