@props([
    'products',
])

<div
    class="service-wizard shop-wizard"
    id="shop-wizard"
    hidden
    aria-hidden="true"
    data-submit-url="{{ route('shop-request.store', ['locale' => $locale]) }}"
    data-validation="{{ __('site.shop.validation') }}"
    data-error="{{ __('site.shop.error') }}"
>
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
                    <span class="service-wizard__step-label">{{ __('site.shop.step_details') }}</span>
                </div>
            </div>
        </div>

        <form class="service-wizard__body" id="shop-request-form" novalidate>
            @csrf

            <div class="service-wizard__screen is-active" data-shop-step="1">
                <h2 class="service-wizard__title" id="shop-wizard-title">{{ __('site.shop.step_product_title') }}</h2>
                <p class="service-wizard__hint">{{ __('site.shop.step_product_hint') }}</p>

                <div class="shop-wizard__products">
                    @foreach($products as $product)
                        <label class="shop-wizard__product">
                            <input
                                type="radio"
                                name="product_id"
                                value="{{ $product->id }}"
                                data-product-name="{{ $product->getTranslation('title', $locale) }}"
                                required
                            >
                            <span class="shop-wizard__product-inner">
                                @if($product->image)
                                    <span class="shop-wizard__product-image">
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->getTranslation('title', $locale) }}" loading="lazy">
                                    </span>
                                @endif
                                <span class="shop-wizard__product-title">{{ $product->getTranslation('title', $locale) }}</span>
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="service-wizard__screen" data-shop-step="2">
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
                <button type="button" class="service-wizard__btn service-wizard__btn--primary" data-shop-next>
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
