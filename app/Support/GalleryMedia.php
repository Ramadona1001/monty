<?php

namespace App\Support;

class GalleryMedia
{
    public static function embedUrl(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        $url = trim($url);

        if (preg_match('~(?:youtube\.com/watch\?v=|youtube\.com/embed/|youtu\.be/)([A-Za-z0-9_-]{11})~', $url, $matches)) {
            return 'https://www.youtube.com/embed/'.$matches[1];
        }

        if (preg_match('~vimeo\.com/(?:video/)?(\d+)~', $url, $matches)) {
            return 'https://player.vimeo.com/video/'.$matches[1];
        }

        return null;
    }

    public static function isEmbeddable(?string $url): bool
    {
        return filled(self::embedUrl($url));
    }

    public static function isDirectVideo(?string $url): bool
    {
        if (blank($url)) {
            return false;
        }

        return (bool) preg_match('~\.(mp4|webm|ogg|mov)(\?.*)?$~i', $url);
    }

    public static function thumbnailUrl(?string $url): ?string
    {
        if (blank($url)) {
            return null;
        }

        if (preg_match('~(?:youtube\.com/watch\?v=|youtube\.com/embed/|youtu\.be/)([A-Za-z0-9_-]{11})~', $url, $matches)) {
            return 'https://img.youtube.com/vi/'.$matches[1].'/hqdefault.jpg';
        }

        return null;
    }
}
