<?php

//Rutas autenticación usuario
Auth::routes();

/*
|--------------------------------------------------------------------------
| Rutas traducidas
|--------------------------------------------------------------------------
 */
Route::group(['prefix' => LL::setLocale(), 'middleware' => ['localizationRedirect', 'web' , 'xss']], function () {

    Route::get('/', 'FrontController@home')->name('home');    
    Route::get('blog', 'FrontController@articles')->name('articles');    
    Route::get('articulo/{slug}', 'FrontController@article')->name('article');    
    

});