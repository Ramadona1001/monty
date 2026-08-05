<div class="owl-carousel-service owl-carousel owl-theme">
    @foreach($service->images as $image)
        <div class="item">
            <img class="w-100 h-100 img-fluid" src="{{ asset($image->image_path) }}" alt="{{ $service->getTranslation('title', $locale) }}" loading="lazy">
        </div>
    @endforeach
</div>
