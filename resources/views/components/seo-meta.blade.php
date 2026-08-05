@if($page)
    @if($page->getTranslation('seo_description', $locale, false))
        <meta name="description" content="{{ $page->getTranslation('seo_description', $locale, false) }}">
    @endif
    @if($page->getTranslation('meta_keywords', $locale, false))
        <meta name="keywords" content="{{ $page->getTranslation('meta_keywords', $locale, false) }}">
    @endif
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="{{ $page->getTranslation('seo_title', $locale, false) ?: $page->getTranslation('title', $locale) }}">
    @if($page->getTranslation('seo_description', $locale, false))
        <meta property="og:description" content="{{ $page->getTranslation('seo_description', $locale, false) }}">
    @endif
    @if($page->banner_image)
        <meta property="og:image" content="{{ asset($page->banner_image) }}">
    @endif
    @if(Route::currentRouteName())
        <link rel="alternate" hreflang="en" href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['locale' => 'en'])) }}">
        <link rel="alternate" hreflang="ar" href="{{ route(Route::currentRouteName(), array_merge(Route::current()->parameters(), ['locale' => 'ar'])) }}">
    @endif
@endif
