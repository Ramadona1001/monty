<div class="upperbar py-1">
    <div class="container">
        <div class="row flex-column flex-md-row text-center text-md-start align-items-center">
            <div class="col">
                <ul class="list-unstyled">
                    <li>
                        <a class="text__color" href="tel:{{ $settings->phone }}">
                            <i class="fa-solid fa-phone"></i> {{ $settings->phone }}
                        </a>
                    </li>
                    <li>
                        <a class="text__color" href="mailto:{{ $settings->email }}">
                            <i class="fa-regular fa-envelope"></i> {{ $settings->email }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col">
                <button class="btn quote__btn">
                    <a href="{{ route('contact', ['locale' => $locale]) }}#form">{{ __('site.nav.quote') }}</a>
                </button>
            </div>
        </div>
    </div>
</div>
