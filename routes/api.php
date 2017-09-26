<?php

Route::get('auth/{provider}', 'AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');