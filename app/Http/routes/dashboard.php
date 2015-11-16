<?php
//DashBoard Routes
Route::group(['middleware' => ['auth', 'SetGlobalAuthVariables'],'namespace'=>'Dashboard', 'prefix'=>'dashboard'], function () {
    Route::get('/',['as'=>'dashboard.index','uses'=>'DashController@index']);

    /*
	 * News and Events Routes
	 * */
    Route::get('news', ['as'=>'news.index','uses'=>'NewsController@index']);
    Route::get('news/new', ['as'=>'news.add','uses'=>'NewsController@add']);
    Route::post('news/new', ['as'=>'news.post_add','uses'=>'NewsController@post_add']);

    Route::get('news/delete/{id}', ['as'=>'news.delete','uses'=>'NewsController@delete']);

    Route::get('news/edit/{id}', ['as'=>'news.edit','uses'=>'NewsController@edit']);
    Route::post('news/edit/{id}', ['as'=>'news.post_edit','uses'=>'NewsController@post_edit']);
});