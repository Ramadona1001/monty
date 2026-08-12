<footer class="pt-5 bg-black">
    <div class="container">
        <div class="row">
            <div class="col">
                <img class="mb-3" width="200" src="{{ asset($settings->logo_path) }}" alt="{{ $settings->site_name }}">
                <p>{{ $settings->footer_description }}</p>
            </div>
            <div class="col">
                <h3 class="main__heading normal text-white">{{ __('site.footer.address_heading') }}</h3>
                <ul class="list-unstyled footer-branches">
                    @foreach($footerBranches as $branch)
                        <li class="mb-3">
                            <strong class="text-white d-block mb-1">{{ $branch->getTranslation('name', $locale) }}</strong>
                            @include('partials.branch-contact', ['branch' => $branch,'is_footer' => true])
                        </li>
                    @endforeach
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
