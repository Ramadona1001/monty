<?php

namespace App\Models;

use App\Models\Concerns\ClearsFrontendCache;
use App\Support\GalleryMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class GalleryItem extends Model
{
    use ClearsFrontendCache;
    use HasTranslations;
    use SoftDeletes;

    public const TYPE_IMAGE = 'image';

    public const TYPE_VIDEO = 'video';

    /** @var list<string> */
    public array $translatable = ['title'];

    /** @var list<string> */
    protected $fillable = [
        'title',
        'media_type',
        'media_path',
        'media_url',
        'sort_order',
        'is_active',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function isImage(): bool
    {
        return $this->media_type === self::TYPE_IMAGE;
    }

    public function isVideo(): bool
    {
        return $this->media_type === self::TYPE_VIDEO;
    }

    public function usesUpload(): bool
    {
        return filled($this->media_path);
    }

    public function usesExternalUrl(): bool
    {
        return filled($this->media_url);
    }

    public function displaySource(): ?string
    {
        if ($this->usesUpload()) {
            return asset($this->media_path);
        }

        return $this->media_url;
    }

    public function embedUrl(): ?string
    {
        if ($this->usesUpload() || blank($this->media_url)) {
            return null;
        }

        return GalleryMedia::embedUrl($this->media_url);
    }

    public function thumbnailSource(): ?string
    {
        if ($this->isImage()) {
            return $this->displaySource();
        }

        if ($this->usesUpload()) {
            return null;
        }

        return GalleryMedia::thumbnailUrl($this->media_url);
    }
}
