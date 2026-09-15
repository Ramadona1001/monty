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
        $productTabs = collect();

        foreach ($productCategories as $category) {
            $productTabs->push([
                'id' => 'product-category-'.$category->id,
                'label' => $category->getTranslation('name', $locale),
                'products' => $category->products,
            ]);
        }

        if ($uncategorizedProducts->isNotEmpty()) {
            $productTabs->push([
                'id' => 'product-category-uncategorized',
                'label' => __('site.products.uncategorized'),
                'products' => $uncategorizedProducts,
            ]);
        }
    @endphp

    <section class="products-section py-5">
        <div class="container">
            @if($page?->getTranslation('seo_description', $locale))
                <p class="text-center mb-4">{{ $page->getTranslation('seo_description', $locale) }}</p>
            @endif

            @if($productTabs->isNotEmpty())
                <div class="product-category-tabs">
                    <ul class="nav product-category-tabs__nav" id="productCategoryTabs" role="tablist">
                        @foreach($productTabs as $tab)
                            <li class="nav-item" role="presentation">
                                <button
                                    class="nav-link {{ $loop->first ? 'active' : '' }}"
                                    id="{{ $tab['id'] }}-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#{{ $tab['id'] }}"
                                    type="button"
                                    role="tab"
                                    aria-controls="{{ $tab['id'] }}"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                >
                                    {{ $tab['label'] }}
                                </button>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content product-category-tabs__content" id="productCategoryTabsContent">
                        @foreach($productTabs as $tab)
                            <div
                                class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="{{ $tab['id'] }}"
                                role="tabpanel"
                                aria-labelledby="{{ $tab['id'] }}-tab"
                                tabindex="0"
                            >
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                                    @foreach($tab['products'] as $product)
                                        <div class="col d-flex">
                                            @include('partials.product-card', ['product' => $product, 'showCategory' => false])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-center text-muted">{{ __('site.products.empty') }}</p>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/site/products-tabs.js') }}"></script>
@endpush
