<?php
namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('members.*', function ($view) {
            $subnav = collect([
                ['route' => 'events.index', 'label' => 'Events'],
                // ['link' => route('members.profile', ['profile' => Auth::user()->id]), 'label' => 'Profile'],
                // ['link' => route('organization.edit', ['organization' => Organization::first()]), 'label' => 'Organization'],
                // ['link' => route('settings.costtemplates'), 'label' => 'Cost Templates'],
                // ['link' => '#', 'label' => 'Document Templates'],
            ])->filter(function ($item) {
                return $item['route'] !== Route::currentRouteName();
            })->map(function ($item) {
                return ['link' => route($item['route']), 'label' => $item['label']];
            });

            $view->with('subnav', $subnav);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
