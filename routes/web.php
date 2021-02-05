<?php

Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');
Route::get('/portfolio','ProjectController@index')->name('projects.index');
Route::get('/portfolio/{id}','ProjectController@show')->name('projects.show');
Route::view('/contact','contact')->name('contacto');
Route::post('contact','MessageController@store')->name('contacto');

