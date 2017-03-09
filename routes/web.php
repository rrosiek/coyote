<?php

Route::group(['prefix' => 'members'], function () {

    Route::resource('events', 'Event', ['except' => ['show']]);

    Route::get('/', function () {
        return redirect()->route('events.index');
    });

});

Route::get('events', 'Event@index')->name('events');

Route::get('/', function () {
    return view('home.main');
})->name('home');
