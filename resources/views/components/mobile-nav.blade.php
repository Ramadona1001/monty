@props(['active' => null])

<div class="mobile-nav__overlay"></div>
<nav class="mobile-nav">
    <span class="closing_btn"><i class="fa-solid fa-xmark"></i></span>
    <a class="d-block text-center" href="{{ route('home', ['locale' => $locale]) }}">
        <img width="200" src="{{ asset($settings->logo_path) }}" alt="{{ $settings->site_name }}">
    </a>
    <ul class="mobile-nav__list m-0 p-0 py-2">
        @foreach($menuItems as $item)
            <a @class(['active' => $active === $item->route_name]) href="{{ route($item->route_name, ['locale' => $locale]) }}">
                {{ $item->getTranslation('label', $locale) }}
            </a>
        @endforeach
        <a href="{{ $alternateUrl }}">{{ config('locales.labels.' . $alternateLocale) }}</a>
    </ul>
</nav>
