<?php

Route::get('/social/{provider}', 'AuthController@redirectToProvider');
Route::get('/social/{provider}/callback', 'AuthController@handleProviderCallback');

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');