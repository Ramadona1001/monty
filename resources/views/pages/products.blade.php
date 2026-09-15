@extends('layouts.app')

@section('title', ($page?->getTranslation('seo_title', $locale, false) ?: $page?->getTranslation('title', $locale)).' | '.$settings->site_name)

@section('meta')
    <x-seo-meta :page="$page" />
@endsection

@section('hero')
    <x-page-hero
        :active="$activeNav"
        :page="$page"
        :breadcrumb-current="$page?->getTranslation('title', $locale)"
    />
@endsection

@section('content')
    @php
        $hasProducts = $productCategories->isNotEmpty() || $uncategorizedProducts->isNotEmpty();
    @endphp

    <section class="products-section py-5">
        <div class="container">
            @if($page?->getTranslation('seo_description', $locale))
                <p class="text-center mb-4">{{ $page->getTranslation('seo_description', $locale) }}</p>
            @endif

            @if($hasProducts)
                @foreach($productCategories as $category)
                    <div class="product-category-section">
                        <h2 class="product-category-section__title">{{ $category->getTranslation('name', $locale) }}</h2>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                            @foreach($category->products as $product)
                                <div class="col d-flex">
                                    @include('partials.product-card', ['product' => $product, 'showCategory' => false])
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                @if($uncategorizedProducts->isNotEmpty())
                    <div class="product-category-section">
                        <h2 class="product-category-section__title">{{ __('site.products.uncategorized') }}</h2>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                            @foreach($uncategorizedProducts as $product)
                                <div class="col d-flex">
                                    @include('partials.product-card', ['product' => $product, 'showCategory' => false])
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @else
                <p class="text-center text-muted">{{ __('site.products.empty') }}</p>
            @endif
        </div>
    </section>
@endsection
