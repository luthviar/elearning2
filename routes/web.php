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

Route::get('/home', function (){
    return redirect(action('HomeController@index'));
});

Route::get('/view-file/{id}', 'TrainingController@view_file');


Route::post('change_password', 'UserController@change_password');

Route::get('cobapdf','UserController@cobapdf');

Route::post('storepdf','UserController@storepdf');

Route::get('view-pdf','UserController@view_pdf');

/*
|--------------------------------------------------------------------------
| USER Routes
|--------------------------------------------------------------------------
|
| Bagian route tentang user
|
*/

Route::get('/profile', 'UserController@get_profile');

Route::get('/forgot_password', 'UserController@forgot_password');

Route::post('/forgot_password_submit', 'UserController@forgot_password_submit');

Route::get('/send-password/{id}', 'UserController@send_password');

Route::post('/change_photo','UserController@change_photo');

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

Route::get('request_access/{id_training}', 'TrainingController@request_access');

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

Route::get('/activate_news/{id}','NewsController@activate_news');

Route::get('/nonactivate_news/{id}','NewsController@nonactivate_news');

Route::get('/news-board','NewsController@index');

Route::get('/news/{id}','NewsController@get_news');

Route::post('/news/comment','NewsController@storeCommentByUser');

Route::get('/news/comment/delete/{id}','NewsController@comment_delete');

Route::get('news/edit/comment/{id}','NewsController@editCommentByUser');

Route::post('news/user/comment/update','NewsController@updateCommentByUser');

Route::get('news/user/edit/comment/attachment/{id}','NewsController@deleteAttachmentCommentByUser');


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

Route::get('slider/view-{id}','SliderController@view_slider_user');





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

Route::get('forum/user/edit/attachment/{id}','ForumController@deleteAttachmentByUser');

Route::get('forum/user/edit/comment/{id}','ForumController@editCommentByUser');

Route::get('forum/user/edit/comment/attachment/{id}','ForumController@deleteAttachmentCommentByUser');

Route::post('forum/user/comment/update','ForumController@updateCommentByUser');

Route::post('forum/user/update','ForumController@updateByUser');

Route::post('forum/comment','ForumController@storeCommentByUser');

Route::get('forum/comment/delete/{id}','ForumController@comment_delete');

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


Route::get('/admin', function(){
    return redirect(action('UserController@personnel_list'));
});

