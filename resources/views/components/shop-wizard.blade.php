@props([
    'productCategories',
    'uncategorizedProducts',
])

@php
    $productTabs = collect();

    foreach ($productCategories as $category) {
        $productTabs->push([
            'id' => 'shop-category-'.$category->id,
            'label' => $category->getTranslation('name', $locale),
            'products' => $category->products,
        ]);
    }

    if ($uncategorizedProducts->isNotEmpty()) {
        $productTabs->push([
            'id' => 'shop-category-uncategorized',
            'label' => __('site.products.uncategorized'),
            'products' => $uncategorizedProducts,
        ]);
    }

    $shopProductsData = collect();

    foreach ($productTabs as $tab) {
        foreach ($tab['products'] as $product) {
            $shopProductsData->put($product->id, [
                'id' => $product->id,
                'title' => $product->getTranslation('title', $locale),
                'images' => collect($product->galleryImagePaths())
                    ->map(fn (string $path) => asset($path))
                    ->values()
                    ->all(),
            ]);
        }
    }
@endphp

<div
    class="service-wizard shop-wizard"
    id="shop-wizard"
    hidden
    aria-hidden="true"
    data-no-images="{{ __('site.shop.no_images') }}"
>
    <script type="application/json" id="shop-products-data">@json($shopProductsData)</script>

    <div class="service-wizard__overlay" data-shop-close></div>

    <div class="service-wizard__panel shop-wizard__panel" role="dialog" aria-modal="true" aria-labelledby="shop-wizard-title">
        <button type="button" class="service-wizard__close shop-wizard__close" data-shop-close aria-label="{{ __('site.service_request.close') }}">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="service-wizard__header shop-wizard__header">
            <div class="shop-wizard__brand">
                <span class="shop-wizard__brand-icon" aria-hidden="true">
                    <i class="fa-solid fa-bag-shopping"></i>
                </span>
                <div class="shop-wizard__brand-copy">
                    <p class="shop-wizard__brand-eyebrow">{{ __('site.shop.button') }}</p>
                    <a href="{{ route('home', ['locale' => $locale]) }}" class="service-wizard__logo shop-wizard__logo">
                        <img src="{{ asset($settings->logo_path) }}" alt="{{ $settings->site_name }}">
                    </a>
                </div>
            </div>

            <div class="shop-wizard__progress" aria-hidden="true">
                <div class="shop-wizard__progress-track">
                    <span class="shop-wizard__progress-fill" data-shop-progress-fill style="width: 0%;"></span>
                </div>
            </div>

            <div class="service-wizard__steps shop-wizard__steps" aria-label="Progress">
                <div class="service-wizard__step shop-wizard__step is-active" data-shop-step-indicator="1">
                    <span class="service-wizard__step-num shop-wizard__step-num">1</span>
                    <span class="service-wizard__step-label">{{ __('site.shop.step_product') }}</span>
                </div>
                <div class="service-wizard__step shop-wizard__step" data-shop-step-indicator="2">
                    <span class="service-wizard__step-num shop-wizard__step-num">2</span>
                    <span class="service-wizard__step-label">{{ __('site.shop.step_gallery') }}</span>
                </div>
            </div>
        </div>

        <div class="service-wizard__body">

            <div class="service-wizard__screen shop-wizard__screen is-active" data-shop-step="1">
                <div class="shop-wizard__screen-head">
                    <h2 class="service-wizard__title shop-wizard__title" id="shop-wizard-title">{{ __('site.shop.step_product_title') }}</h2>
                    <p class="service-wizard__hint shop-wizard__hint">{{ __('site.shop.step_product_hint') }}</p>
                </div>

                <div class="shop-wizard__catalog">
                    <div class="shop-wizard__categories-wrap">
                        <p class="shop-wizard__section-label">{{ __('site.shop.categories_label') }}</p>
                        <ul class="nav shop-wizard__categories" id="shopCategoryTabs" role="tablist">
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
                    </div>

                    <div class="shop-wizard__catalog-main">
                        <p class="shop-wizard__section-label">{{ __('site.shop.products_label') }}</p>
                        <div class="tab-content shop-wizard__category-panels" id="shopCategoryTabsContent">
                        @foreach($productTabs as $tab)
                            <div
                                class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                id="{{ $tab['id'] }}"
                                role="tabpanel"
                                aria-labelledby="{{ $tab['id'] }}-tab"
                                tabindex="0"
                            >
                                <div class="shop-wizard__products">
                                    @foreach($tab['products'] as $product)
                                        <button
                                            type="button"
                                            class="shop-wizard__product"
                                            data-shop-select-product
                                            data-product-id="{{ $product->id }}"
                                            data-product-name="{{ $product->getTranslation('title', $locale) }}"
                                        >
                                            <span class="shop-wizard__product-inner">
                                                @if($product->image)
                                                    <span class="shop-wizard__product-image">
                                                        <img src="{{ asset($product->image) }}" alt="{{ $product->getTranslation('title', $locale) }}" loading="lazy">
                                                        <span class="shop-wizard__product-overlay">
                                                            <i class="fa-solid fa-images"></i>
                                                            <span>{{ __('site.shop.view_images') }}</span>
                                                        </span>
                                                    </span>
                                                @else
                                                    <span class="shop-wizard__product-image shop-wizard__product-image--placeholder">
                                                        <i class="fa-solid fa-cube"></i>
                                                    </span>
                                                @endif
                                                <span class="shop-wizard__product-title">{{ $product->getTranslation('title', $locale) }}</span>
                                            </span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-wizard__screen shop-wizard__screen" data-shop-step="2">
                <div class="shop-wizard__screen-head">
                    <span class="shop-wizard__selected-badge" data-shop-selected-badge hidden></span>
                    <h2 class="service-wizard__title shop-wizard__title" data-shop-gallery-title>{{ __('site.shop.step_gallery_title') }}</h2>
                    <p class="service-wizard__hint shop-wizard__hint">{{ __('site.shop.step_gallery_hint') }}</p>
                </div>

                <div class="shop-wizard__gallery" data-shop-gallery hidden></div>
            </div>

            <div class="service-wizard__error shop-wizard__error" data-shop-error hidden></div>

            <div class="service-wizard__actions shop-wizard__actions" data-shop-actions>
                <button type="button" class="service-wizard__btn service-wizard__btn--ghost" data-shop-prev hidden>
                    {{ __('site.service_request.previous') }}
                </button>
            </div>
        </div>
    </div>
</div>
