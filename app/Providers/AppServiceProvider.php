<?php

namespace App\Providers;

use App\View\Composers\SiteComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer(['layouts.app', 'components.*', 'pages.*'], SiteComposer::class);

        if ($this->app->runningInConsole() && ! $this->app->runningUnitTests()) {
            return;
        }

        try {
            if (Schema::hasTable('ui_translations')) {
                app(\App\Services\UiTranslationService::class)->load();
            }
        } catch (\Throwable) {
            //
        }
    }
}
