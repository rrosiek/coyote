<?php

Route::group(['prefix' => 'admin'], function () {

    Route::resource('events', 'Event', ['except' => ['show']]);
    Route::resource('pages', 'Page', ['except' => ['destroy', 'show']]);

    Route::get('/', function () {
        return redirect()->route('pages.index');
    });

});

Route::get('events', function () {
    $title = 'Events';
    $events = \App\Models\Event::list();

    return view('events', compact('title', 'events'));
})->name('events.list');

Route::get('/', function () {
    $events = \App\Models\Event::list(3);

    return view('home.main', compact('events'));
})->name('home');
