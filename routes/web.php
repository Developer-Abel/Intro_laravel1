<?php

Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');

Route::resource('portfolio', 'ProjectController')->parameters(['portfolio' => 'project'])->names('project');

Route::view('/contact','contact')->name('contacto');
Route::post('contact','MessageController@store')->name('messages.store');

