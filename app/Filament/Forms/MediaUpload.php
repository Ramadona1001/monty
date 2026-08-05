<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\BaseFileUpload;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;

class MediaUpload
{
    public static function image(string $name, ?string $label = null, string $directory = 'assets/uploads/images'): FileUpload
    {
        return self::configure(
            FileUpload::make($name)
                ->label($label ?? str($name)->headline()->toString())
                ->disk('public_assets')
                ->directory($directory)
                ->image()
                ->visibility('public')
                ->maxSize(5120)
        );
    }

    public static function video(string $name, ?string $label = null, string $directory = 'assets/uploads/videos'): FileUpload
    {
        return self::configure(
            FileUpload::make($name)
                ->label($label ?? str($name)->headline()->toString())
                ->disk('public_assets')
                ->directory($directory)
                ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/quicktime'])
                ->visibility('public')
                ->maxSize(51200)
        );
    }

    public static function favicon(string $name = 'favicon_path'): FileUpload
    {
        return self::image($name, 'Favicon', 'assets/uploads/favicons')
            ->acceptedFileTypes(['image/png', 'image/x-icon', 'image/vnd.microsoft.icon', 'image/webp', 'image/jpeg']);
    }

    private static function configure(FileUpload $upload): FileUpload
    {
        return $upload->getUploadedFileUsing(function (BaseFileUpload $component, string $file, string | array | null $storedFileNames): ?array {
            $storage = Storage::disk('public_assets');

            if (! $storage->exists($file)) {
                return null;
            }

            return [
                'name' => ($component->isMultiple() ? ($storedFileNames[$file] ?? null) : $storedFileNames) ?? basename($file),
                'size' => $storage->size($file),
                'type' => $storage->mimeType($file),
                'url' => url($file),
            ];
        });
    }
}
