@props(['active' => null])

<section class="header">
    <div class="container bg-white">
        <div class="row align-items-center">
            <div class="col-4">
                <a href="{{ route('home', ['locale' => $locale]) }}">
                    <img src="{{ asset($settings->logo_path) }}" width="300" alt="{{ $settings->site_name }}">
                </a>
            </div>
            <div class="col-8 d-none d-lg-block">
                <nav class="desktop-nav d-none d-lg-flex justify-content-between">
                    <ul class="navslist ms-auto p-0">
                        @foreach($menuItems as $item)
                            <li>
                                <a @class(['active' => $active === $item->route_name]) href="{{ route($item->route_name, ['locale' => $locale]) }}">
                                    {{ $item->getTranslation('label', $locale) }}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <a href="{{ $alternateUrl }}"><i class="fa-solid fa-language"></i> {{ __('site.nav.language') }}</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col d-block d-lg-none">
                <button class="hamburger" type="button" aria-label="Menu">
                    <div class="bar"></div>
                </button>
            </div>
        </div>
    </div>
</section>
