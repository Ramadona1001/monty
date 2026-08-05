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
    <section id="form" class="py-5">
        <div class="container text-center">
            <h2 class="main__heading">{{ $page?->getTranslation('seo_title', $locale) }}</h2>
            <p>{{ $page?->getTranslation('seo_description', $locale) }}</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7 col-lg-9">
                    <div class="map h-100">
                        <iframe src="{{ $settings->google_maps_embed }}" style="border: 0; width: 100%; min-height: 400px" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-3">
                    <div class="icon__boxes">
                        @foreach($branches as $branch)
                            <div class="icon__box">
                                <div class="icon">
                                    <i class="{{ $branch->icon }}"></i>
                                </div>
                                <div class="icon__box__content">
                                    <h6>{{ $branch->getTranslation('name', $locale) }}</h6>
                                    @include('partials.branch-contact', ['branch' => $branch])
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($socialLinks->isNotEmpty())
                        <div class="social__boxes">
                            @foreach($socialLinks as $link)
                                <div class="social__box">
                                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"><i class="{{ $link->icon }}"></i></a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <h2 class="main__heading text-center mb-4">{{ $page?->getTranslation('title', $locale) }}</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('contact.store', ['locale' => $locale]) }}">
                @csrf
                <div class="row row-cols-1 row-cols-md-3 gap-3 gap-md-0 mb-3">
                    <div class="col">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('site.contact.name') }}" class="form-control" required>
                    </div>
                    <div class="col">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ __('site.contact.email') }}" class="form-control">
                    </div>
                    <div class="col">
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="{{ __('site.contact.phone') }}" class="form-control" required>
                    </div>
                </div>
                <textarea name="message" placeholder="{{ __('site.contact.message') }}" class="form-control" rows="8">{{ old('message') }}</textarea>
                <button type="submit" class="btn quote__btn text-white mt-3">{{ __('site.contact.send') }}</button>
            </form>
        </div>
    </section>
@endsection
