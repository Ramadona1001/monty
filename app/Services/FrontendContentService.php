<?php

namespace App\Services;

use App\Models\AboutSetting;
use App\Models\Branch;
use App\Models\Feature;
use App\Models\HeroSlide;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Service;
use App\Models\ServiceRequestType;
use App\Models\SocialLink;
use App\Models\Statistic;
use App\Models\WhyUsSetting;
use App\Models\WorkProcessStep;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class FrontendContentService
{
    public function menuItems(): Collection
    {
        return Cache::remember('frontend.menu_items', 3600, fn () => MenuItem::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
    }

    public function footerBranches(): Collection
    {
        return Cache::remember('frontend.footer_branches.'.app()->getLocale(), 3600, function () {
            return Branch::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get()
                ->filter(fn (Branch $branch) => $branch->hasContactInfo(app()->getLocale()));
        });
    }

    public function socialLinks(): Collection
    {
        return Cache::remember('frontend.social_links', 3600, fn () => SocialLink::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
    }

    public function page(string $slug): ?Page
    {
        return Cache::remember("frontend.page.{$slug}", 3600, fn () => Page::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->first());
    }

    public function heroSlides(): Collection
    {
        return Cache::remember('frontend.hero_slides', 3600, fn () => HeroSlide::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
    }

    public function features(): Collection
    {
        return Cache::remember('frontend.features', 3600, fn () => Feature::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
    }

    public function featuredServices(): Collection
    {
        return Cache::remember('frontend.featured_services', 3600, fn () => Service::query()
            ->with('images')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->get());
    }

    public function services(): Collection
    {
        return Cache::remember('frontend.services', 3600, fn () => Service::query()
            ->with(['images', 'features'])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
    }

    public function workProcessSteps(): Collection
    {
        return Cache::remember('frontend.work_process_steps', 3600, fn () => WorkProcessStep::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
    }

    public function statistics(): Collection
    {
        return Cache::remember('frontend.statistics', 3600, fn () => Statistic::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
    }

    public function aboutSetting(): ?AboutSetting
    {
        return Cache::remember('frontend.about_setting', 3600, fn () => AboutSetting::query()->first());
    }

    public function whyUsSetting(): ?WhyUsSetting
    {
        return Cache::remember('frontend.why_us_setting', 3600, fn () => WhyUsSetting::query()->first());
    }

    public function contactBranches(): Collection
    {
        return Cache::remember('frontend.contact_branches', 3600, fn () => Branch::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
    }

    public function serviceRequestTypes(): Collection
    {
        return Cache::remember('frontend.service_request_types', 3600, fn () => ServiceRequestType::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get());
    }

    public function clearCache(): void
    {
        foreach ([
            'frontend.menu_items',
            'frontend.social_links',
            'frontend.hero_slides',
            'frontend.features',
            'frontend.featured_services',
            'frontend.services',
            'frontend.work_process_steps',
            'frontend.statistics',
            'frontend.about_setting',
            'frontend.why_us_setting',
            'frontend.contact_branches',
            'frontend.service_request_types',
        ] as $key) {
            Cache::forget($key);
        }

        foreach (['en', 'ar'] as $locale) {
            Cache::forget("frontend.footer_branches.{$locale}");
        }

        foreach (['home', 'about', 'services', 'contact'] as $slug) {
            Cache::forget("frontend.page.{$slug}");
        }
    }
}
