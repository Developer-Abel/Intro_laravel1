<?php

Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');
Route::get('/portfolio','portafolioController@index')->name('portafolio');
Route::view('/contact','contact')->name('contacto');
