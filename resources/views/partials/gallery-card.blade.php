@php
    use App\Support\GalleryMedia;

    $title = $item->getTranslation('title', $locale);
    $isVideo = $item->isVideo();
    $thumbnail = $item->thumbnailSource();
    $embedUrl = $item->embedUrl();
    $displaySource = $item->displaySource();
    $isDirectVideo = $isVideo && $item->usesExternalUrl() && GalleryMedia::isDirectVideo($item->media_url);
@endphp

<button
    type="button"
    class="gallery-card"
    data-bs-toggle="modal"
    data-bs-target="#galleryModal"
    data-gallery-title="{{ $title }}"
    data-gallery-type="{{ $item->media_type }}"
    @if($item->isImage())
        data-gallery-src="{{ $displaySource }}"
    @elseif($embedUrl)
        data-gallery-embed="{{ $embedUrl }}"
    @elseif($isDirectVideo || $item->usesUpload())
        data-gallery-video="{{ $displaySource }}"
    @endif
>
    <div class="gallery-card__media">
        @if($thumbnail)
            <img src="{{ $thumbnail }}" alt="{{ $title }}" loading="lazy">
        @else
            <div class="gallery-card__placeholder">
                <i class="fa-solid fa-video"></i>
            </div>
        @endif

        @if($isVideo)
            <span class="gallery-card__play"><i class="fa-solid fa-play"></i></span>
        @endif
    </div>
    <div class="gallery-card__body">
        <h5 class="gallery-card__title">{{ $title }}</h5>
    </div>
</button>
