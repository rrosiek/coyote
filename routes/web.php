<?php

Route::group(['prefix' => 'admin'], function () {

    Route::resource('events', 'Event', ['except' => ['show']]);
    Route::resource('pages', 'Page', ['except' => ['destroy', 'show']]);

    Route::get('/', function () {
        return redirect()->route('pages.index');
    });

});

Route::get('events', 'Event@list')->name('events.list');

Route::get('/', function () {
    return view('home.main');
})->name('home');
