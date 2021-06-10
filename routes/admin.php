<?php

/*

|--------------------------------------------------------------------------

| Panel Administrativo

|--------------------------------------------------------------------------

 */

Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {
    Route::resource('admins', 'AdminController');
    Route::resource('article', 'ArticleController');

    Route::resource('admins', 'AdminController');
    Route::resource('users', 'UserController');
/*routes_crudy*/

     Route::group(['prefix' => 'ajax'], function () {         
          Route::post('published-article', 'ArticleController@published')->name('article.published');

     });

  Route::group(['prefix' => 'lfmanager', 'middleware' => ['admin']], function () {

     \UniSharp\LaravelFilemanager\Lfm::routes();

  });

});