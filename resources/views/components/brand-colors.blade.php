@php
    $primary = $settings->primary_color ?? '#f8aa27';
    $secondary = $settings->secondary_color ?? '#222222';
    $accent = $settings->accent_color ?? '#ffffff';
@endphp
<style>
    :root {
        --brand-primary: {{ $primary }};
        --brand-secondary: {{ $secondary }};
        --brand-accent: {{ $accent }};
    }

    .text__color,
    .sub__heading,
    .main__heading.normal,
    .services__card__num,
    .features__card__icon i,
    .icon__box .icon i,
    .social__box a:hover i,
    .banar .breadcrumb a:hover {
        color: var(--brand-accent) !important;
    }

    .btn:not(.btn__readmore),
    .quote__btn,
    .owl-carousel-hero .btn,
    .number span,
    .upperbar,
    .hamburger .bar,
    .hamburger .bar::before,
    .hamburger .bar::after,
    footer,
    .progress-section .number {
        background-color: var(--brand-primary) !important;
    }

    .btn:not(.btn__readmore) a,
    .quote__btn,
    .owl-carousel-hero .btn a {
        color: var(--brand-accent) !important;
    }

    .footer,
    .footer p,
    .footer h3,
    .footer li,
    .footer span {
        color: var(--brand-accent);
    }

    .form-control:focus {
        border-color: var(--brand-primary) !important;
        box-shadow: 0 0 0 0.2rem color-mix(in srgb, var(--brand-primary) 25%, transparent) !important;
    }
</style>
