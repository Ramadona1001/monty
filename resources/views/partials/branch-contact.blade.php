@php
    $address = $branch->getTranslation('address', $locale, false);
@endphp

<div class="branch-contact">
    @if(filled($address))
        <p class="branch-contact__item mb-1">
            <i class="fa-solid fa-location-dot"></i>
            {{ $address }}
        </p>
    @endif

    @if(filled($branch->phone))
        <p class="branch-contact__item mb-1">
            <i class="fa-solid fa-phone"></i>
            <a href="tel:{{ preg_replace('/\s+/', '', $branch->phone) }}">{{ $branch->phone }}</a>
        </p>
    @endif

    @if(filled($branch->email))
        <p class="branch-contact__item mb-1">
            <i class="fa-solid fa-envelope"></i>
            <a href="mailto:{{ $branch->email }}">{{ $branch->email }}</a>
        </p>
    @endif

    @if(filled($branch->whatsapp))
        <p class="branch-contact__item mb-1">
            <i class="fa-brands fa-whatsapp"></i>
            <a href="https://wa.me/{{ preg_replace('/\D+/', '', $branch->whatsapp) }}" target="_blank" rel="noopener noreferrer">{{ $branch->whatsapp }}</a>
        </p>
    @endif

    {{-- @if(filled($branch->iban))
        <p class="branch-contact__item mb-0">
            <i class="fa-solid fa-building-columns"></i>
            <span class="branch-contact__label">IBAN:</span> {{ $branch->iban }}
        </p>
    @endif --}}
</div>
