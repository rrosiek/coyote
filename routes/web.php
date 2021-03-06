<?php

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

    Route::resource('correspondence', 'Correspondence', ['except' => ['edit', 'destroy', 'update']]);
    Route::resource('events', 'Event', ['except' => ['show']]);
    Route::resource('files', 'File', ['except' => ['edit', 'show', 'update']]);
    Route::resource('maillists', 'MailList', ['except' => ['show']]);
    Route::resource('minutes', 'Minutes', ['only' => ['create', 'destroy', 'store']]);
    Route::resource('newsletters', 'Newsletter', ['only' => ['create', 'destroy', 'store']]);
    Route::resource('pages', 'Page');
    Route::resource('users', 'User', ['only' => ['edit', 'index', 'update']]);

    Route::get('minutes', 'Minutes@index')->name('minutes.admin');
    Route::get('newsletters', 'Newsletter@index')->name('newsletters.admin');

    Route::get('/', function () {
        return redirect()->route('pages.index');
    })->name('admin');

});

Route::group(['prefix' => 'members', 'middleware' => ['auth']], function () {

    Route::resource('profiles', 'Profile', ['except' => ['create', 'destroy', 'store']]);

    Route::get('minutes', 'Minutes@index')->name('minutes.members');
    Route::get('newsletters', 'Newsletter@index')->name('newsletters.members');

    Route::get('/', function () {
        return redirect()->route('profiles.edit', Auth::user());
    })->name('members');

});

Route::get('events', function () {
    $title = 'Events';
    $events = \App\Models\Event::list();

    return view('events', compact('title', 'events'));
})->name('events.list');

Route::get('members/lifetime', 'Lifetime@index')->name('lifetime');
Route::get('members/minutes/{token}', 'Minutes@show')->name('minutes.show');
Route::get('members/newsletters/{token}', 'Newsletter@show')->name('newsletters.show');
Route::get('files/{token}', 'File@show')->name('files.show');

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
    $sections = \App\Models\Page::where('home_page', true)->get()->keyBy('slug');

    return view('home.main', compact('events', 'sections'));
})->name('home');

Route::get('/{wildcard}', function ($wildcard) {
    $page = \App\Models\Page::where('slug', $wildcard)->first();

    if ($page) {
        $title = $page->title;
        
        return view('page', compact('title', 'page'));
    } else {
        return redirect('/');
    }
})->where(['wildcard' => '.*']);
