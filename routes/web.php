<?php

Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');

Route::get('/portfolio','ProjectController@index')->name('projects.index');
Route::get('/portfolio/crear','ProjectController@create')->name('projects.create');
Route::get('/portfolio/{project}/editar','ProjectController@edit')->name('project.edit');
Route::patch('/portfolio/{project}','ProjectController@update')->name('project.update');
Route::post('/portfolio','ProjectController@store')->name('projects.store');
Route::get('/portfolio/{project}','ProjectController@show')->name('projects.show');

Route::delete('portfolio/{project}', 'ProjectController@destroy')->name('project.destroy');

Route::view('/contact','contact')->name('contacto');
Route::post('contact','MessageController@store')->name('messages.store');

