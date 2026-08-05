<?php

namespace App\View\Composers;

use App\Services\FrontendContentService;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class SiteComposer
{
    public function __construct(
        private GeneralSettings $settings,
        private FrontendContentService $content,
    ) {}

    public function compose(View $view): void
    {
        $locale = app()->getLocale();
        $alternateLocale = $locale === 'ar' ? 'en' : 'ar';
        $alternateUrl = $this->alternateLocaleUrl($alternateLocale);

        $view->with([
            'settings' => $this->settings,
            'locale' => $locale,
            'direction' => config("locales.direction.{$locale}", 'ltr'),
            'alternateLocale' => $alternateLocale,
            'alternateUrl' => $alternateUrl,
            'isRtl' => $locale === 'ar',
            'menuItems' => $this->content->menuItems(),
            'footerBranches' => $this->content->footerBranches(),
            'socialLinks' => $this->content->socialLinks(),
        ]);
    }

    private function alternateLocaleUrl(string $alternateLocale): string
    {
        $route = Route::current();

        if ($route === null || $route->getName() === null) {
            return route('home', ['locale' => $alternateLocale]);
        }

        $parameters = $route->parameters();
        $parameters['locale'] = $alternateLocale;

        return route($route->getName(), $parameters);
    }
}
