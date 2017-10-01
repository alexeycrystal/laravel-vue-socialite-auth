<?php
/*
 *
Route::options('{all}', function(){
    return response('',200);
})->where('all', '.*');
*/

Route::get('/social/{provider}', 'AuthController@redirectToProvider');
Route::get('/social/{provider}/callback', 'AuthController@handleProviderCallback');

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');