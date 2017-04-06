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

Route::get('login', 'Auth\Login@showLoginForm')->name('login');
Route::post('login', 'Auth\Login@login');
Route::get('login/facebook', 'Auth\Login@redirectToFacebook');
Route::get('login/facebook/callback', 'Auth\Login@handleFacebookCallback');
Route::get('login/google', 'Auth\Login@redirectToGoogle');
Route::get('login/google/callback', 'Auth\Login@handleGoogleCallback');
Route::post('logout', 'Auth\Login@logout')->name('logout');
Route::get('password/reset', 'Auth\ForgotPassword@showLinkRequestForm')->name('password.request');
Route::get('register', 'Auth\Register@showRegistrationForm')->name('register');
Route::post('register', 'Auth\Register@register');
Route::get('register/activate/{token}', 'Auth\Register@activate')->name('register.activate');

Route::get('/', function () {
    $events = \App\Models\Event::list(3);
    $sections = \App\Models\HomePage::all()->keyBy('slug');

    return view('home.main', compact('events', 'sections'));
})->name('home');

Route::get('/{wildcard}', function ($wildcard) {
    $page = \App\Models\HomePage::where('slug', $wildcard)->first();

    if ($page) {
        $title = $page->title;
        
        return view('page', compact('title', 'page'));
    } else {
        return redirect('/');
    }
})->where(['wildcard' => '.*']);
