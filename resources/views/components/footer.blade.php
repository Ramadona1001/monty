<footer class="pt-5 bg-black">
    <div class="container">
        <div class="row">
            <div class="col">
                <img class="mb-3" width="200" src="{{ asset($settings->logo_path) }}" alt="{{ $settings->site_name }}">
                <p>{{ $settings->footer_description }}</p>
            </div>
            <div class="col">
                <h3 class="main__heading normal text-white">{{ __('site.footer.address_heading') }}</h3>
                <ul>
                    @foreach($footerBranches as $branch)
                        <li><i class="fa-solid fa-location-dot"></i> {{ $branch->getTranslation('address', $locale) }}</li>
                    @endforeach
                    <li><i class="fa-solid fa-phone"></i> {{ $settings->phone }}</li>
                    <li><i class="fa-solid fa-envelope"></i> {{ $settings->email }}</li>
                </ul>
            </div>
        </div>
        @if($settings->show_copyright ?? true)
            <div class="copyright">
                <span>&copy; {{ $settings->copyright_text }}
                    @if($settings->copyright_url)
                        <a href="{{ $settings->copyright_url }}" target="_blank" rel="noopener">Ocoda</a>
                    @endif
                </span>
            </div>
        @endif
    </div>
</footer>
