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
    <section class="gallery-section py-5">
        <div class="container">
            @if($page?->getTranslation('seo_description', $locale))
                <p class="text-center mb-4">{{ $page->getTranslation('seo_description', $locale) }}</p>
            @endif

            @if($galleryItems->isNotEmpty())
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4">
                    @foreach($galleryItems as $item)
                        <div class="col d-flex">
                            @include('partials.gallery-card', ['item' => $item])
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-muted">{{ __('site.gallery.empty') }}</p>
            @endif
        </div>
    </section>

    <div class="modal fade gallery-modal" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="gallery-modal__content"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/site/gallery.js') }}"></script>
@endpush
