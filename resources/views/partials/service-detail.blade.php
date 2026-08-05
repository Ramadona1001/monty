<div class="number__heading">
    <span class="number">{{ $service->number }}</span>
    <h4 class="fw-bold">{{ $service->getTranslation('title', $locale) }}</h4>
</div>
<p class="mt-4">{{ $service->getTranslation('body', $locale) }}</p>
@if($service->features->isNotEmpty())
    <ul>
        @foreach($service->features as $feature)
            <li><span>{{ str_pad((string) $feature->sort_order, 2, '0', STR_PAD_LEFT) }}</span> {{ $feature->getTranslation('name', $locale) }}</li>
        @endforeach
    </ul>
@endif
<button class="btn quote__btn text-white mt-4">
    <a href="{{ route('contact', ['locale' => $locale]) }}#form">{{ __('site.buttons.contact') }}</a>
</button>
