@extends('layouts.app')

@section('title', ($page?->getTranslation('seo_title', $locale, false) ?: $page?->getTranslation('title', $locale)).' | '.$settings->site_name)

@section('meta')
    <x-seo-meta :page="$page" />
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer">
@endpush

@section('hero')
    <x-page-hero
        :active="$activeNav"
        :page="$page"
        :breadcrumb-current="$page?->getTranslation('title', $locale)"
    />
@endsection

@section('content')
    <section class="services pb-5">
        <div class="container">
            @foreach($services as $index => $service)
                <div @class(['row pt-5 align-items-center row-cols-1 row-cols-md-2', 'flex-column-reverse flex-md-row' => $index % 2 === 1])>
                    @if($index % 2 === 1)
                        <div class="col mt-4 mt-md-0">
                            @include('partials.service-detail', ['service' => $service])
                        </div>
                        <div class="col">
                            @include('partials.service-carousel', ['service' => $service])
                        </div>
                    @else
                        <div class="col">
                            @include('partials.service-carousel', ['service' => $service])
                        </div>
                        <div class="col mt-4 mt-md-0">
                            @include('partials.service-detail', ['service' => $service])
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    <x-statistics :statistics="$statistics" />
@endsection

@push('scripts-before')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@push('scripts')
    <script src="{{ asset('js/site/' . ($isRtl ? 'owl.carousel-rtl.js' : 'owl.carousel-ltr.js')) }}"></script>
@endpush
