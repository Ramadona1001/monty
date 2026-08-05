@props(['active' => null, 'page' => null, 'breadcrumbHome' => null, 'breadcrumbCurrent' => null])

@php
    $bannerImage = $settings->breadcrumb_image ?: $page?->banner_image;
    $overlayOpacity = ($settings->breadcrumb_overlay_opacity ?? 0) / 100;
    $overlayColor = $settings->breadcrumb_overlay_color ?? '#000000';
@endphp

@once
    <style>
        .banar.banar--has-image {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .banar__overlay {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .banar__content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
            text-align: center;
        }
    </style>
@endonce

<section class="hero">
    <x-header :active="$active" />
    <div
        @class(['banar', 'banar--has-image' => filled($bannerImage)])
        @if($bannerImage) style="background-image: url('{{ asset($bannerImage) }}');" @endif
    >
        @if($bannerImage && ($settings->breadcrumb_overlay_opacity ?? 0) > 0)
            <div
                class="banar__overlay"
                style="background-color: {{ $overlayColor }}; opacity: {{ $overlayOpacity }};"
            ></div>
        @endif
        <div class="banar__content">
            <h1 class="main__heading">{{ $settings->site_name }}</h1>
            <span>
                <a href="{{ route('home', ['locale' => $locale]) }}">{{ $breadcrumbHome ?? __('site.pages.home') }}</a>
                / {{ $breadcrumbCurrent }}
            </span>
        </div>
    </div>
</section>
