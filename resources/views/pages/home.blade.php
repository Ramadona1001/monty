@extends('layouts.app')

@section('title', ($page?->getTranslation('seo_title', $locale, false) ?: $settings->site_name))

@section('meta')
    <x-seo-meta :page="$page" />
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        .hero .item {
            position: relative;
        }

        .hero-slide__overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .hero .item .hero__content {
            position: relative;
            z-index: 1;
        }
    </style>
@endpush

@section('hero')
    <section class="hero">
        <x-header :active="$activeNav" />
        <div class="owl-carousel-hero owl-carousel owl-theme position-relative">
            @foreach($heroSlides as $slide)
                <div class="item" style="background-image: url('{{ asset($slide->background_image) }}'); background-size: cover; background-repeat: no-repeat;">
                    @if(($slide->overlay_opacity ?? 0) > 0)
                        <div
                            class="hero-slide__overlay"
                            style="background-color: {{ $slide->overlay_color ?? '#000000' }}; opacity: {{ ($slide->overlay_opacity ?? 0) / 100 }};"
                        ></div>
                    @endif
                    <div class="hero__content">
                        <h2>{{ $slide->getTranslation('subtitle', $locale) }}</h2>
                        <h1>{{ $slide->getTranslation('title', $locale) }}</h1>
                        <span>{{ $slide->getTranslation('tagline', $locale) }}</span>
                        <button type="button" class="btn @if($branches->isNotEmpty() && $serviceRequestTypes->isNotEmpty()) js-open-service-wizard @endif">
                            {{ $slide->getTranslation('button_text', $locale) }}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('content')
    @if($about)
        <section class="aboutus__section py-5">
            <div class="container d-flex flex-column align-items-center text-center">
                <span class="sub__heading">{{ $about->getTranslation('home_subheading', $locale) }}</span>
                <h2 class="main__heading">{{ $about->getTranslation('home_heading', $locale) }}</h2>
                <div class="row">
                    <div class="col"></div>
                    <div class="col-10">
                        <p>{!! nl2br(e($about->getTranslation('home_body', $locale))) !!}</p>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </section>
    @endif

    @if($features->isNotEmpty())
        <section class="features pt-4">
            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($features as $feature)
                        <div class="col d-flex">
                            <div class="features__card h-100 w-100">
                                <div class="features__card__icon"><i class="{{ $feature->icon }}"></i></div>
                                <div class="features__card__content">
                                    <h5>{{ $feature->getTranslation('title', $locale) }}</h5>
                                    <p>{{ $feature->getTranslation('description', $locale) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($services->isNotEmpty() && $about)
        <section class="services-section py-5">
            <div class="container text-center">
                <span class="sub__heading">{{ $about->getTranslation('services_subheading', $locale) }}</span>
                <h2 class="main__heading">{{ $about->getTranslation('services_heading', $locale) }}</h2>
                <p>{{ $about->getTranslation('services_intro', $locale) }}</p>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                    @foreach($services as $service)
                        <div class="col">
                            <div class="services__card">
                                <div class="services__card__img mb-3">
                                    <a href="{{ route('services', ['locale' => $locale]) }}" class="services__img--overlay">
                                        <i class="fa-solid {{ $isRtl ? 'fa-left-long' : 'fa-right-long' }} text-white"></i>
                                    </a>
                                    <img class="img-fluid h-100 w-100" src="{{ asset($service->featured_image) }}" alt="{{ $service->getTranslation('title', $locale) }}" loading="lazy">
                                </div>
                                <div class="services__card__content">
                                    <span class="services__card__num">{{ $service->number }}</span>
                                    <h5 class="fw-bold mt-3">{{ $service->getTranslation('title', $locale) }}</h5>
                                    <p>{{ $service->getTranslation('excerpt', $locale) }}</p>
                                    <button class="btn btn__readmore">
                                        <a href="{{ route('services', ['locale' => $locale]) }}">{{ __('site.buttons.read_more') }}</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($whyUs)
        <section class="why-us my-5">
            <div class="why-us__image">
                <video width="100%" height="100%" poster="{{ asset($whyUs->poster_path) }}" src="{{ asset($whyUs->video_path) }}" controls></video>
            </div>
            <div class="why-us__content">
                <h3 class="main__heading normal text-white m-0">{{ $whyUs->getTranslation('title', $locale) }}</h3>
                <ul class="text-white">
                    @foreach($whyUs->getTranslation('bullets', $locale) ?? [] as $bullet)
                        <li>{{ $bullet }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @if($workProcessSteps->isNotEmpty() && $about)
        <section class="progress-section py-5">
            <div class="container text-center">
                <span class="sub__heading">{{ $about->getTranslation('progress_subheading', $locale) }}</span>
                <h2 class="main__heading">{{ $about->getTranslation('progress_heading', $locale) }}</h2>
                @foreach($workProcessSteps as $step)
                    <div class="row">
                        @if($step->layout === 'image-right')
                            <div class="col-6 d-flex align-items-center justify-content-center">
                                <div class="content ms-4 text-start">
                                    <h3 class="main__heading">{{ $step->getTranslation('title', $locale) }}</h3>
                                    <p>{{ $step->getTranslation('description', $locale) }}</p>
                                </div>
                            </div>
                            <div class="col-1 d-flex justify-content-center align-items-center">
                                <div class="number"><span>{{ $step->number }}</span></div>
                            </div>
                            <div class="col-5">
                                <img class="img-fluid" src="{{ asset($step->image_path) }}" alt="" loading="lazy">
                            </div>
                        @else
                            <div class="col-5">
                                <img class="img-fluid" src="{{ asset($step->image_path) }}" alt="" loading="lazy">
                            </div>
                            <div class="col-1 d-flex justify-content-center align-items-center">
                                <div class="number"><span>{{ $step->number }}</span></div>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-center">
                                <div class="content ms-4 text-start">
                                    <h3 class="main__heading">{{ $step->getTranslation('title', $locale) }}</h3>
                                    <p>{{ $step->getTranslation('description', $locale) }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @if($branches->isNotEmpty() && $serviceRequestTypes->isNotEmpty())
        <x-service-request-wizard :branches="$branches" :service-request-types="$serviceRequestTypes" />
    @endif
@endsection

@push('scripts-before')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@push('scripts')
    <script src="{{ asset('js/site/' . ($isRtl ? 'owl.carousel-rtl.js' : 'owl.carousel-ltr.js')) }}"></script>
    <script src="{{ asset('js/site/service-request-wizard.js') }}"></script>
@endpush
