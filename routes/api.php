<?php

Route::get('/social/{provider}', 'SocialiteController@redirectToProvider');
Route::get('/social/{provider}/callback', 'SocialiteController@handleProviderCallback');

Route::post('/register', 'RegisterController@register');
Route::post('/login', 'LoginController@login');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'LoginController@logout');
});
