<?php

Route::group(['prefix' => 'admin'], function () {

    Route::resource('events', 'Event', ['except' => ['show']]);
    Route::resource('home-pages', 'HomePage', ['except' => ['create', 'destroy']]);

    Route::get('/', function () {
        return redirect()->route('home-pages.index');
    });

});

Route::get('events', function () {
    $title = 'Events';
    $events = \App\Models\Event::list();

    return view('events', compact('title', 'events'));
})->name('events.list');

Route::get('/', function () {
    $events = \App\Models\Event::list(3);
    $sections = \App\Models\HomePage::all()->keyBy('slug');

    return view('home.main', compact('events', 'sections'));
})->name('home');