Route::prefix('admin')->group(function () {

    // ----------------------------------
    // ADMIN PERSONNEL
    // -----------------------------------
    Route::get('personnel', function(){
        return redirect(action('UserController@personnel_list'));
    });

    Route::prefix('personnel')->group(function () {

        Route::get('all', 'UserController@personnel_list');

        Route::post('/personnel/serverside', 'UserController@personnel_list_serverside');

	    Route::get('edit-{id}','UserController@edit_personnel');

	    Route::post('edit','UserController@edit_personnel_submit');

	    Route::get('/personnel/activate/{id}','UserController@activate');

	    Route::get('/personnel/nonactivate/{id}','UserController@nonactivate');

	    Route::post('/personnel/add_score','UserController@add_score');

	    Route::get('record-{id_personnel}-training-{id_training}','UserController@see_record');

        Route::get('view-{id}', 'UserController@profile_view');

        Route::get('delete-score-{id}', 'UserController@delete_score');

        // -------------------------------------
        // ADMIN USER
        // -------------------------------------

        Route::get('add', 'UserController@user_add');

        Route::post('user_add_submit','UserController@user_add_submit');

    });

    // ----------------------------------
    // ADMIN NEWS
    // -----------------------------------
    Route::get('/news', function(){
        return redirect(action('NewsController@news_list'));
    });

    Route::prefix('news')->group(function () {

        Route::get('add','NewsController@news_add');

        Route::get('all','NewsController@news_list');

        Route::post('admin_news','NewsController@news_list_serverside');

        Route::get('view-{id}','NewsController@admin_news_view');

        Route::post('news_add_submit', 'NewsController@news_add_submit');

        Route::get('edit-{id}', 'NewsController@news_edit');

        Route::post('news_edit_submit', 'NewsController@news_edit_submit');

        Route::get('news_remove/{id}', 'NewsController@news_remove');

        Route::get('news_publish/{id}', 'NewsController@publish_news');

        Route::get('news_unpublish/{id}', 'NewsController@unpublish_news');
    });


    // -------------------------------------
    // ADMIN SLIDER
    // -------------------------------------
    Route::get('/slider', function(){
        return redirect(action('SliderController@slider_list'));
    });

    Route::prefix('slider')->group(function () {

        Route::get('all','SliderController@slider_list');

        Route::post('admin_slider','SliderController@slider_list_serverside');

        Route::get('add', 'SliderController@add_slider');

        Route::post('/slider_add_submit', 'SliderController@slider_add_submit');

        Route::get('view-{id}', 'SliderController@view_slider');

        Route::get('edit-{id}', 'SliderController@edit_slider');

        Route::post('slider_edit_submit', 'SliderController@edit_slider_submit');

        Route::get('slider_activate/{id}', 'SliderController@activate');

        Route::get('slider_nonactivate/{id}', 'SliderController@nonactivate');

        Route::get('slider_remove/{id}', 'SliderController@delete_slider');
    });


    // -------------------------------------
    // ADMIN FORUM
    // -------------------------------------
    Route::get('forum', function(){
        return redirect(action('ForumController@forum_public_list'));
    });

    Route::prefix('forum')->group(function () {

        Route::get('umum-all','ForumController@forum_public_list');

        Route::post('admin_forum_public','ForumController@forum_public_list_serverside');

        Route::get('unit-all','ForumController@forum_unit_list');

        Route::post('admin_forum_unit','ForumController@forum_unit_list_serverside');

        Route::get('job-family-all','ForumController@forum_job_family_list');

        Route::post('admin_forum_job_family','ForumController@forum_job_family_list_serverside');

        Route::get('view-{id_forum}','ForumController@forum_admin_view');

        Route::get('delete/{id_forum}','ForumController@forum_remove');

    });

    // -------------------------------------
    // ADMIN TRAINING
    // -------------------------------------

    Route::get('training', function(){
        return redirect(action('TrainingController@admin_training'));
    });

    Route::prefix('training')->group(function () {

        Route::get('delete-{id}','TrainingController@delete_training');

        Route::get('add_training', 'TrainingController@add_training');

        Route::get('manage-{id}', 'TrainingController@manage_training');

        Route::get('add_chapter', 'TrainingController@add_chapter');

        Route::get('all', 'TrainingController@admin_training');

        Route::post('admin_training', 'TrainingController@admin_training_serverside');

        Route::get('add','TrainingController@add_training');

        Route::post('add-training','TrainingController@add_training_submit');

        Route::get('add-chapter-{id_module}','TrainingController@add_chapter');

        Route::get('chapter-{id_chapter}','TrainingController@manage_chapter');

        Route::post('add_chapter_submit','TrainingController@add_chapter_submit');

        Route::post('add_question_submit','TrainingController@add_question_submit');

        Route::get('select-answer-{id_question}','TrainingController@select_answer');

        Route::post('select_answer_submit','TrainingController@select_answer_submit');

        Route::get('remove-question-{id}', 'TrainingController@remove_question' );

        Route::get('edit-question-{id}','TrainingController@edit_question');

        Route::post('edit_question_submit','TrainingController@edit_question_submit');

        Route::get('edit-chapter-{id}', 'TrainingController@edit_chapter');

        Route::post('edit_chapter_submit', 'TrainingController@edit_chapter_submit');

        Route::get('remove-chapter-{id}', 'TrainingController@remove_chapter');

        Route::post('material_add', 'TrainingController@material_add');

        Route::get('remove-material-file-{id}', 'TrainingController@remove_material_file');

        Route::get('edit-training-{id}','TrainingController@edit_training');

        Route::post('edit_training_submit','TrainingController@edit_training_submit');

        Route::get('training-publish-{id}', 'TrainingController@publish_training');

        Route::get('training-unpublish-{id}', 'TrainingController@unpublish_training');

        Route::get('participant-{id_training}','TrainingController@add_participant');

        Route::post('add_participant','TrainingController@add_participant_submit');

        Route::get('schedule','TrainingController@schedule');

        Route::post('schedule','TrainingController@schedule_serverside');

        Route::get('see_participant/{id}', 'TrainingController@see_participant');

        Route::get('see-participants-{id}', 'TrainingController@see_participant');

        Route::get('reorder_chapter-{id}','TrainingController@change_order');

        Route::post('reorder_chapter_submit', 'TrainingController@change_order_submit');

    });


    // -------------------------------------
    // ADMIN LINKS OF AEROFOOD SYSTEM
    // -------------------------------------
    Route::get('links', function(){
        return redirect(action('AerofoodLinksController@index'));
    });

    Route::prefix('links')->group(function () {

        Route::get('all', 'AerofoodLinksController@index');

        Route::get('view-{id}', 'AerofoodLinksController@view');

        Route::get('edit-{id}', 'AerofoodLinksController@edit');

        Route::post('update', 'AerofoodLinksController@update');

        Route::get('remove-{id}', 'AerofoodLinksController@remove');

        Route::post('create', 'AerofoodLinksController@create');

        Route::get('add', 'AerofoodLinksController@add');
    });


    // -------------------------------------
    // ADMIN REQUEST ACCESS
    // -------------------------------------
    Route::get('request', function(){
        return redirect(action('TrainingController@admin_access_training'));
    });

    Route::prefix('request')->group(function () {

        // -------------------------------------
        // ADMIN TRAINING REQUEST
        // -------------------------------------
        Route::get('training', function(){
            return redirect(action('TrainingController@admin_access_training'));
        });
        Route::prefix('training')->group(function () {

            Route::get('access', 'TrainingController@admin_access_training');

            Route::post('admin_access_training','TrainingController@admin_access_training_serverside');

            Route::get('give_access/{id_access}', 'TrainingController@give_access');

            Route::get('cancel_access/{id_access}','TrainingController@cancel_access');

        });


        // ----------------------------------
        // ADMIN SYSTEM REQUEST ACCESS, IF SOMEONE NEED TO REQUEST FORGET PASSWORD
        // ----------------------------------
        Route::get('system', function(){
            return redirect(action('UserController@system_access'));
        });
        Route::prefix('system')->group(function () {

            Route::get('access','UserController@system_access');

            Route::post('server','UserController@system_access_serverside');

        });

    });


});
    // -------------------------------------
    // ADMIN ORG. STRUCTURE
    // -------------------------------------


Route::post('get_unit','OrganizationStructureController@get_unit');

Route::post('get_department','OrganizationStructureController@get_department');

Route::post('get_section','OrganizationStructureController@get_section');

