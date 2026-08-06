@props([
    'branches',
    'serviceRequestTypes',
])

<div
    class="service-wizard"
    id="service-request-wizard"
    hidden
    aria-hidden="true"
    data-submit-url="{{ route('service-request.store', ['locale' => $locale]) }}"
    data-home-url="{{ route('home', ['locale' => $locale]) }}"
    data-validation="{{ __('site.service_request.validation') }}"
    data-error="{{ __('site.service_request.error') }}"
>
    <div class="service-wizard__overlay" data-wizard-close></div>

    <div class="service-wizard__panel" role="dialog" aria-modal="true" aria-labelledby="service-wizard-title">
        <button type="button" class="service-wizard__close" data-wizard-close aria-label="{{ __('site.service_request.close') }}">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="service-wizard__header">
            <a href="{{ route('home', ['locale' => $locale]) }}" class="service-wizard__logo">
                <img src="{{ asset($settings->logo_path) }}" alt="{{ $settings->site_name }}">
            </a>

            <div class="service-wizard__steps" aria-label="Progress">
                <div class="service-wizard__step is-active" data-step-indicator="1">
                    <span class="service-wizard__step-num">1</span>
                    <span class="service-wizard__step-label">{{ __('site.service_request.step_branch') }}</span>
                </div>
                <div class="service-wizard__step-line"></div>
                <div class="service-wizard__step" data-step-indicator="2">
                    <span class="service-wizard__step-num">2</span>
                    <span class="service-wizard__step-label">{{ __('site.service_request.step_service') }}</span>
                </div>
                <div class="service-wizard__step-line"></div>
                <div class="service-wizard__step" data-step-indicator="3">
                    <span class="service-wizard__step-num">3</span>
                    <span class="service-wizard__step-label">{{ __('site.service_request.step_details') }}</span>
                </div>
            </div>
        </div>

        <form class="service-wizard__body" id="service-request-form" novalidate>
            @csrf

            {{-- Step 1: Branch --}}
            <div class="service-wizard__screen is-active" data-wizard-step="1">
                <h2 class="service-wizard__title" id="service-wizard-title">{{ __('site.service_request.step_branch_title') }}</h2>
                <p class="service-wizard__hint">{{ __('site.service_request.step_branch_hint') }}</p>

                <div class="service-wizard__field">
                    <label class="service-wizard__label" for="wizard-branch">{{ __('site.service_request.select_branch') }}</label>
                    <select class="service-wizard__select" id="wizard-branch" name="branch_id" required>
                        <option value="">{{ __('site.service_request.select_branch') }}</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->getTranslation('name', $locale) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Step 2: Service type --}}
            <div class="service-wizard__screen" data-wizard-step="2">
                <h2 class="service-wizard__title">{{ __('site.service_request.step_service_title') }}</h2>
                <p class="service-wizard__hint">{{ __('site.service_request.step_service_hint') }}</p>

                <div class="service-wizard__cards">
                    @foreach($serviceRequestTypes as $type)
                        <label class="service-wizard__card">
                            <input
                                type="radio"
                                name="service_request_type_id"
                                value="{{ $type->id }}"
                                data-service-name="{{ $type->getTranslation('name', $locale) }}"
                                required
                            >
                            <span class="service-wizard__card-inner">
                                @if($type->icon)
                                    <span class="service-wizard__card-icon"><i class="{{ $type->icon }}"></i></span>
                                @endif
                                <span class="service-wizard__card-title">{{ $type->getTranslation('name', $locale) }}</span>
                                @if($type->getTranslation('description', $locale))
                                    <span class="service-wizard__card-desc">{{ $type->getTranslation('description', $locale) }}</span>
                                @endif
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Step 3: Customer details --}}
            <div class="service-wizard__screen" data-wizard-step="3">
                <h2 class="service-wizard__title" data-wizard-details-title>{{ __('site.service_request.step_details_title') }}</h2>
                <p class="service-wizard__hint">{{ __('site.service_request.step_details_hint') }}</p>

                <div class="service-wizard__summary">
                    <div class="service-wizard__summary-row">
                        <span class="service-wizard__summary-label">{{ __('site.service_request.selected_branch') }}</span>
                        <span class="service-wizard__summary-value" data-summary-branch>—</span>
                    </div>
                    <div class="service-wizard__summary-row">
                        <span class="service-wizard__summary-label">{{ __('site.service_request.selected_service') }}</span>
                        <span class="service-wizard__summary-value" data-summary-service>—</span>
                    </div>
                </div>

                <div class="service-wizard__field">
                    <label class="service-wizard__label" for="wizard-customer-name">{{ __('site.service_request.customer_name') }}</label>
                    <input class="service-wizard__input" type="text" id="wizard-customer-name" name="customer_name" required autocomplete="name">
                </div>

                <div class="service-wizard__field">
                    <label class="service-wizard__label" for="wizard-phone">{{ __('site.service_request.phone') }}</label>
                    <input class="service-wizard__input" type="tel" id="wizard-phone" name="phone" required autocomplete="tel">
                </div>

                <div class="service-wizard__field">
                    <label class="service-wizard__label" for="wizard-service-display">{{ __('site.service_request.service_type') }}</label>
                    <input class="service-wizard__input" type="text" id="wizard-service-display" readonly tabindex="-1">
                </div>

                <div class="service-wizard__field">
                    <label class="service-wizard__label" for="wizard-notes">{{ __('site.service_request.notes') }}</label>
                    <textarea class="service-wizard__textarea" id="wizard-notes" name="notes" rows="4" placeholder="{{ __('site.service_request.notes_placeholder') }}"></textarea>
                </div>

                <div class="service-wizard__notice">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>{{ __('site.service_request.info_notice') }}</span>
                </div>
            </div>

            {{-- Success --}}
            <div class="service-wizard__screen service-wizard__screen--success" data-wizard-step="success">
                <div class="service-wizard__success-icon">
                    <i class="fa-solid fa-check"></i>
                </div>
                <h2 class="service-wizard__title">{{ __('site.service_request.success_title') }}</h2>
                <p class="service-wizard__hint">{{ __('site.service_request.success_message') }}</p>
            </div>

            <div class="service-wizard__error" data-wizard-error hidden></div>

            <div class="service-wizard__actions" data-wizard-actions>
                <button type="button" class="service-wizard__btn service-wizard__btn--ghost" data-wizard-prev hidden>
                    {{ __('site.service_request.previous') }}
                </button>
                <button type="button" class="service-wizard__btn service-wizard__btn--primary" data-wizard-next>
                    {{ __('site.service_request.next') }}
                </button>
                <button type="submit" class="service-wizard__btn service-wizard__btn--primary" data-wizard-submit hidden>
                    <i class="fa-solid fa-paper-plane"></i>
                    {{ __('site.service_request.confirm') }}
                </button>
                <a href="{{ route('home', ['locale' => $locale]) }}" class="service-wizard__btn service-wizard__btn--primary" data-wizard-home hidden>
                    {{ __('site.service_request.back_home') }}
                </a>
            </div>
        </form>
    </div>
</div>
