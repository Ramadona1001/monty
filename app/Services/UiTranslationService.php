<?php

namespace App\Services;

use App\Models\UiTranslation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;

class UiTranslationService
{
    public function load(): void
    {
        foreach (config('locales.supported', ['en', 'ar']) as $locale) {
            $lines = Cache::remember("ui_translations.{$locale}", 3600, function () use ($locale) {
                return UiTranslation::query()
                    ->orderBy('group')
                    ->orderBy('key')
                    ->get()
                    ->groupBy('group')
                    ->map(fn ($items) => $items->mapWithKeys(function (UiTranslation $translation) use ($locale) {
                        return [
                            $translation->key => $translation->getTranslation('value', $locale, false)
                                ?: $translation->getTranslation('value', config('locales.fallback', 'en'), false),
                        ];
                    })->all())
                    ->all();
            });

            if ($lines !== []) {
                Lang::addLines($lines, $locale, 'site');
            }
        }
    }

    public function clearCache(): void
    {
        foreach (config('locales.supported', ['en', 'ar']) as $locale) {
            Cache::forget("ui_translations.{$locale}");
        }
    }
}
