<?php

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

    Route::resource('events', 'Event', ['except' => ['show']]);
    Route::resource('home-pages', 'HomePage', ['except' => ['create', 'destroy']]);
    Route::resource('users', 'User', ['only' => ['edit', 'index', 'update']]);

    Route::resource('correspondence', 'Correspondence', ['except' => ['edit', 'destroy', 'update']]);

    Route::get('/', function () {
        return redirect()->route('home-pages.index');
    })->name('admin');

});

Route::group(['prefix' => 'members', 'middleware' => ['auth']], function () {

    Route::resource('profiles', 'Profile', ['except' => ['create', 'destroy', 'store']]);

    Route::get('/', function () {
        return redirect()->route('profiles.edit', ['user' => Auth::id()]);
    })->name('members');

});

Route::get('events', function () {
    $title = 'Events';
    $events = \App\Models\Event::list();

    return view('events', compact('title', 'events'));
})->name('events.list');

Route::get('payments', 'Payment@create')->name('payments');
Route::post('payments', 'Payment@store');

Route::post('correspondence/hook', 'Correspondence@handleMailHook');

Route::get('login', 'Auth\Login@showLoginForm')->name('login');
Route::post('login', 'Auth\Login@login');
Route::get('login/facebook', 'Auth\Login@redirectToFacebook')->name('login.facebook');
Route::get('login/facebook/callback', 'Auth\Login@handleFacebookCallback');
Route::get('login/google', 'Auth\Login@redirectToGoogle')->name('login.google');
Route::get('login/google/callback', 'Auth\Login@handleGoogleCallback');
Route::get('logout', 'Auth\Login@logout')->name('logout');
Route::post('password/email', 'Auth\ForgotPassword@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPassword@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPassword@reset');
Route::get('password/reset/{token}', 'Auth\ResetPassword@showResetForm')->name('password.reset');
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
