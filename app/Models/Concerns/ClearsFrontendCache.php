<?php

namespace App\Models\Concerns;

use App\Services\FrontendContentService;

trait ClearsFrontendCache
{
    protected static function bootClearsFrontendCache(): void
    {
        static::saved(fn () => app(FrontendContentService::class)->clearCache());
        static::deleted(fn () => app(FrontendContentService::class)->clearCache());
    }
}
