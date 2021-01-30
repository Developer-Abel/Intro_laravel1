<?php

// Route::view('/','home')->name('inicio');
// Route::view('/about','about')->name('acerca');
// Route::get('/portfolio','portafolioController@index')->name('portafolio');

Route::resource('/portfolio', 'portafolioController');

// Route::view('/contact','contact')->name('contacto');
// Route::get('/post', function () {
//     return "hola";
// })->name('pok');