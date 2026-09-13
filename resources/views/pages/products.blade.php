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
    <section class="products-section py-5">
        <div class="container">
            @if($page?->getTranslation('seo_description', $locale))
                <p class="text-center mb-4">{{ $page->getTranslation('seo_description', $locale) }}</p>
            @endif

            @if($products->isNotEmpty())
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                    @foreach($products as $product)
                        <div class="col d-flex">
                            @include('partials.product-card', ['product' => $product])
                        </div>
                    @endforeach
                </div>

                @if($products->hasPages())
                    <div class="gallery-pagination mt-4">
                        {{ $products->links() }}
                    </div>
                @endif
            @else
                <p class="text-center text-muted">{{ __('site.products.empty') }}</p>
            @endif
        </div>
    </section>
@endsection
