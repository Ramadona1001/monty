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
    @if($about)
        <section class="aboutus__page py-5">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col">
                        <div class="services__card__img mb-3">
                            <img class="img-fluid w-100" src="{{ asset($about->intro_image) }}" alt="{{ $about->getTranslation('intro_title', $locale) }}" loading="lazy">
                        </div>
                    </div>
                    <div class="col">
                        <div class="services__card__content ps-4">
                            <h4 class="fw-bold mt-3">{{ $about->getTranslation('intro_title', $locale) }}</h4>
                            <h5 class="fw-bold mt-3">{{ $about->getTranslation('intro_subtitle', $locale) }}</h5>
                            <p>{!! nl2br(e($about->getTranslation('intro_body', $locale))) !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col">
                        <h5 class="main__heading normal">{{ $about->getTranslation('vision_title', $locale) }}</h5>
                        <p>{{ $about->getTranslation('vision_body', $locale) }}</p>
                    </div>
                    <div class="col">
                        <h5 class="main__heading normal">{{ $about->getTranslation('mission_title', $locale) }}</h5>
                        <p>{{ $about->getTranslation('mission_body', $locale) }}</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <x-statistics :statistics="$statistics" />
@endsection
