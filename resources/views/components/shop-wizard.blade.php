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
    data-submit-url="{{ route('shop-request.store', ['locale' => $locale]) }}"
    data-validation="{{ __('site.shop.validation') }}"
    data-error="{{ __('site.shop.error') }}"
    data-no-images="{{ __('site.shop.no_images') }}"
>
    <script type="application/json" id="shop-products-data">@json($shopProductsData)</script>

    <div class="service-wizard__overlay" data-shop-close></div>

    <div class="service-wizard__panel" role="dialog" aria-modal="true" aria-labelledby="shop-wizard-title">
        <button type="button" class="service-wizard__close" data-shop-close aria-label="{{ __('site.service_request.close') }}">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="service-wizard__header">
            <a href="{{ route('home', ['locale' => $locale]) }}" class="service-wizard__logo">
                <img src="{{ asset($settings->logo_path) }}" alt="{{ $settings->site_name }}">
            </a>

            <div class="service-wizard__steps" aria-label="Progress">
                <div class="service-wizard__step is-active" data-shop-step-indicator="1">
                    <span class="service-wizard__step-num">1</span>
                    <span class="service-wizard__step-label">{{ __('site.shop.step_product') }}</span>
                </div>
                <div class="service-wizard__step-line"></div>
                <div class="service-wizard__step" data-shop-step-indicator="2">
                    <span class="service-wizard__step-num">2</span>
                    <span class="service-wizard__step-label">{{ __('site.shop.step_gallery') }}</span>
                </div>
                <div class="service-wizard__step-line"></div>
                <div class="service-wizard__step" data-shop-step-indicator="3">
                    <span class="service-wizard__step-num">3</span>
                    <span class="service-wizard__step-label">{{ __('site.shop.step_details') }}</span>
                </div>
            </div>
        </div>

        <form class="service-wizard__body" id="shop-request-form" novalidate>
            @csrf
            <input type="hidden" name="product_id" id="shop-product-id" value="">

            <div class="service-wizard__screen is-active" data-shop-step="1">
                <h2 class="service-wizard__title" id="shop-wizard-title">{{ __('site.shop.step_product_title') }}</h2>
                <p class="service-wizard__hint">{{ __('site.shop.step_product_hint') }}</p>

                <div class="shop-wizard__catalog">
                    <ul class="nav flex-column shop-wizard__categories" id="shopCategoryTabs" role="tablist">
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

            <div class="service-wizard__screen" data-shop-step="2">
                <h2 class="service-wizard__title" data-shop-gallery-title>{{ __('site.shop.step_gallery_title') }}</h2>
                <p class="service-wizard__hint">{{ __('site.shop.step_gallery_hint') }}</p>

                <div class="shop-wizard__gallery" data-shop-gallery hidden></div>
            </div>

            <div class="service-wizard__screen" data-shop-step="3">
                <h2 class="service-wizard__title">{{ __('site.shop.step_details_title') }}</h2>
                <p class="service-wizard__hint">{{ __('site.shop.step_details_hint') }}</p>

                <div class="service-wizard__summary">
                    <div class="service-wizard__summary-row">
                        <span class="service-wizard__summary-label">{{ __('site.shop.selected_product') }}</span>
                        <span class="service-wizard__summary-value" data-shop-summary-product>—</span>
                    </div>
                </div>

                <div class="service-wizard__field">
                    <label class="service-wizard__label" for="shop-customer-name">{{ __('site.service_request.customer_name') }}</label>
                    <input class="service-wizard__input" type="text" id="shop-customer-name" name="customer_name" required autocomplete="name">
                </div>

                <div class="service-wizard__field">
                    <label class="service-wizard__label" for="shop-phone">{{ __('site.service_request.phone') }}</label>
                    <input class="service-wizard__input" type="tel" id="shop-phone" name="phone" required autocomplete="tel">
                </div>

                <div class="service-wizard__field">
                    <label class="service-wizard__label" for="shop-notes">{{ __('site.service_request.notes') }}</label>
                    <textarea class="service-wizard__textarea" id="shop-notes" name="notes" rows="4" placeholder="{{ __('site.service_request.notes_placeholder') }}"></textarea>
                </div>
            </div>

            <div class="service-wizard__screen service-wizard__screen--success" data-shop-step="success">
                <div class="service-wizard__success-icon">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h2 class="service-wizard__title">{{ __('site.shop.success_title') }}</h2>
                <p class="service-wizard__hint">{{ __('site.shop.success_message') }}</p>
            </div>

            <div class="service-wizard__error" data-shop-error hidden></div>

            <div class="service-wizard__actions" data-shop-actions>
                <button type="button" class="service-wizard__btn service-wizard__btn--ghost" data-shop-prev hidden>
                    {{ __('site.service_request.previous') }}
                </button>
                <button type="button" class="service-wizard__btn service-wizard__btn--primary" data-shop-next hidden>
                    {{ __('site.service_request.next') }}
                </button>
                <button type="submit" class="service-wizard__btn service-wizard__btn--primary" data-shop-submit hidden>
                    <i class="fa-solid fa-paper-plane"></i>
                    {{ __('site.shop.confirm') }}
                </button>
                <a href="{{ route('home', ['locale' => $locale]) }}" class="service-wizard__btn service-wizard__btn--primary" data-shop-home hidden>
                    {{ __('site.service_request.back_home') }}
                </a>
            </div>
        </form>
    </div>
</div>
