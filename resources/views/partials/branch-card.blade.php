<div class="branch-card h-100">
    <div class="branch-card__icon">
        <i class="{{ $branch->icon }}"></i>
    </div>
    <div class="branch-card__body">
        <h5 class="branch-card__title">{{ $branch->getTranslation('name', $locale) }}</h5>
        @include('partials.branch-contact', ['branch' => $branch,'is_footer' => false])
    </div>
</div>
