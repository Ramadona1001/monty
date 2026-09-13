<div class="product-card h-100">
    <div class="product-card__media">
        @if($product->image)
            <img src="{{ asset($product->image) }}" alt="{{ $product->getTranslation('title', $locale) }}" loading="lazy">
        @else
            <div class="product-card__placeholder">
                <i class="fa-solid fa-cube"></i>
            </div>
        @endif
    </div>
    <div class="product-card__body">
        <h5 class="product-card__title">{{ $product->getTranslation('title', $locale) }}</h5>
        @if($product->getTranslation('excerpt', $locale, false))
            <p class="product-card__excerpt">{{ $product->getTranslation('excerpt', $locale) }}</p>
        @endif
    </div>
</div>
