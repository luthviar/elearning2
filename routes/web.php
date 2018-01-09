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
*/

Route::prefix('admin')->group(function () {

    Route::get('/admin', function(){
        return view('admin.layout_admin	');
    });

    /*
    |
    | Bagian route tentang personnel
    |
    */

    Route::get('users', function () {
        // Matches The "/admin/users" URL
    });

    Route::get('/personnel', 'UserController@personnel_list');

    Route::post('/personnel', 'UserController@personnel_list_serverside');

    Route::get('/personnel/add', 'UserController@personnel_add');

    Route::get('/personnel/{id}', 'UserController@profile_view');

    Route::get('/personnel/edit/{id}','UserController@edit_personnel');

    Route::post('personnel/edit','UserController@edit_personnel_submit');

    Route::get('/personnel/activate/{id}','UserController@activate');

    Route::get('/personnel/nonactivate/{id}','UserController@nonactivate');

    Route::post('/personnel/add_score','UserController@add_score');

    Route::get('/personnel/{id_personnel}/training/{id_training}','UserController@see_record');

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

    Route::post('news_add_submit', 'NewsController@news_add_submit');

    Route::get('news_edit/{id}', 'NewsController@news_edit');

    Route::post('news_edit_submit', 'NewsController@news_edit_submit');

    Route::get('news_remove/{id}', 'NewsController@news_remove');

    Route::get('news_publish/{id}', 'NewsController@publish_news');

    Route::get('news_unpublish/{id}', 'NewsController@unpublish_news');

    // -------------------------------------
    // SLIDER
    // -------------------------------------

    Route::get('admin_slider','SliderController@slider_list');

    Route::post('admin_slider','SliderController@slider_list_serverside');

    Route::get('/add_slider', 'SliderController@add_slider');

    Route::post('/slider_add_submit', 'SliderController@slider_add_submit');

    Route::get('admin_slider/{id}', 'SliderController@view_slider');

    Route::get('slider_edit/{id}', 'SliderController@edit_slider');

    Route::post('slider_edit_submit', 'SliderController@edit_slider_submit');

    Route::get('slider_activate/{id}', 'SliderController@activate');

    Route::get('slider_nonactivate/{id}', 'SliderController@nonactivate');

    Route::get('slider_remove/{id}', 'SliderController@delete_slider');

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

    Route::get('admin_training', 'TrainingController@admin_training');

    Route::post('admin_training', 'TrainingController@admin_training_serverside');

    Route::get('add_training','TrainingController@add_training');

    Route::post('add_training','TrainingController@add_training_submit');

    Route::get('add_chapter/{id_module}','TrainingController@add_chapter');

    Route::get('manage_chapter/{id_chapter}','TrainingController@manage_chapter');

    Route::post('add_chapter_submit','TrainingController@add_chapter_submit');

    Route::post('add_question_submit','TrainingController@add_question_submit');

    Route::get('select_answer/{id_question}','TrainingController@select_answer');

    Route::post('select_answer_submit','TrainingController@select_answer_submit');

    Route::get('remove_question/{id}', 'TrainingController@remove_question' );

    Route::get('edit_question/{id}','TrainingController@edit_question');

    Route::post('edit_question_submit','TrainingController@edit_question_submit');

    Route::get('edit_chapter/{id}', 'TrainingController@edit_chapter');

    Route::post('edit_chapter_submit', 'TrainingController@edit_chapter_submit');

    Route::get('remove_chapter/{id}', 'TrainingController@remove_chapter');

    Route::post('material_add', 'TrainingController@material_add');

    Route::get('remove_material_file/{id}', 'TrainingController@remove_material_file');

    Route::get('edit_training/{id}','TrainingController@edit_training');

    Route::post('edit_training_submit','TrainingController@edit_training_submit');


    // -------------------------------------
    // ORG. STRUCTURE
    // -------------------------------------


Route::post('get_unit','OrganizationStructureController@get_unit');

Route::post('get_department','OrganizationStructureController@get_department');

Route::post('get_section','OrganizationStructureController@get_section');

// -------------------------------------
// USER
// -------------------------------------

Route::get('user_add','UserController@user_add');

Route::post('user_add','UserController@user_add_submit');

